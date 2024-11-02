@extends('template.master')

@section('content')
<div class="relative w-full h-[80dvh] bg-custom-background bg-cover bg-center flex flex-col gap-8 items-center justify-center font-montserrat text-cwhite-500 px-4 md:px-20 xl:px-28">
    {{--OVERLAY--}}
    <div class="absolute inset-0 bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 opacity-85 z-0"></div>
    {{--OVERLAY--}}

    {{--MENSAJE--}}
    <p class="relative z-10 font-cinzel text-xl text-center sm:text-3xl md:text-4xl">Crea tu cuenta <br> y <br> mantén tus joyas favoritas siempre a la vista</p>
    {{--MENSAJE--}}

    <div class="relative z-10 flex flex-col gap-8">
        {{--FORMULARIO DE LOGIN--}}
        <form method="POST" action="{{ route('user.register') }}" class="flex flex-col gap-5 items-center">
            @csrf

            <div class="flex flex-col lg:flex-row gap-5">
                {{--NOMBRE--}}
                <input id="name" class="w-72 h-8 bg-transparent focus:bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom lg:w-60" placeholder="Nombre" type="text" name="name" value="{{ old('name') }}" autofocus>
                {{--NOMBRE--}}
    
                {{--APELLIDOS--}}
                <input id="surname" class="w-72 h-8 bg-transparent focus:bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom lg:w-60" placeholder="Apellidos" type="text" name="apellido" value="{{ old('apellido') }}" autofocus>
                {{--APELLIDOS--}}
            </div>

            {{--EMAIL--}}
            <input id="email" class="w-72 h-8 bg-transparent focus:bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom lg:w-full" placeholder="Correo Electrónico" type="text" name="email" value="{{ old('email') }}" autofocus>
            {{--EMAIL--}}

            <div class="flex flex-col lg:flex-row gap-5">
                {{--CONTRASEÑA--}}
                <input id="password" class="w-72 h-8 bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom lg:w-60" placeholder="Contraseña" type="password" name="password" autocomplete="current-password">
                {{--CONTRASEÑA--}}
    
                {{--CONFIRMAR CONTRASEÑA--}}
                <input id="password_confirmation" class="w-72 h-8 bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom lg:w-60" placeholder="Confirmar Contraseña" type="password" name="password_confirmation">
                {{--CONFIRMAR CONTRASEÑA--}}
            </div>

            {{--TELÉFONO--}}
            <input id="phone" class="w-72 h-8 bg-transparent border-b-2 outline-none border-cwhite-500 sm:w-96 input-custom lg:w-full" placeholder="Teléfono" type="text" name="phone" value="{{ old('phone') }}">
            {{--TELÉFONO--}}

            {{--BOTÓN--}}
            <div class="uppercase font-bold flex flex-col items-center w-full">
                <button type="submit">Crear Cuenta</button>
                <svg class="w-[120px] h-3 text-cwhite-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                    <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                    <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
                </svg>
            </div>
            {{--BOTÓN--}}
        </form>
        {{--FORMULARIO DE LOGIN--}}

        {{--INICIO DE SESIÓN--}}
        <div class="relative z-10 flex gap-8 w-full justify-center">
            <p class="">¿Ya tienes una cuenta?</p>
            <a href="{{ route('user.login') }}" class="group uppercase font-bold relative inline-block text-cwhite-500">
                Iniciar Sesión
                <svg class="w-[140px] h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                    <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                    <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
                </svg>
            </a>
        </div>
        {{--INICIO DE SESIÓN--}}
    </div>
</div>
@endsection