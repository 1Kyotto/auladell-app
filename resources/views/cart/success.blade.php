@extends('template.master')

@section('content')
<div class="w-full flex items-center justify-center my-12 font-montserrat">
    <div class="bg-white shadow-lg rounded-md p-8 w-[70%]">
        <div class="w-full flex justify-center">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#E4F3ED]">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#008769]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-6 h-6" viewBox="0 0 24 24" fill="none">
                        <path d="M5 14L8.5 17.5L19 6.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-[#008769] mb-5 font-cinzel w-full flex justify-center">¡Pago realizado con éxito!</h2>
        
        <div class="p-6 rounded-md mb-6">
            <div class="border-t-2 border-gray-300 border-dashed"></div>
            <h3 class="text-xl font-semibold text-gray-800 mt-2 mb-4">Detalles de la Orden</h3>
            <p class="text-sm text-gray-700 mb-2"><strong>Número de Orden:</strong> {{ $orderNumber }}</p>
            <p class="text-sm text-gray-700 mb-2"><strong>Método de Pago:</strong> {{ $paymentMethod }}</p>
            <p class="text-sm text-gray-700 mb-2"><strong>Fecha:</strong> {{ $paymentDate }}</p>
            <p class="text-sm text-gray-700 mb-2"><strong>Hora:</strong> {{ $paymentTime }}</p>

            <div class="border-t-2 border-gray-300 border-dashed"></div>
            <p class="text-sm text-gray-700 mt-3"><strong>Total Pagado:</strong> CL$ {{ number_format($totalPrice, 0) }}</p>

            <div class="border-b border-gray-300 mt-4"></div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('home.index') }}" class="bg-[#008769] text-white py-2 px-6 rounded-md">
                Volver al Inicio
            </a>
        </div>
    </div>
</div>
@endsection