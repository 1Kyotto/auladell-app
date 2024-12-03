<?php

namespace App\Http\Controllers\Cart;

use App\Models\Auth\Guest;
use App\Models\Carts\Cart;
use App\Models\Carts\CartProduct;
use App\Models\Customizations\CustomizationSelection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartController
{
    public function index(Request $request)
    {
        // Obtener el user_id si el usuario está autenticado
        $userId = Auth::check() ? Auth::id() : null;

        // Obtener el guest_id desde la cookie si no está autenticado
        $guestId = !$userId ? $request->cookie('guest_id') : null;

        // Validar que el guest_id existe en la tabla guests
        if ($guestId && !Guest::where('id', $guestId)->exists()) {
            $guestId = null; // Si no existe, descartamos este guest_id
        }

        // Si no hay guest_id y no hay user_id, crear un nuevo invitado
        if (!$userId && !$guestId) {
            $guest = Guest::create([
                'name' => 'Invitado',
                'email' => 'guest_' . Str::uuid() . '@example.com',
                'phone' => '000000000',
            ]);

            $guestId = $guest->id;

            // Establecer la cookie para persistir el guest_id
            cookie()->queue(cookie('guest_id', $guestId, 60 * 24 * 7)); // Duración de 7 días
        }

        // Verificar si hay un carrito activo
        $cart = Cart::where(function ($query) use ($userId, $guestId) {
            if ($userId) {
                $query->where('user_id', $userId);
            }
            if ($guestId) {
                $query->orWhere('guest_id', $guestId);
            }
        })->first();

        // Si no hay carrito, crearlo
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $userId,
                'guest_id' => $guestId,
            ]);
        }

        // Guardar el cart_id en la sesión
        session(['cart_id' => $cart->id]);

        // Inicializar una colección vacía para los productos
        $products = collect();

        // Si hay un carrito, obtener los productos
        if ($cart) {
            $products = CartProduct::where('cart_id', $cart->id)
                ->with(['product', 'customizations.customizationOption.customization'])
                ->get();

            // Log para depuración
            Log::info('Productos del carrito:', [
                'productos' => $products->map(function($product) {
                    return [
                        'id' => $product->id,
                        'nombre' => $product->product->name,
                        'customizations' => $product->customizations->map(function($customization) {
                            return [
                                'id' => $customization->id,
                                'customization_option_id' => $customization->customization_option_id,
                                'option' => $customization->customizationOption ? [
                                    'id' => $customization->customizationOption->id,
                                    'name' => $customization->customizationOption->name
                                ] : null
                            ];
                        })
                    ];
                })
            ]);
        }

        // Calcular el total de ítems
        $items = $products->sum('quantity');

        return view('cart.index', compact('products', 'items'));
    }


    public function addToCart(Request $request)
    {
        try {
            // Log para ver los datos que llegan
            Log::info('Datos recibidos:', [
                'request_all' => $request->all(),
                'customizations' => $request->input('customizations'),
                'decoded_customizations' => json_decode($request->customizations, true)
            ]);

            // Decodificar el JSON de customizations
            if ($request->has('customizations')) {
                $request->merge(['customizations' => json_decode($request->customizations, true)]);
            }

            // Validación de datos de entrada
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'total_price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
                'customizations' => 'required|array',
                'customizations.*.option_id' => 'required|exists:customization_option,id',
                'customizations.*.quantity' => 'required|integer|min:1',
            ]);

            // Obtener el user_id si está autenticado
            $userId = Auth::check() ? Auth::id() : null;
            $guestId = $request->cookie('guest_id');

            // Si no hay cookie o el guest no existe, crear un nuevo invitado
            if (!$userId && (!$guestId || !Guest::where('id', $guestId)->exists())) {
                $guest = Guest::create([
                    'name' => 'Invitado',
                    'email' => 'guest_' . Str::uuid() . '@example.com',
                    'phone' => '000000000',
                ]);

                $guestId = $guest->id;
                cookie()->queue(cookie('guest_id', $guestId, 60 * 24 * 7));
            }

            DB::beginTransaction();

            // Obtener o crear el carrito
            $cart = Cart::firstOrCreate([
                'user_id' => $userId,
                'guest_id' => $userId ? null : $guestId,
            ]);

            // Crear el registro en cart_product
            $cartProduct = CartProduct::create([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
                'price' => $validated['total_price'],
            ]);

            // Log para debug
            Log::info('CartProduct creado:', [
                'cart_product_id' => $cartProduct->id,
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id']
            ]);

            // Guardar las customizaciones
            foreach ($validated['customizations'] as $customization) {
                // Log antes de insertar
                Log::info('Intentando insertar customización:', [
                    'cart_product_id' => $cartProduct->id,
                    'customization_option_id' => $customization['option_id'],
                    'customization_data' => $customization
                ]);

                CustomizationSelection::create([
                    'cart_product_id' => $cartProduct->id,
                    'customization_option_id' => $customization['option_id'],
                    'quantity' => $customization['quantity']
                ]);
            }

            DB::commit();

            // Log de éxito
            Log::info('Producto agregado al carrito exitosamente', [
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'price' => $validated['total_price']
            ]);

            return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al agregar el producto al carrito:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Error al agregar el producto al carrito.');
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Validación de datos de entrada
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);

            // Obtener el carrito actual de la sesión
            $cartId = session('cart_id');
            
            if (!$cartId) {
                return redirect()->route('cart.index')->with('error', 'No se encontró un carrito activo.');
            }

            // Buscar el producto en el carrito
            $cartProduct = CartProduct::where('cart_id', $cartId)
                ->where('product_id', $validated['product_id'])
                ->first();

            if (!$cartProduct) {
                return redirect()->route('cart.index')->with('error', 'El producto no está en el carrito.');
            }

            // Eliminar las personalizaciones asociadas
            CustomizationSelection::where('cart_product_id', $cartProduct->id)->delete();
            
            // Eliminar el producto del carrito
            $cartProduct->delete();

            DB::commit();
            
            return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito exitosamente.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar el producto del carrito:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('cart.index')->with('error', 'No se pudo eliminar el producto del carrito.');
        }
    }

    public function consolidateCarts($guestCart, $userCart)
    {
        // Obtener todos los productos del carrito del invitado
        $guestCartProducts = CartProduct::where('cart_id', $guestCart->id)->get();

        foreach ($guestCartProducts as $guestCartProduct) {
            // Buscar si el producto ya existe en el carrito del usuario
            $existingCartProduct = CartProduct::where('cart_id', $userCart->id)
                ->where('product_id', $guestCartProduct->product_id)
                ->first();

            if ($existingCartProduct) {
                // Si el producto ya existe, actualizar la cantidad y el precio
                $existingCartProduct->update([
                    'quantity' => $existingCartProduct->quantity + $guestCartProduct->quantity,
                    'price' => $guestCartProduct->price,
                ]);
            } else {
                // Si el producto no existe, crear un nuevo CartProduct
                CartProduct::create([
                    'cart_id' => $userCart->id,
                    'product_id' => $guestCartProduct->product_id,
                    'quantity' => $guestCartProduct->quantity,
                    'price' => $guestCartProduct->price,
                ]);
            }

            // Transferir las customizaciones si existen
            foreach ($guestCartProduct->customizations as $customization) {
                $customization->update([
                    'cart_product_id' => $existingCartProduct ? $existingCartProduct->id : CartProduct::where('cart_id', $userCart->id)
                        ->where('product_id', $guestCartProduct->product_id)
                        ->first()->id
                ]);
            }
        }

        // Eliminar todos los CartProduct del carrito del invitado
        CartProduct::where('cart_id', $guestCart->id)->delete();

        // Eliminar el carrito del invitado
        $guestCart->delete();
    }



    public function checkout()
    {
        return view('cart.checkout');
    }

    public function payment()
    {
        // Si el usuario está autenticado, buscar el cart_id asociado al user_id
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if (!$cart) {
                return redirect()->route('cart.index')->with('error', 'No se encontró un carrito asociado a este usuario.');
            }
            $cartId = $cart->id;
        } else {
            // Si no está autenticado, usar el cart_id de la sesión
            $cartId = session('cart_id');

            if (!$cartId) {
                return redirect()->route('cart.index')->with('error', 'No se encontró el carrito.');
            }
        }

        // Calcular el precio total de los productos en el carrito
        $totalPrice = CartProduct::where('cart_id', $cartId)->sum('price');

        return view('cart.payment', compact('totalPrice'));
    }

    public function updateGuest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits_between:8,15|max:9',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            'mame.max' => 'El nombre no puede tener más de :max caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.max' => 'El número de teléfono no puede tener más de :max caracteres.',
        ]);

        // Procesar los datos
        $name = $validated['name'];
        $email = $validated['email'];
        $phone = $validated['phone'];

        $guestId = $request->cookie('guest_id');
        $guest = Guest::find($guestId);

        if ($guest) {
            $guest->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]);
        }

        return redirect()->route('cart.payment');
    }

    public function generateOrderNumber($orderId, $userId = null, $guestId = null)
    {
        // Concatenar una cadena única basada en el ID del pedido, usuario/invitado y la marca de tiempo
        $seed = $orderId
            . ($userId ?? '') // Si existe un userId, agregarlo
            . ($guestId ?? '') // Si no hay userId, usar el guestId
            . now()->timestamp
            . Str::random(10);

        // Generar un hash SHA1 a partir de la semilla
        $hash = sha1($seed);

        // Formatear el número de orden
        $orderNumber = strtoupper(substr($hash, 0, 10)); // Usar los primeros 10 caracteres para más legibilidad

        return $orderNumber;
    }
}
