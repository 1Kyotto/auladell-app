<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Cart\CartController;
use App\Models\Carts\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $messages = [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ];

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            $guestId = $request->cookie('guest_id');
            if ($guestId) {
                // Buscar carrito del invitado
                $guestCart = Cart::where('guest_id', $guestId)->first();

                // Buscar o crear el carrito del usuario autenticado
                $userCart = Cart::firstOrCreate([
                    'user_id' => $user->id,
                ]);

                if ($guestCart) {
                    // Crear una instancia de CartController y consolidar los carritos
                    $cartController = new CartController();
                    $cartController->consolidateCarts($guestCart, $userCart);
                }

                // Eliminar la cookie 'guest_id'
                cookie()->queue(cookie()->forget('guest_id'));
            }

            if ($user->role == 'A') {
                //Cambiar por admin.index
                /*return redirect()->route('admin.product');*/
                return redirect()->route('home.index');
            }
            /*else {
                return redirect()->route('home.index');
            }*/
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }
}
