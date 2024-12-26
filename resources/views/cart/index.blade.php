@extends('template.master')

@section('content')
@if($products->isEmpty())
    <div class="w-full h-[70dvh] flex flex-col items-center justify-center font-montserrat">
        <div class="flex flex-col items-center justify-center gap-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-accents-900" viewBox="0 0 24 24" fill="none">
                <path d="M3.87289 17.0194L2.66933 9.83981C2.48735 8.75428 2.39637 8.21152 2.68773 7.85576C2.9791 7.5 3.51461 7.5 4.58564 7.5H19.4144C20.4854 7.5 21.0209 7.5 21.3123 7.85576C21.6036 8.21152 21.5126 8.75428 21.3307 9.83981L20.1271 17.0194C19.7282 19.3991 19.5287 20.5889 18.7143 21.2945C17.9 22 16.726 22 14.3782 22H9.62182C7.27396 22 6.10003 22 5.28565 21.2945C4.47127 20.5889 4.27181 19.3991 3.87289 17.0194Z" stroke="currentColor" stroke-width="1.5" />
                <path d="M17.5 7.5C17.5 4.46243 15.0376 2 12 2C8.96243 2 6.5 4.46243 6.5 7.5" stroke="currentColor" stroke-width="1.5" />
            </svg>
            <p class="text-3xl font-cinzel font-bold">Tu bolsa de compras está vacía</p>
            <a href="{{ route('jewelry.index', ['type' => 'all-products']) }}" class="uppercase flex justify-center font-bold bg-[#008769] w-full rounded-md py-2 text-cwhite-500">seguir comprando</a>
        </div>
    </div>
@else
    <div class="w-full flex items-center justify-center mt-6">
        <div class="w-[70%] flex items-center justify-center">
            <!-- Paso 1 -->
            <div class="flex items-center justify-center">
                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#008769] text-white font-bold">
                    1
                </div>
            </div>
        
            <!-- Línea entre pasos -->
            <div class="flex-1 h-[2px] bg-[#001b15] mx-4"></div>
        
            <!-- Paso 2 -->
            <div class="flex items-center">
                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#D8D8D8] text-[#7B7B7B] font-bold">
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
    <div class="w-full px-28 flex justify-between font-montserrat">
        <div class="w-[55%] mt-14 flex flex-col">
            <div class="flex items-center justify-between border-b-2 border-black">
                <h3 class="text-2xl font-cinzel font-bold">Carrito ({{ $items }})</h3>
                <div class="text-sm font-semibold px-16">Nombre</div>
                <div class="text-sm font-semibold px-16">Precio</div>
            </div>
            @foreach ($products as $product)
                {{--PROD--}}
                <div class="w-full mt-6 pb-3 flex justify-between">
                    {{--IMAGEN DEL PROD--}}
                    <img src="{{ asset('storage/' . $product->product->image) }}" class="h-32 w-32 object-cover" alt="{{ $product->name }}">
                    {{--IMAGEN DEL PROD--}}

                    {{--NOMBRE DEL PROD--}}
                    <div class="text-sm px-14 w-full flex flex-col gap-3">
                        <p class="font-semibold">{{ $product->product->name }}</p>
                        @if(!$product->product->is_active)
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">No Disponible</span>
                        @endif
                        @if($product->customizations->isNotEmpty())
                            <div class="text-xs text-gray-600">
                                <p class="font-semibold mb-2">Personalizaciones:</p>
                                @foreach($product->customizations as $customization)
                                    @if($customization->customizationOption && $customization->customizationOption->customization)
                                        <div class="flex gap-2 items-center ml-2">
                                            <span class="text-gray-500">{{ $customization->customizationOption->customization->name }}:</span>
                                            <span class="font-medium">{{ $customization->customizationOption->option_name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    {{--NOMBRE DEL PROD--}}

                    {{--PRECIO DEL PROD UNITARIAMENTE--}}
                    <span class="product-price text-sm flex gap-4 font-bold px-14" data-price="{{ $product->price }}">CL$ {{ number_format($product->price, 0) }}</span>
                    {{--PRECIO DEL PROD UNITARIAMENTE--}}

                </div>
                {{--PROD--}}
                {{--ELIMINAR UN PRODUCTO--}}
                <form method="POST" action="{{ route('cart.remove') }}" class="pb-3 flex items-start justify-end border-b border-[#CED4E0] mb-6" onsubmit="return false;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="is_active" value="{{ $product->product->is_active }}">
                    <button type="button" onclick="openDeleteModal(this)" 
                        class="flex items-center gap-2 {{ !$product->product->is_active ? 'text-red-600 animate-pulse' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                            <path d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>
                </form>
                {{--ELIMINAR UN PRODUCTO--}}
            @endforeach
        </div>
        <div class="w-[35%] min-h-[70dvh] mt-12 pt-2 flex flex-col h-full sticky top-0 z-50">
            <div class="border-b-2 border-black">
                <h3 class="text-2xl font-cinzel font-bold">Resumen del Pedido</h3>
            </div>
            <div class="w-full font-montserrat">
                <div class="w-full flex items-center justify-between mt-8 text-sm">
                    <span>Subtotal:</span>
                    <span id="subtotalPrice" class="font-bold"></span>
                </div>
                <div class="w-full flex items-center justify-between mt-3 text-sm">
                    <span>Envío:</span>
                    <span id="deliveryPrice" class="font-bold">CL$ {{number_format(20000, 0) }}</span>
                </div>
                <div class="w-full flex items-center justify-between mt-4 border-t border-[#CED4E0] mb-6">
                    <span class="pt-3 font-bold">TOTAL:</span>
                    <span id="totalPrice" class="pt-3 font-bold"></span>
                </div>
            </div>

            {{--IR AL PAGO--}}
            @php
                $hasUnavailableProducts = $products->contains(function($product) {
                    return !$product->product->is_active;
                });
            @endphp

            @if($hasUnavailableProducts)
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                    <p class="font-semibold">Hay productos no disponibles en tu carrito</p>
                    <p>Por favor, elimina los productos no disponibles antes de continuar con el pago.</p>
                </div>
            @endif

            @auth
                <a href="{{ route('cart.payment') }}" 
                   id="payment-button"
                   class="w-full font-montserrat rounded-lg py-2 font-bold flex items-center justify-center gap-3 {{ $hasUnavailableProducts ? 'bg-gray-300 cursor-not-allowed text-gray-500' : 'bg-[#008769] text-cwhite-500' }}"
                   {{ $hasUnavailableProducts ? 'onclick="return false;"' : '' }}>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M12 16V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5 15C5 11.134 8.13401 8 12 8C15.866 8 19 11.134 19 15C19 18.866 15.866 22 12 22C8.13401 22 5 18.866 5 15Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M16.5 9.5V6.5C16.5 4.01472 14.4853 2 12 2C9.51472 2 7.5 4.01472 7.5 6.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    IR AL PAGO
                </a>
            @else
                <a href="{{ route('cart.checkout') }}" 
                   id="payment-button"
                   class="w-full font-montserrat rounded-lg py-2 font-bold flex items-center justify-center gap-3 {{ $hasUnavailableProducts ? 'bg-gray-300 cursor-not-allowed text-gray-500' : 'bg-[#008769] text-cwhite-500' }}"
                   {{ $hasUnavailableProducts ? 'onclick="return false;"' : '' }}>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M12 16V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M5 15C5 11.134 8.13401 8 12 8C15.866 8 19 11.134 19 15C19 18.866 15.866 22 12 22C8.13401 22 5 18.866 5 15Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M16.5 9.5V6.5C16.5 4.01472 14.4853 2 12 2C9.51472 2 7.5 4.01472 7.5 6.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    IR AL PAGO
                </a>
            @endauth
            {{--IR AL PAGO--}}
        </div>
    </div>

    {{-- Modal de confirmación --}}
    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full mx-4">
            <h3 class="text-xl font-bold mb-4 font-cinzel">Confirmar eliminación</h3>
            <p class="text-gray-600 mb-1">¿Estás seguro de que deseas eliminar este producto del carrito?</p>
            <p class="text-gray-600 mb-6 font-bold">Si realizas esta acción, perderás las personalizaciones seleccionadas.</p>
            <div class="flex justify-end gap-4">
                <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">
                    Cancelar
                </button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentForm = null;

        function openDeleteModal(button) {
            currentForm = button.closest('form');
            const modal = document.getElementById('deleteConfirmModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteConfirmModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            currentForm = null;
        }

        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (currentForm) {
                currentForm.onsubmit = null; // Permitir el envío del formulario
                currentForm.submit();
            }
            closeDeleteModal();
        });

        // Cerrar modal al hacer clic fuera de él
        document.getElementById('deleteConfirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const productPrices = document.querySelectorAll(".product-price");
            const subtotalElement = document.getElementById("subtotalPrice");
            const totalElement = document.getElementById("totalPrice");
            const deliveryPrice = 20000; // Precio fijo del envío
    
            function calculatePrices() {
                let subtotal = 0;
    
                // Sumar los precios de todos los productos en el carrito
                productPrices.forEach(priceElement => {
                    const price = parseFloat(priceElement.getAttribute("data-price"));
                    subtotal += price;
                });
    
                // Formatear números con separadores
                const formatNumber = (number) => new Intl.NumberFormat("es-CL").format(Math.round(number));
    
                // Actualizar el subtotal y total en la vista
                subtotalElement.textContent = `CL$ ${formatNumber(subtotal)}`;
                totalElement.textContent = `CL$ ${formatNumber(subtotal + deliveryPrice)}`;
            }
    
            // Llamar a la función de cálculo al cargar la página
            calculatePrices();
        });
    </script>    
@endif
@endsection