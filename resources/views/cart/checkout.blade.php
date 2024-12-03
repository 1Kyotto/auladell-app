@extends('template.master')

@section('content')
<div class="w-full flex items-center justify-center mt-6">
    <div class="w-[70%] flex items-center justify-center">
        <!-- Paso 1 -->
        <div class="flex items-center">
            <a href="{{ route('cart.index') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-[#008769] text-white font-bold">
                1
            </a>
        </div>
      
        <!-- Línea entre pasos -->
        <div class="flex-1 h-[2px] bg-[#001b15] mx-4"></div>
      
        <!-- Paso 2 -->
        <div class="flex items-center">
            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#008769] text-white font-bold">
                2
            </div>
        </div>
      
        <!-- Línea entre pasos -->
        <div class="flex-1 h-[2px] bg-gray-400 mx-4"></div>
      
        <!-- Paso 3 -->
        <div class="flex items-center">
            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#D8D8D8] text-[#7B7B7B] font-bold">
                3
            </div>
        </div>
    </div>
</div>
  
<div class="w-full px-28 flex flex-col items-center mt-16 font-montserrat h-[70dvh]">
    <h3 class="font-bold font-cinzel text-xl mb-12">Tu información</h3>
    <div class="text-black flex flex-col">
        {{--FORMULARIO DE ACTUALIZACIÓN DE INVITADO--}}
        <form method="POST" action="{{ route('cart.update.guest') }}" class="flex flex-col gap-6">
            @csrf
            @method('PUT')
            
            @if($errors->has('general'))
                <div class="text-red-500 text-sm">
                    {{ $errors->first('general') }}
                </div>
            @endif
            
            {{--NOMBRE--}}
            <div class="flex flex-col">
                <input id="name" 
                    class="w-72 bg-transparent border-b-2 rounded-sm px-3 py-2 outline-none @error('name') border-red-500 @else border-[#008769] @enderror sm:w-96 input-checkout" 
                    placeholder="Nombre" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    autofocus>
                @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            {{--NOMBRE--}}

            {{--EMAIL--}}
            <div class="flex flex-col">
                <input id="email" 
                    class="w-72 bg-transparent border-b-2 rounded-sm px-3 py-2 outline-none @error('email') border-red-500 @else border-[#008769] @enderror sm:w-96 input-checkout" 
                    placeholder="Correo Electrónico" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            {{--EMAIL--}}

            {{--TELÉFONO--}}
            <div class="flex flex-col">
                <input id="phone" 
                    class="w-72 bg-transparent border-b-2 rounded-sm px-3 py-2 outline-none @error('phone') border-red-500 @else border-[#008769] @enderror sm:w-96 input-checkout" 
                    placeholder="Teléfono" 
                    type="tel" 
                    name="phone" 
                    value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            {{--TELÉFONO--}}

            {{--BOTÓN--}}
            <div class="uppercase font-bold flex flex-col items-center w-full mt-5">
                <button type="submit" id="goToPaymentButton" class="w-full bg-[#008769] font-montserrat rounded-lg py-2 font-bold text-cwhite-500">
                    CONTINUAR CON EL PAGO
                </button>
            </div>
            {{--BOTÓN--}}
        </form>
        {{--FORMULARIO DE ACTUALIZACIÓN DE INVITADO--}}
    </div>
</div>
@endsection