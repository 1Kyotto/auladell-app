<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Auth\User;

class ResetPasswordController
{
    public function passwordResetForm(string $token)
    {
        return view('user.reset-password', ['token' => $token]);
    }

    public function resetPasswordUpdate(Request $request)
    {
        $messages = [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ];

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], $messages);

        // Intentar restablecer la contraseña
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                // Actualizar la contraseña del usuario
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Emitir el evento PasswordReset
                event(new PasswordReset($user));
            }
        );

        // Verificar el estado de la operación
        if ($status === Password::PASSWORD_RESET) {
            // Enviar un mensaje de éxito
            return redirect()->route('home.index')->with('status', '¡Contraseña cambiada exitosamente!');
        } else {
            // Enviar un mensaje de error
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
