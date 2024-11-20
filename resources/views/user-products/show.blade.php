@extends('template.master')

@section('content')
<div class="px-40 py-9 w-full flex flex-col">
    <div class="flex justify-between">
        <div class="w-[350px] h-[350px]">
            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="h-full w-full">
        </div>
        <div class="flex flex-col w-[400px]">
            <span class="text-2xl font-semibold font-cinzel">{{ $product->name }} {{ $product->materials->pluck('name')->join(', ') }}</span>
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

            {{-- Mostrar las opciones de personalización con ajustes de precio --}}
            <div class="mt-5">
                <h3 class="text-lg font-semibold font-cinzel">Opciones de Personalización</h3>
                <ul>
                    @foreach($product->customizationMaterials as $customizationMaterial)
                        <li class="text-md">
                            Material: {{ $customizationMaterial->material->name }} - Ajuste de precio: CL$ {{ number_format($customizationMaterial->price_adjustment, 0) }}
                        </li>
                    @endforeach
                </ul>
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