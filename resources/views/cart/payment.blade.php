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
                <img class="w-22 h-6" src="{{ asset('images/visa-logo.png') }}" alt="Visa">
            </div>
        </label>
        <label id="mastercard" class="flex items-center gap-4">
            <input type="radio" name="card-option">
            <div class="w-28 h-14 flex items-center justify-center border border-cblack-500 rounded-lg">
                <img class="w-26 h-16" src="{{ asset('images/mastercard-logo.png') }}" alt="MasterCard">
            </div>
        </label>
        <label id="mach" class="flex items-center gap-4">
            <input type="radio" name="card-option">
            <div class="w-28 h-14 flex items-center justify-center border border-cblack-500 rounded-lg">
                <img class="w-26 h-16" src="{{ asset('images/machcard-logo.png') }}" alt="MachCard">
            </div>
        </label>
    </div>
    <div class="w-full mt-16 flex items-center justify-center">
        <form action="{{ route('payment.store') }}" method="POST" class="font-cinzel font-semibold text-md">
            @csrf
            <div class="flex flex-col gap-8">
                <div class="flex gap-4 items-center">
                    <label for="name-cardholder" class="uppercase pl-2">titular de la tarjeta</label>
                    <input type="text" id="name-cardholder" name="name-cardholder" placeholder="Nombre" class="border rounded-lg py-1 px-4 w-[528px] 
                    @error('name-cardholder') border-red-500 bg-[#E0EFEC] @else border-[#737878] bg-[#E0EFEC] @enderror">
                    @error('name-cardholder')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex gap-4 items-center">
                    <label for="card-number" class="uppercase pl-1">número de la tarjeta</label>
                    <input type="text" id="card-number" name="card-number" class=" border rounded-lg py-1 px-4 w-[528px] 
                    @error('card-number') border-red-500 bg-[#E0EFEC] @else border-[#737878] bg-[#E0EFEC] @enderror">
                    @error('card-number')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex">
                    <div class="flex gap-4 items-center">
                        <label for="expiry-date" class="uppercase pl-3">fecha de expiración</label>
                        <input type="text" id="month" name="expiry-date" placeholder="MES" class="border rounded-lg py-1 px-4 w-20 
                        @error('expiry-date') border-red-500 bg-[#E0EFEC] @else border-[#737878] bg-[#E0EFEC] @enderror">

                        <input type="text" id="year" name="expiry-date" placeholder="AÑO" class="border rounded-lg py-1 px-4 w-20 
                        @error('expiry-date') border-red-500 bg-[#E0EFEC] @else border-[#737878] bg-[#E0EFEC] @enderror">
                        @error('expiry-date')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex gap-4 items-center">
                        <label for="card-cvv" class="uppercase pl-5">cvv</label>
                        <input type="text" id="card-cvv" name="card-cvv" class="border rounded-lg py-1 px-4 w-24 
                        @error('card-cvv') border-red-500 bg-[#E0EFEC] @else border-[#737878] bg-[#E0EFEC] @enderror">
                        @error('card-cvv')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col font-montserrat gap-3 font-medium text-sm mt-9 border border-[#CED4E0] rounded-md py-3 px-6">
                <div class="flex justify-between w-full">
                    <span class="font-semibold">Subtotal <span class="font-medium">()</span></span>
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
                        <input type="text" id="shipping-city" name="shipping-city" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-[75%]
                        @error('shipping-city') border-red-500 bg-[#E0EFEC] mx-2 @else border-[#737878] bg-[#E0EFEC] @enderror">
                        @error('shipping-city')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center w-1/2">
                        <label for="shipping-locality" class="uppercase">Comuna</label>
                        <input type="text" id="shipping-locality" name="shipping-locality" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-[75%]
                        @error('shipping-locality') border-red-500 bg-[#E0EFEC] mx-2 @else border-[#737878] bg-[#E0EFEC] @enderror">
                        @error('shipping-locality')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex gap-4 items-center w-full">
                    <label for="shipping-address" class="uppercase">Dirección</label>
                    <input type="text" id="shipping-address" name="shipping-address" class="bg-[#E0EFEC] border border-[#737878] rounded-lg py-1 px-4 w-full
                    @error('shipping-address') border-red-500 bg-[#E0EFEC] @else border-[#737878] bg-[#E0EFEC] @enderror">
                    @error('shipping-address')
                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
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