<?php

namespace App\Http\Controllers\Cart;

use App\Models\Auth\Guest;
use App\Models\Carts\Cart;
use App\Models\Carts\CartProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController
{
    public function index()
    {
        return view('cart.index');
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
            \Log::error('Error al crear o buscar el carrito:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Hubo un problema al agregar el producto al carrito.');
        }

        // Agregar o actualizar el producto en el carrito
        try {
            $cartProduct = CartProduct::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_id' => $validated['product_id'],
                ],
                [
                    'quantity' => DB::raw("quantity + {$validated['quantity']}"), // Incrementa la cantidad
                    'price' => $validated['total_price'], // Asegura el precio correcto
                ]
            );
        } catch (\Exception $e) {
            \Log::error('Error al agregar el producto al carrito:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'No se pudo agregar el producto al carrito.');
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }
}
