@extends('template.master')

@section('content')
<div class="px-40 py-9 w-full flex flex-col">
    <div class="flex justify-between">
        <div class="w-[350px] h-[350px]">
            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="h-full w-full">
        </div>
        <div class="flex flex-col w-[400px]">
            <span class="text-2xl font-semibold font-cinzel">{{ $product->name }}</span>
            <div class="pt-10">
                <div class="flex items-start justify-between pb-5 border-b border-[#CED4E0]">
                    <span class="text-xl font-semibold font-cinzel">CL$ {{ number_format($product->base_price, 0) }}</span>
                    <div class="cursor-pointer w-20 h-9 bg-[#c8e3de] border border-[#006c55] rounded-xl flex items-center justify-between font-cinzel text-lg font-semibold px-2">
                        <div class="h-full w-5 flex items-center justify-start" onclick="decreaseValue()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 24 24" fill="none">
                                <path d="M20 12L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span id="quantity">1</span>
                        <div class="h-full w-5 flex items-center justify-end" onclick="increaseValue()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 24 24" fill="none">
                                <path d="M12 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-start mt-14">
        <h4 class="font-cinzel text-xl font-semibold">Variaciones del Producto</h4>
        {{-- Mostrar variaciones --}}
        <div class="w-full flex items-center justify-between mt-10">
            <div class="flex items-center justify-between w-full gap-12 pt-3">
                @foreach ($variations as $variation)
                    <a href="{{ route('jewelry.show', ['id' => $variation->id]) }}" class="flex flex-col gap-2 items-center justify-start w-[30%] h-[340px]">
                        <img src="{{ asset('storage/' . $variation->image) }}" alt="{{ $variation->name }}" class="w-[220px] h-[220px] object-cover mb-2">
                        <span class="font-cinzel text-lg min-h-[50px]">{{ $variation->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function increaseValue() {
        let quantityElement = document.getElementById('quantity');
        let currentValue = parseInt(quantityElement.textContent);
        quantityElement.textContent = currentValue + 1;
    }

    function decreaseValue() {
        let quantityElement = document.getElementById('quantity');
        let currentValue = parseInt(quantityElement.textContent);
        if (currentValue > 1) {
            quantityElement.textContent = currentValue - 1;
        }
    }
</script>
@endsection