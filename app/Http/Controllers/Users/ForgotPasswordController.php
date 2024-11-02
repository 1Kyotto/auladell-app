<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController
{
    public function index()
    {
        return view('user.forgot-password');
    }

    public function sendEmail(Request $request)
    {
        $messages = [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
        ];

        $request->validate([
            'email' => ['required', 'email'],
        ], $messages);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Se ha enviado un correo para el restablecimiento de la contraseña.')
            : back()->withErrors(['email' => __($status)]);
    }
}
