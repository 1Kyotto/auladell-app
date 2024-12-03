@extends('template.master')

@section('content')
<div class="w-full flex items-center justify-center h-full">
    <div class="flex items-center justify-center w-1/3 h-4/5 border border-[#CED4E0]">
        <div class="flex flex-col w-full h-full p-3">
            <h4 class="font-cinzel font-bold text-xl">Seguimiento de pedido</h4>
            <p class="text-sm text-gray-600 mb-6">Ingresa el número de Orden para verificar cómo avanza tu pedido</p>

            <form action="{{ route('order.status') }}" method="POST" class="font-montserrat">
                @csrf
                <div>
                    <label for="order-num" class="block text-sm font-semibold text-gray-700 mb-1">Número de Orden</label>
                    <input type="text" id="order-num" name="order-num"
                           class="
                           @error('order-num') border-red-500 @else bg-white @enderror
                           w-full p-2 border border-gray-300 rounded-md focus:outline-none">
                
                        @error('order-num')
                            <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                </div>

                <button type="submit" class="w-full bg-[#008769] text-white font-semibold py-2 rounded-md mt-8">
                    Buscar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection