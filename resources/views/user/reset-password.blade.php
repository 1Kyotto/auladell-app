@extends('template.master')

@section('content')
<div class="relative w-full h-[70dvh] bg-custom-background bg-cover bg-center flex flex-col gap-8 items-center justify-center font-montserrat text-cwhite-500 px-4 md:px-20 xl:px-28">
    {{--OVERLAY--}}
    <div class="absolute inset-0 bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 opacity-85 z-0"></div>
    {{--OVERLAY--}}

    {{--MENSAJE--}}
    <p class="relative z-10 font-cinzel text-xl sm:text-3xl md:text-4xl">Restablecer contraseña</p>
    {{--MENSAJE--}}

    <div class="relative z-10 flex flex-col gap-3">
        {{--FORMULARIO DE LOGIN--}}
        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-3">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            {{--EMAIL--}}
            <input class="w-72 h-8 bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom" type="email" name="email" id="email" value="{{ request()->email }}" readonly>
            {{--EMAIL--}}

            {{--CONTRASEÑA--}}
            <input id="password" class="w-72 h-8 bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom" placeholder="Nueva Contraseña" type="password" name="password" autocomplete="new-password">
            {{--CONTRASEÑA--}}

            {{--REPETIR CONTRASEÑA--}}
            <input id="password_confirmation" class="w-72 h-8 bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom" placeholder="Repetir Contraseña" type="password" name="password_confirmation" autocomplete="password-confirmation">
            {{--REPETIR CONTRASEÑA--}}

            {{--BOTÓN--}}
            <div class="uppercase font-bold flex flex-col items-center w-full">
                <button type="submit">Cambiar contraseña</button>
                <svg class="w-[120px] h-3 text-cwhite-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                    <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                    <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
                </svg>
            </div>
            {{--BOTÓN--}}
        </form>
        {{--FORMULARIO DE LOGIN--}}
    </div>
</div>
@endsection