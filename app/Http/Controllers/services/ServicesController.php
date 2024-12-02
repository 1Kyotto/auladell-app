<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;

class ServicesController
{
    public function contactUs()
    {
        return view('services.contact-us');
    }

    public function processContactForm(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:9',
            'email_contact' => 'required|email|max:255',
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser un texto.',
            'first_name.max' => 'El nombre no puede tener más de :max caracteres.',

            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.string' => 'El apellido debe ser un texto.',
            'last_name.max' => 'El apellido no puede tener más de :max caracteres.',

            'city.required' => 'El nombre de la ciudad es obligatorio.',
            'city.string' => 'El nombre de la ciudad debe ser un texto.',
            'city.max' => 'El nombre de la ciudad no puede tener más de :max caracteres.',

            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.string' => 'El número de teléfono debe ser un texto.',
            'phone.max' => 'El número de teléfono no puede tener más de :max caracteres.',

            'email_contact.required' => 'El correo electrónico es obligatorio.',
            'email_contact.email' => 'El correo electrónico no es válido.',
            'email_contact.max' => 'El correo electrónico no puede tener más de :max caracteres.',
        ]);

        // Aquí puedes procesar los datos validados
        return redirect()->route('services.contact-us')->with('success', 'Gracias por tu mensaje, nos pondremos en contacto pronto!');
    }
}
