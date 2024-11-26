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
            <a href="{{ route('cart.checkout') }}" class="w-8 h-8 flex items-center justify-center rounded-full bg-[#008769] text-white font-bold">
                2
            </a>
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
            
            {{--NOMBRE--}}
            <input id="name" class="w-72 bg-transparent border-b-2 rounded-sm px-3 py-2 outline-none border-[#008769] sm:w-96 input-checkout" placeholder="Nombre" type="text" name="name" value="{{ old('name') }}" autofocus>
            {{--NOMBRE--}}

            {{--EMAIL--}}
            <input id="email" class="w-72 bg-transparent border-b-2 rounded-sm px-3 py-2 outline-none border-[#008769] sm:w-96 input-checkout" placeholder="Correo Electrónico" type="text" name="email" value="{{ old('email') }}" autofocus>
            {{--EMAIL--}}

            {{--TELÉFONO--}}
            <input id="phone" class="w-72 bg-transparent border-b-2 rounded-sm px-3 py-2 outline-none border-[#008769] sm:w-96 input-checkout" placeholder="Teléfono" type="text" name="phone" value="{{ old('phone') }}">
            {{--TELÉFONO--}}

            {{--BOTÓN--}}
            <div class="uppercase font-bold flex flex-col items-center w-full mt-5">
                <button type="submit" id="goToPaymentButton" class="w-full bg-[#008769] font-montserrat rounded-lg py-2 font-bold text-cwhite-500">
                    CONTINUAR CON EL PAGO
                </button>
            </div>
            {{--BOTÓN--}}

            {{--INFORMACIÓN COMPROBANTE ELEC--}}
            <div class="w-full font-montserrat text-sm flex items-center justify-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-black w-5 h-5" viewBox="0 0 24 24" fill="none">
                    <path d="M20.016 2C18.9026 2 18 4.68629 18 8H20.016C20.9876 8 21.4734 8 21.7741 7.66455C22.0749 7.32909 22.0225 6.88733 21.9178 6.00381C21.6414 3.67143 20.8943 2 20.016 2Z" stroke="currentColor" stroke-width="1.5" />
                    <path d="M18 8.05426V18.6458C18 20.1575 18 20.9133 17.538 21.2108C16.7831 21.6971 15.6161 20.6774 15.0291 20.3073C14.5441 20.0014 14.3017 19.8485 14.0325 19.8397C13.7417 19.8301 13.4949 19.9768 12.9709 20.3073L11.06 21.5124C10.5445 21.8374 10.2868 22 10 22C9.71321 22 9.45546 21.8374 8.94 21.5124L7.02913 20.3073C6.54415 20.0014 6.30166 19.8485 6.03253 19.8397C5.74172 19.8301 5.49493 19.9768 4.97087 20.3073C4.38395 20.6774 3.21687 21.6971 2.46195 21.2108C2 20.9133 2 20.1575 2 18.6458V8.05426C2 5.20025 2 3.77325 2.87868 2.88663C3.75736 2 5.17157 2 8 2H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 6H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 10H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M12.5 10.875C11.6716 10.875 11 11.4626 11 12.1875C11 12.9124 11.6716 13.5 12.5 13.5C13.3284 13.5 14 14.0876 14 14.8125C14 15.5374 13.3284 16.125 12.5 16.125M12.5 10.875C13.1531 10.875 13.7087 11.2402 13.9146 11.75M12.5 10.875V10M12.5 16.125C11.8469 16.125 11.2913 15.7598 11.0854 15.25M12.5 16.125V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                <p class="break-words">Tu comprobante será envíado <br> por correo electrónico.</p>
            </div>
            {{--INFORMACIÓN COMPROBANTE ELEC--}}
        </form>
        {{--FORMULARIO DE ACTUALIZACIÓN DE INVITADO--}}
    </div>
</div>
@endsection