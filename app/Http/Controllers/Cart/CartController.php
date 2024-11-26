<?php

namespace App\Http\Controllers\Cart;

use App\Models\Auth\Guest;
use App\Models\Carts\Cart;
use App\Models\Carts\CartProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                ->with('product') // Si tienes relación con el modelo Product
                ->get();
        }

        // Calcular el total de ítems
        $items = $products->sum('quantity');

        return view('cart.index', compact('products', 'items'));
    }


    public function addToCart(Request $request)
    {
        // Validación de datos de entrada
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        // Obtener el user_id si está autenticado
        $userId = Auth::check() ? Auth::id() : null;

        // Obtener el guest_id desde la cookie
        $guestId = $request->cookie('guest_id');

        // Si no hay cookie, crear un nuevo invitado y establecer la cookie
        if (!$userId && !$guestId) {
            $guest = Guest::create([
                'name' => 'Invitado',
                'email' => 'guest_' . Str::uuid() . '@example.com',
                'phone' => '000000000',
            ]);

            $guestId = $guest->id;

            // Establecer la cookie para persistir el guest_id
            cookie()->queue(cookie('guest_id', $guestId, 60 * 24 * 7)); // Duración de 7 días
        } elseif (!$userId && $guestId) {
            // Verificar si el guest_id existe en la base de datos
            $guestExists = Guest::where('id', $guestId)->exists();
            if (!$guestExists) {
                // Si el guest_id de la cookie no existe, crear uno nuevo
                $guest = Guest::create([
                    'name' => 'Invitado',
                    'email' => 'guest_' . Str::uuid() . '@example.com',
                    'phone' => '000000000',
                ]);

                $guestId = $guest->id;

                // Actualizar la cookie con el nuevo guest_id
                cookie()->queue(cookie('guest_id', $guestId, 60 * 24 * 7)); // Duración de 7 días
            }
        }

        // Obtener o crear el carrito asociado al usuario o invitado
        try {
            $cart = Cart::firstOrCreate([
                'user_id' => $userId,
                'guest_id' => $userId ? null : $guestId,
            ]);
        } catch (\Exception $e) {
            // \Log::error('Error al crear o buscar el carrito:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Hubo un problema al agregar el producto al carrito.');
        }

        // Agregar o actualizar el producto en el carrito
        try {
            for ($i = 0; $i < $validated['quantity']; $i++) {
                CartProduct::create([
                    'cart_id' => $cart->id,
                    'product_id' => $validated['product_id'],
                    'quantity' => 1,
                    'price' => $validated['total_price'],
                ]);
            }
        } catch (\Exception $e) {
            // \Log::error('Error al agregar el producto al carrito:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'No se pudo agregar el producto al carrito.');
        }

        return redirect()->route('cart.index');
    }

    public function removeFromCart(Request $request)
    {
        // Validación de datos de entrada
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Obtener el user_id si está autenticado
        $userId = Auth::check() ? Auth::id() : null;

        // Obtener el guest_id desde la cookie si no está autenticado
        $guestId = !$userId ? $request->cookie('guest_id') : null;

        // Verificar si hay un carrito activo
        $cart = Cart::where('user_id', $userId)
            ->orWhere('guest_id', $guestId)
            ->first();

        // Si no hay carrito, redirigir con un mensaje
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'No se encontró un carrito activo.');
        }

        // Buscar el producto en el carrito
        $cartProduct = CartProduct::where('cart_id', $cart->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        // Si el producto no existe en el carrito, redirigir con un mensaje
        if (!$cartProduct) {
            return redirect()->route('cart.index')->with('error', 'El producto no está en el carrito.');
        }

        // Eliminar el producto del carrito
        try {
            $cartProduct->delete();
        } catch (\Exception $e) {
            Log::error('Error al eliminar el producto del carrito:', ['error' => $e->getMessage()]);
            return redirect()->route('cart.index')->with('error', 'No se pudo eliminar el producto del carrito.');
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    public function consolidateCarts($guestCart, $userCart)
    {
        foreach ($guestCart->products as $guestProduct) {
            $productId = $guestProduct->id;
            $quantity = $guestProduct->pivot->quantity;
            $price = $guestProduct->pivot->price;

            // Buscar si el producto ya existe en el carrito del usuario
            $existingProduct = $userCart->products()->where('product_id', $productId)->first();

            if ($existingProduct) {
                // Si el producto ya existe, sumar las cantidades y mantener el precio más reciente
                $userCart->products()->updateExistingPivot($productId, [
                    'quantity' => $existingProduct->pivot->quantity + $quantity,
                    'price' => $price,
                ]);
            } else {
                // Si el producto no existe, agregarlo al carrito del usuario
                $userCart->products()->attach($productId, [
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }
        }

        // Eliminar primero los productos del carrito de invitado
        $guestCart->products()->detach();

        // Luego, eliminar el carrito del invitado
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
            'phone' => 'required|digits_between:8,15',
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

        return "ORD-{$orderNumber}";
    }
}
