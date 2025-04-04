<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Cart\CartController;
use App\Models\Carts\Cart;
use App\Models\Carts\CartProduct;
use App\Models\Orders\Order;
use App\Models\Orders\OrderProduct;
use App\Models\Orders\Payment;
use App\Models\ShippingAddresses\ShippingAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController
{
    public function store(Request $request)
    {
        Log::info('Datos enviados desde el formulario', $request->all());

        try {
            // Validar los datos enviados desde el formulario
            $validated = $request->validate([
                'name-cardholder' => 'required|string|max:255',
                'card-number' => 'required|string|max:16',
                'month' => 'required|string|max:2',
                'year' => 'required|string|max:4',
                'card-cvv' => 'required|string|max:4',
                'shipping-city' => 'required|string|max:255',
                'shipping-locality' => 'required|string|max:255',
                'shipping-address' => 'required|string|max:255',
            ], [
                'name-cardholder.required' => 'El nombre del titular es obligatorio',
                'name-cardholder.max' => 'El nombre no puede tener más de :max caracteres',
                
                'card-number.required' => 'El número de tarjeta es obligatorio',
                'card-number.min' => 'El número de tarjeta debe tener :min dígitos',
                'card-number.max' => 'El número de tarjeta debe tener :max dígitos',
                
                'month.required' => 'El mes es obligatorio',
                'month.min' => 'El mes debe tener :min dígitos',
                'month.max' => 'El mes debe tener :max dígitos',
                
                'year.required' => 'El año es obligatorio',
                'year.min' => 'El año debe tener :min dígitos',
                'year.max' => 'El año debe tener :max dígitos',
                
                'card-cvv.required' => 'El CVV es obligatorio',
                'card-cvv.min' => 'El CVV debe tener al menos :min dígitos',
                'card-cvv.max' => 'El CVV no puede tener más de :max dígitos',
                
                'shipping-city.required' => 'La ciudad es obligatoria',
                'shipping-locality.required' => 'La comuna es obligatoria',
                'shipping-address.required' => 'La dirección es obligatoria',
            ]);

            Log::info('Datos validados correctamente');

            // Comenzar una transacción de base de datos para garantizar integridad
            DB::beginTransaction();

            try {
                Log::info('Inicio transacción');
                // Obtener datos del carrito
                $userId = Auth::check() ? Auth::id() : null;
                $cartId = session('cart_id');
    
                Log::info('Datos del usuario y carrito:', [
                    'user_id' => $userId,
                    'cart_id' => $cartId
                ]);
    
                // Obtener el guest_id del carrito actual
                $cart = Cart::find($cartId);
                $guestId = $cart ? $cart->guest_id : null;
    
                // Si no hay guest_id en el carrito, intentar obtenerlo de la cookie
                if (!$guestId) {
                    $guestId = $request->cookie('guest_id');
                    Log::info('Obteniendo guest_id de la cookie', ['guest_id' => $guestId]);
                }
    
                Log::info('IDs de la orden:', [
                    'user_id' => $userId,
                    'guest_id' => $guestId,
                    'cart_id' => $cartId
                ]);
    
                // Verificar si hay productos en el carrito
                $cartProducts = CartProduct::where('cart_id', $cartId)->get();
                if ($cartProducts->isEmpty()) {
                    Log::info('Carrito vacío');
                    return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
                }
    
                // Calcular el total del carrito
                $subtotal = $cartProducts->sum(fn($item) => $item->price * $item->quantity);
                $shippingCost = 20000; // Costo fijo de envío
                $totalPrice = $subtotal + $shippingCost;
    
                Log::info('Total del carrito:', [
                    'subtotal' => $subtotal,
                    'shipping_cost' => $shippingCost,
                    'total_price' => $totalPrice
                ]);
    
                // Crear la dirección de envío
                $shippingAddress = ShippingAddress::create([
                    'user_id' => $userId,
                    'guest_id' => $guestId,
                    'city' => $validated['shipping-city'],
                    'locality' => $validated['shipping-locality'],
                    'address' => $validated['shipping-address'],
                ]);
    
                Log::info('Dirección de envío creada', [
                    'id' => $shippingAddress->id
                ]);
    
                // Crear la orden
                $order = Order::create([
                    'user_id' => $userId,
                    'guest_id' => $guestId,
                    'shipping_address_id' => $shippingAddress->id,
                    'total' => $totalPrice,
                    'status' => 'Waiting',
                    'order_num' => '123',
                ]);
    
                $cartController = new CartController();
                $orderNumber = $cartController->generateOrderNumber($order->id, $userId, $guestId);
    
                $order->update(['order_num' => $orderNumber]);
    
                // Crear los productos asociados a la orden y mantener un mapeo
                $cartProductToOrderProduct = [];
                foreach ($cartProducts as $cartProduct) {
                    Log::info('Creando OrderProduct', [
                        'cart_product_id' => $cartProduct->id,
                        'product_id' => $cartProduct->product_id,
                        'quantity' => $cartProduct->quantity,
                        'price' => $cartProduct->price
                    ]);
    
                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $cartProduct->product_id,
                        'quantity' => $cartProduct->quantity,
                        'unit_price' => $cartProduct->price,
                        'total_price' => $cartProduct->price * $cartProduct->quantity,
                    ]);
    
                    Log::info('OrderProduct creado', [
                        'order_product_id' => $orderProduct->id,
                        'cart_product_id' => $cartProduct->id
                    ]);
    
                    $cartProductToOrderProduct[$cartProduct->id] = $orderProduct->id;
                }
    
                Log::info('Mapeo de CartProduct a OrderProduct', [
                    'mapping' => $cartProductToOrderProduct
                ]);
    
                // Actualizar las customizaciones: desvincular del cart_product y vincular al order_product
                foreach ($cartProducts as $cartProduct) {
                    $orderProductId = $cartProductToOrderProduct[$cartProduct->id] ?? null;
                    Log::info('Actualizando customizaciones', [
                        'cart_product_id' => $cartProduct->id,
                        'order_product_id' => $orderProductId,
                        'mapping_completo' => $cartProductToOrderProduct
                    ]);
                    
                    // Obtener todas las customizaciones y actualizarlas una por una
                    $customizations = $cartProduct->customizations()->get();
                    foreach ($customizations as $customization) {
                        try {
                            $customization->update([
                                'cart_product_id' => null,
                                'order_product_id' => $orderProductId
                            ]);
                            Log::info('Customización actualizada', [
                                'customization_id' => $customization->id,
                                'nuevo_order_product_id' => $orderProductId
                            ]);
                        } catch (\Exception $e) {
                            Log::error('Error al actualizar customización', [
                                'customization_id' => $customization->id,
                                'error' => $e->getMessage()
                            ]);
                            throw $e;
                        }
                    }
                }
    
                // Actualizar el inventario de materiales
                foreach ($cartProducts as $cartProduct) {
                    $product = $cartProduct->product;
                    
                    // Restar materiales del producto base
                    foreach ($product->materials as $material) {
                        $quantityToReduce = $material->pivot->quantity_needed * $cartProduct->quantity;
                        $material->decrement('quantity_in_stock', $quantityToReduce);
                        
                        // Registrar el cambio en el inventario
                        DB::table('inventory_change')->insert([
                            'material_id' => $material->id,
                            'performed_by' => $userId,
                            'quantity' => -$quantityToReduce,
                            'transaction_type' => 'Production'
                        ]);
                    }
                    
                    // Restar materiales de las personalizaciones
                    $customizations = $cartProduct->customizations;
                    foreach ($customizations as $customization) {
                        foreach ($customization->customizationOption->materials as $material) {
                            $quantityToReduce = $material->pivot->quantity_needed * $cartProduct->quantity;
                            $material->decrement('quantity_in_stock', $quantityToReduce);
                            
                            // Registrar el cambio en el inventario
                            DB::table('inventory_change')->insert([
                                'material_id' => $material->id,
                                'performed_by' => $userId,
                                'quantity' => -$quantityToReduce,
                                'transaction_type' => 'Production',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                }
    
                // Crear el pago asociado a la orden
                $payment = Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'Credito', // Puede ser dinámico dependiendo del formulario
                    'total_price' => $totalPrice,
                    'net_price' => $subtotal, // Precio sin incluir el costo de envío
                    'payment_status' => 'Confirmed', // Estado inicial del pago
                ]);
    
                if ($payment->payment_status === 'Confirmed') {
                    $order->update(['status' => 'Production']);
                }
    
                // Eliminar los productos del carrito
                CartProduct::where('cart_id', $cartId)->delete();
    
                // Confirmar la transacción
                DB::commit();
    
                return view('cart.success', [
                    'orderNumber' => $order->order_num,
                    'paymentMethod' => $payment->payment_method,
                    'paymentDate' => $payment->created_at->format('d/m/Y'),
                    'paymentTime' => $payment->created_at->format('H:i'),
                    'totalPrice' => $payment->total_price,
                ]);
            } catch (\Exception $e) {
                Log::error('Error en la transacción de base de datos', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                DB::rollBack();
                return redirect()->back()->with('error', 'Error al procesar el pago. Por favor, inténtelo nuevamente.');
            }

            DB::commit();
            Log::info('Transacción completada exitosamente');

            return redirect()->route('payment.success')->with('success', 'Pago realizado exitosamente');

        } catch (\Exception $e) {
            Log::error('Error general en el proceso de pago', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar el pago. Por favor, inténtelo nuevamente.');
        }
    }
}
