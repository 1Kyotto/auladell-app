<?php

namespace App\Http\Controllers\Cart;

use App\Models\Auth\Guest;
use App\Models\Carts\Cart;
use App\Models\Carts\CartProduct;
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

        // Verificar si hay un carrito activo
        $cart = Cart::where('user_id', $userId)
            ->orWhere('guest_id', $guestId)
            ->first();

        // Si no hay carrito, retorna con un mensaje
        if (!$cart) {
            return view('cart.index', ['products' => []])
                ->with('message', 'Tu carrito está vacío.');
        }

        // Obtener los productos del carrito
        $products = CartProduct::where('cart_id', $cart->id)
            ->with('product') // Si tienes relación con el modelo Product
            ->get();

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
}
