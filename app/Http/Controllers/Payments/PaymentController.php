<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Cart\CartController;
use App\Models\Carts\CartProduct;
use App\Models\Orders\Order;
use App\Models\Orders\OrderProduct;
use App\Models\Orders\Payment;
use App\Models\ShippingAddresses\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController
{
    public function store(Request $request)
    {
        Log::info('Datos enviados desde el formulario', $request->all());
        // Validar los datos enviados desde el formulario
        $validated = $request->validate([
            'name-cardholder' => 'required|string|max:255',
            'card-number' => 'required|string|max:16',
            'expiry-date' => 'required|string|max:5',
            'card-cvv' => 'required|string|max:4',
            'shipping-city' => 'required|string|max:255',
            'shipping-locality' => 'required|string|max:255',
            'shipping-address' => 'required|string|max:255',
        ]);

        // Comenzar una transacción de base de datos para garantizar integridad
        DB::beginTransaction();

        try {
            // Obtener datos del carrito
            $userId = Auth::check() ? Auth::id() : null; // Si está autenticado
            $guestId = $userId ? null : $request->cookie('guest_id'); // Si es invitado
            $cartId = session('cart_id'); // Obtener el cart_id desde la sesión

            // Verificar si hay productos en el carrito
            $cartProducts = CartProduct::where('cart_id', $cartId)->get();
            if ($cartProducts->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
            }

            // Calcular el total del carrito
            $subtotal = $cartProducts->sum(fn($item) => $item->price * $item->quantity);
            $shippingCost = 20000; // Costo fijo de envío
            $totalPrice = $subtotal + $shippingCost;

            // Crear la dirección de envío
            $shippingAddress = ShippingAddress::create([
                'user_id' => $userId,
                'guest_id' => $guestId,
                'city' => $validated['shipping-city'],
                'locality' => $validated['shipping-locality'],
                'address' => $validated['shipping-address'],
            ]);

            // Crear la orden
            $order = Order::create([
                'user_id' => $userId,
                'guest_id' => $guestId,
                'shipping_address_id' => $shippingAddress->id,
                'total' => $totalPrice,
                'status' => 'Waiting',
            ]);

            $cartController = new CartController();
            $orderNumber = $cartController->generateOrderNumber($order->id, $userId, $guestId);

            $order->update(['order_num' => $orderNumber]);

            // Crear los productos asociados a la orden
            foreach ($cartProducts as $cartProduct) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $cartProduct->product_id,
                    'quantity' => $cartProduct->quantity,
                    'unit_price' => $cartProduct->price,
                    'total_price' => $cartProduct->price * $cartProduct->quantity,
                ]);
            }

            // Crear el pago asociado a la orden
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'Credit', // Puede ser dinámico dependiendo del formulario
                'total_price' => $totalPrice,
                'net_price' => $subtotal, // Precio sin incluir el costo de envío
                'payment_status' => 'Confirmed', // Estado inicial del pago
            ]);

            if ($payment->payment_status === 'Confirmed') {
                $order->update(['status' => 'Production']);
            }

            // Limpiar el carrito después de procesar la orden
            CartProduct::where('cart_id', $cartId)->delete();

            // Confirmar la transacción
            DB::commit();

            // Redirigir a la página de confirmación de pago
            return redirect()->route('cart.success')->with('success', 'Tu pago se procesó correctamente.');
        } catch (\Exception $e) {
            // Revertir los cambios si algo falla
            DB::rollBack();

            // Loguear el error para depuración
            Log::error('Error en el proceso de pago: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Manejar el error y redirigir con mensaje
            return redirect()->route('cart.payment')->with('error', 'Hubo un problema al procesar tu pago: ' . $e->getMessage());
        }
    }
}
