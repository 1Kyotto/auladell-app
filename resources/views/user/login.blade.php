@extends('template.master')

@section('content')
<div class="relative w-full h-[70dvh] bg-custom-background bg-cover bg-center flex flex-col gap-8 items-center justify-center font-montserrat text-cwhite-500 px-4 md:px-20 xl:px-28">
    {{--OVERLAY--}}
    <div class="absolute inset-0 bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 opacity-85 z-0"></div>
    {{--OVERLAY--}}

    {{--MENSAJE--}}
    <p class="relative z-10 font-cinzel text-xl sm:text-3xl md:text-4xl">Hola, un gusto verte de nuevo</p>
    {{--MENSAJE--}}

    <div class="relative z-10 flex flex-col gap-3">
        {{--FORMULARIO DE LOGIN--}}
        <form method="POST" action="{{ route('user.login') }}" class="flex flex-col gap-3">
            @csrf

            {{--EMAIL--}}
            <input id="email" class="
            @error('email') border-red-500 bg-transparent @else border-cwhite-500 bg-transparent @enderror
            w-72 h-8 bg-transparent focus:bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom" placeholder="Correo Electrónico" type="text" name="email" value="{{ old('email') }}" autofocus>
            @error('email')
                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
            @enderror
            {{--EMAIL--}}

            {{--CONTRASEÑA--}}
            <input id="password" class="
            @error('password') border-red-500 bg-transparent @else border-cwhite-500 bg-transparent @enderror
            w-72 h-8 bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom" placeholder="Contraseña" type="password" name="password" autocomplete="current-password">
            @error('password')
                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
            @enderror
            {{--CONTRASEÑA--}}

            {{--RECUÉRDAME--}}
            <div class="">
                <label for="remember_me" class="flex gap-2">
                    <input id="remember_me" type="checkbox" class="" name="remember">
                    <span class="">Recuérdame</span>
                </label>
            </div>
            {{--RECUÉRDAME--}}

            {{--BOTÓN--}}
            <div class="uppercase font-bold flex flex-col items-center w-full">
                <button type="submit">Iniciar Sesión</button>
                <svg class="w-[120px] h-3 text-cwhite-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                    <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                    <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
                </svg>
            </div>
            {{--BOTÓN--}}
        </form>
        {{--FORMULARIO DE LOGIN--}}

        {{--CONTRASEÑA OLVIDADA--}}
        <a href="{{ route('password.request') }}" class="text-accents-300 font-bold flex w-full items-center justify-center">
            <p class="hover:text-cwhite-500">¿Olvidaste tu contraseña?</p>
        </a>
        {{--CONTRASEÑA OLVIDADA--}}
    </div>
    <div class="relative z-10 flex gap-8">
        <p class="">¿No tienes una cuenta?</p>
        <a href="{{ route('user.register') }}" class="group uppercase font-bold relative inline-block text-cwhite-500">
            Registrarse
            <svg class="w-[120px] h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
            </svg>
        </a>
    </div>
</div>
@endsection