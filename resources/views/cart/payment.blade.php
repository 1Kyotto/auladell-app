@extends('template.master')

@section('content')
<div class="w-full flex items-center justify-center mt-6">
    <div class="w-[70%] flex items-center justify-center">
        <!-- Paso 1 -->
        <div class="flex items-center">
            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#008769] text-white font-bold">
                1
            </div>
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
        <div class="flex-1 h-[2px] bg-[#001b15] mx-4"></div>
      
        <!-- Paso 3 -->
        <div class="flex items-center">
            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#008769] text-white font-bold">
                3
            </div>
        </div>
    </div>
</div>

<div class="w-full px-28 flex flex-col items-center mt-16 font-montserrat">
    <div class="flex items-center justify-between w-full">
        <label class="flex items-center gap-4">
            <input id="visa" type="radio" name="card-option">
            <div class="w-28 h-14 flex items-center justify-center border border-cblack-500 rounded-lg">
                <img class="w-22 h-6" src="{{ asset('images/visa-logo.png') }}" alt="">
            </div>
        </label>
        <label id="mastercard" class="flex items-center gap-4">
            <input type="radio" name="card-option">
            <div class="w-28 h-14 flex items-center justify-center border border-cblack-500 rounded-lg">
                <img class="w-26 h-16" src="{{ asset('images/mastercard-logo.png') }}" alt="">
            </div>
        </label>
        <label id="mach" class="flex items-center gap-4">
            <input type="radio" name="card-option">
            <div class="w-28 h-14 flex items-center justify-center border border-cblack-500 rounded-lg">
                <img class="w-26 h-16" src="{{ asset('images/machcard-logo.png') }}" alt="">
            </div>
        </label>
    </div>
    <div class="w-full mt-16 flex items-center justify-center">
        <form action="{{ route('payment.store') }}" method="POST" class="font-cinzel font-semibold text-md">
            @csrf
            <div class="flex flex-col gap-8">
                <div class="flex gap-4 items-center w-full">
                    <label for="name-cardholder" class="uppercase pl-2 w-[30%]">titular de la tarjeta</label>
                    <input type="text" id="name-cardholder" name="name-cardholder" placeholder="Nombre" class="bg-[#E0EFEC] border border-[#737878] w-[70%] rounded-lg py-1 px-4">
                </div>
                <div class="flex gap-4 items-center w-full">
                    <label for="card-number" class="uppercase pl-1 w-[30%]">número de la tarjeta</label>
                    <input type="text" id="card-number" name="card-number" class="bg-[#E0EFEC] w-[70%] border border-[#737878] rounded-lg py-1 px-4">
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex gap-4 items-center">
                        <label for="expiry-date" class="uppercase pl-3 w-[30%]">fecha de expiración</label>
                        <input type="text" id="month" name="expiry-date" placeholder="MES" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-[35%]">
                        <input type="text" id="year" name="expiry-date" placeholder="AÑO" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-[35%]">
                    </div>
                    <div class="flex gap-4 items-center justify-end">
                        <label for="card-cvv" class="uppercase pl-5">cvv</label>
                        <input type="text" id="card-cvv" name="card-cvv" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4">
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col font-montserrat gap-3 font-medium text-sm mt-9 border border-[#CED4E0] rounded-md py-3 px-6">
                <div class="flex justify-between w-full">
                    <span class="font-semibold">Subtotal</span>
                    <span class="font-semibold">CL$ {{ number_format($totalPrice, 0) }}</span>
                </div>
                <div class="flex justify-between w-full">
                    <span>Costo de Envío</span>
                    <span>CL$ 20,000</span>
                </div>
            </div>
            <div class="w-full flex flex-col font-montserrat gap-3 font-medium text-sm mt-9 border border-[#CED4E0] rounded-md py-3 px-6">
                <div class="flex justify-between w-full">
                    <span class="font-semibold">MONTO TOTAL</span></span>
                    <span class="font-semibold">CL$ {{ number_format($totalPrice + 20000, 0) }}</span>
                </div>
            </div>

            <div class="w-full flex flex-col font-montserrat gap-3 font-medium text-sm mt-9 border border-[#CED4E0] rounded-md py-3 px-6">
                <div class="flex justify-between w-full">
                    <span class="font-semibold">INFORMACIÓN DE ENVÍO</span>
                </div>
                <div class="flex justify-between gap-4 w-full">
                    <div class="flex justify-between items-center w-1/2">
                        <label for="shipping-city" class="uppercase">Ciudad</label>
                        <input type="text" id="shipping-city" name="shipping-city" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-[70%]">
                    </div>
                    <div class="flex justify-between items-center w-1/2">
                        <label for="shipping-locality" class="uppercase">Comuna</label>
                        <input type="text" id="shipping-locality" name="shipping-locality" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-[70%]">
                    </div>
                </div>
                <div class="flex gap-4 items-center w-full">
                    <label for="shipping-address" class="uppercase">Dirección</label>
                    <input type="text" id="shipping-address" name="shipping-address" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-full">
                </div>
            </div>
            <div class="w-full flex justify-center mt-12 mb-12">
                <button type="submit" class="w-full bg-[#008769] font-montserrat rounded-lg py-2 font-bold text-cwhite-500">
                    CONFIRMAR PAGO
                </button>
            </div>
        </form>
    </div>
</div>
@endsection