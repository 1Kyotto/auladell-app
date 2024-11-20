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
                    <span class="text-xl font-semibold font-cinzel">Precio: CL$ <span id="base-price">{{ number_format($product->base_price, 0) }}</span></span>
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

            {{--OPCIONES DE PERSONALIZACIÓN--}}
            <div class="mt-5">
                <h3 id="opc" class="text-lg font-semibold font-cinzel">Opciones de Personalización</h3>
                <div class="flex flex-wrap justify-between gap-4 mt-4" id="materials-container">
                    {{--MATERIAL ORIGINAL--}}
                    <div class="w-[100px] h-36 flex flex-col pt-4 gap-4 items-center text-center border border-[#CED4E0] rounded-lg cursor-pointer material-card selected" data-price-adjustment="0" data-name="Original">
                        <span class="w-full h-12 font-montserrat font-bold">{{ $product->materials->pluck('name')->join(', ') }}</span>
                        <span class="w-full font-montserrat font-bold">${{ number_format($product->base_price, 0) }}</span>
                    </div>
                    {{--MATERIAL ORIGINAL--}}

                    {{--MATERIAL BASE AJUSTABLE--}}
                    @foreach ($product->customizationMaterials as $customizationMaterial)
                    <div class="w-[100px] h-36 flex flex-col pt-4 gap-4 items-center text-center border border-[#CED4E0] rounded-lg cursor-pointer material-card selected" data-price-adjustment="{{ $customizationMaterial->price_adjustment }}" data-name="{{ $customizationMaterial->material->name }}">
                        <span class="w-full h-12 font-montserrat font-bold">{{ $customizationMaterial->material->name }}</span>
                        <span class="w-full font-montserrat font-bold">${{ number_format($customizationMaterial->price_adjustment + $product->base_price, 0) }}</span>
                    </div>
                    @endforeach
                    {{--MATERIAL BASE AJUSTABLE--}}

                    {{--<div class="card material-card w-30 h-40 border border-[#CED4E0] p-4 rounded-lg text-center cursor-pointer selected" 
                         data-price-adjustment="0" 
                         data-name="Original">
                        <div class="circle bg-gray-300 h-10 w-10 mx-auto rounded-full mb-2"></div>
                        <span class="block font-semibold text-md">{{ $product->materials->pluck('name')->join(', ') }}</span>
                        <span class="block font-bold text-lg">{{ number_format($product->base_price, 0) }}</span>
                    </div>
                    Personalizaciones
                    @foreach($product->customizationMaterials as $customizationMaterial)
                        <div class="card material-card border border-[#CED4E0] p-4 rounded-lg text-center cursor-pointer" 
                             data-price-adjustment="{{ $customizationMaterial->price_adjustment }}" 
                             data-name="{{ $customizationMaterial->material->name }}">
                            <div class="circle bg-yellow-300 h-10 w-10 mx-auto rounded-full mb-2"></div>
                            <span class="font-semibold text-md">{{ $customizationMaterial->material->name }}</span>
                            <span class="font-bold text-md">CL$ {{ number_format($customizationMaterial->price_adjustment + $product->base_price, 0) }}</span>
                        </div>
                    @endforeach
                    --}}
                </div>
            </div>
            {{--OPCIONES DE PERSONALIZACIÓN--}}
        </div>
    </div>
</div>
{{--FUNCIONALIDAD DE PRECIO--}}
<script>
    const basePrice = {{ $product->base_price }};
    const basePriceElement = document.getElementById('base-price');
    const quantityElement = document.getElementById('quantity');
    const materialsContainer = document.getElementById('materials-container');
    let selectedPriceAdjustment = 0; // Default price adjustment

    // Actualiza el precio base y el total dinámicamente
    function updatePrices() {
        const quantity = parseInt(quantityElement.textContent);
        const adjustedBasePrice = (basePrice + selectedPriceAdjustment) * quantity;

        // Actualizar precio base dinámico
        basePriceElement.textContent = new Intl.NumberFormat().format(adjustedBasePrice);
    }

    // Escuchar clics en las cards de material
    materialsContainer.addEventListener('click', (event) => {
        const targetCard = event.target.closest('.material-card');
        if (targetCard) {
            // Actualizar selección visual
            document.querySelectorAll('.material-card').forEach(card => card.classList.remove('selected'));
            targetCard.classList.add('selected');

            // Actualizar price adjustment
            selectedPriceAdjustment = parseFloat(targetCard.dataset.priceAdjustment);
            updatePrices();
        }
    });

    // Manejar el incremento y decremento de cantidad
    function increaseValue() {
        let currentValue = parseInt(quantityElement.textContent);
        quantityElement.textContent = currentValue + 1;
        updatePrices();
    }

    function decreaseValue() {
        let currentValue = parseInt(quantityElement.textContent);
        if (currentValue > 1) {
            quantityElement.textContent = currentValue - 1;
            updatePrices();
        }
    }
</script>

{{-- Estilo CSS adicional para los cards --}}
<style>
    .material-card.selected {
        border: 1px solid #006c55;
    }
</style>
{{--FUNCIONALIDAD DE PRECIO--}}
@endsection
