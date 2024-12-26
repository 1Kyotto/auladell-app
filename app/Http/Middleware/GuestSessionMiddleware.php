<?php

namespace App\Http\Middleware;

use App\Models\Auth\Guest;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class GuestSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            if (!$request->cookie('guest_id')) {
                $guest = Guest::create([
                    'name' => 'Invitado',
                    'email' => 'guest_' . Str::uuid() . '@example.com',
                    'phone' => '000000000',
                ]);

                // Guardar el guest_id en una cookie
                cookie()->queue(cookie('guest_id', $guest->id, 60 * 24 * 7)); // Duración de 7 días
            }
        }

        return $next($request);
    }
}
