<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;

class RegisterController
{
    public function index()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre es muy largo.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe contener solo números.',
            'phone.digits' => 'El teléfono debe tener 9 dígitos.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'phone' => ['required', 'numeric', 'digits:9'],
        ], $messages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->role = 'C';

        $user->save();
        Auth::login($user, true);
        return redirect()->route('home.index');
    }
}
