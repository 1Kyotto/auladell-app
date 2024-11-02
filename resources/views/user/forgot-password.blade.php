@extends('template.master')

@section('content')
<div class="relative py-6 w-full bg-custom-background bg-cover bg-center flex flex-col gap-8 items-center justify-center font-montserrat text-cwhite-500 px-4 md:px-20 xl:px-28">
    {{--OVERLAY--}}
    <div class="absolute inset-0 bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 opacity-85 z-0"></div>
    {{--OVERLAY--}}

    {{--MENSAJE--}}
    <div class="text-center">
        <p class="relative z-10 font-cinzel text-xl sm:text-3xl md:text-4xl">¿Olvidaste tu contraseña?</p>
        <p class="relative z-10 font-cinzel text-xl sm:text-3xl md:text-4xl">Ingresa tu correo electrónico <br> para recuperar tu cuenta.</p>
        <p class="relative z-10 font-cinzel text-sm sm:text-base md:text-base pt-6">Se te enviará un correo electrónico a la dirección asociada a tu cuenta. <br> Este correo contendrá un enlace seguro que te permitirá crear una nueva contraseña.</p>
    </div>
    {{--MENSAJE--}}

    <div class="relative z-10 flex flex-col gap-3">
        {{--FORMULARIO DE LOGIN--}}
        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-3">
            @csrf

            {{--EMAIL--}}
            <input id="email" class="w-72 h-8 bg-transparent focus:bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom" placeholder="Correo Electrónico" type="text" name="email" value="{{ old('email') }}" autofocus>
            {{--EMAIL--}}

            {{--BOTÓN--}}
            <div class="uppercase font-bold flex flex-col items-center w-full">
                <button type="submit">Enviar enlace de restablecimiento.</button>
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