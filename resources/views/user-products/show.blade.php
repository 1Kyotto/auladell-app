@extends('template.master')

@section('content')
<div class="px-40 py-9 w-full flex flex-col">
    <div class="flex justify-between">
        {{-- Imagen del Producto --}}
        <div class="w-[450px] h-[450px] sticky top-0 z-50 pt-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
        </div>

        {{-- Detalles del Producto --}}
        <div class="flex flex-col w-[450px] pt-6">
            <span class="text-2xl font-semibold font-cinzel pb-2">{{ $product->name }}</span>

            {{-- Precio Base --}}
            <div class="pt-10 sticky top-0 z-50 bg-cwhite-500">
                <div class="flex items-start justify-between pb-5 border-b border-[#CED4E0]">
                    <span class="text-xl font-semibold font-cinzel">
                        Precio: CL$ <span id="current-price">{{ $product->formatted_price }}</span>
                    </span>
                </div>
            </div>

            {{-- Opciones de Personalización --}}
            <div class="mt-5">
                <form id="customization-form" method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="total_price" id="total_price" value="{{ $product->final_price }}">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="customizations" id="customizations" value="[]">
                    @foreach($customizations as $customization)
                        <div class="mb-6" data-customization-id="{{ $customization['id'] }}">
                            <h3 class="text-lg font-semibold font-cinzel mb-3">{{ $customization['name'] }}</h3>
                            
                            @if($customization['name'] === 'Talla de anillo')
                                <div class="mb-6" data-customization-id="{{ $customization['id'] }}">
                                    <div class="flex justify-end items-center mb-3">
                                        <span 
                                            class="text-sm text-[#006C55] cursor-pointer hover:underline font-montserrat"
                                            onclick="openSizeGuide()"
                                        >
                                            Guía de tallas
                                        </span>
                                    </div>
                                    <select 
                                        class="w-full p-4 border-2 rounded-lg font-montserrat"
                                        data-customization-id="{{ $customization['id'] }}"
                                        data-customization-name="{{ strtolower($customization['name']) }}"
                                        onchange="handleRingSize(this)"
                                    >
                                        @foreach($customization['options'] as $option)
                                            <option 
                                                value="{{ $option['id'] }}"
                                                data-price-adjustment="{{ $option['price_adjustment'] }}"
                                                @if($option['is_default']) selected @endif
                                            >
                                                {{ $option['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($customization['name'] === 'Largo de cadena')
                                <div class="mb-6" data-customization-id="{{ $customization['id'] }}">
                                    <div class="flex justify-end items-center mb-3">
                                        <span 
                                            class="text-sm text-[#006C55] cursor-pointer hover:underline font-montserrat"
                                            onclick="openChainSizeGuide()"
                                        >
                                            Guía de medidas
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        @php
                                            $options = collect($customization['options']);
                                            $visibleOptions = $options;
                                            if ($product->category === 'Brazaletes') {
                                                $visibleOptions = $options->take(6);
                                            } else if ($product->category === 'Collares') {
                                                $visibleOptions = $options->slice(-4);
                                            }
                                            // Asegurarse de que la primera opción esté seleccionada por defecto
                                            $firstOption = $visibleOptions->first();
                                        @endphp
                                        @foreach($visibleOptions as $index => $option)
                                            <div class="customization-option border-2 rounded-lg p-4 cursor-pointer 
                                                    {{ $option === $firstOption ? 'selected-option bg-[#f0f9f7] border-[#006C55]' : 'border-gray-200' }}"
                                                data-option-id="{{ $option['id'] }}"
                                                data-price-adjustment="{{ $option['price_adjustment'] }}"
                                                data-customization-id="{{ $customization['id'] }}"
                                                data-customization-name="{{ strtolower($customization['name']) }}"
                                                data-is-default="{{ $index === 0 ? 'true' : 'false' }}">
                                                <p class="font-montserrat">{{ $option['name'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($customization['options'] as $option)
                                    <div class="customization-option border-2 rounded-lg p-4 cursor-pointer hover:border-[#006C55] transition-colors
                                            @if($option['is_default']) selected-option bg-[#f0f9f7] border-[#006C55] @else border-gray-200 @endif"
                                        data-option-id="{{ $option['id'] }}"
                                        data-material-id="{{ $option['material_id'] }}"
                                        data-quantity="{{ $option['quantity_needed'] }}"
                                        data-price-adjustment="{{ $option['price_adjustment'] }}"
                                        data-customization-id="{{ $customization['id'] }}"
                                        data-customization-name="{{ strtolower($customization['name']) }}"
                                        data-is-default="{{ $option['is_default'] ? 'true' : 'false' }}">
                                        <p class="font-montserrat">{{ $option['name'] }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach

                    {{-- Estado del Producto --}}
                    @if(!$product->is_active)
                        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                            <p class="font-semibold">Producto No Disponible</p>
                            <p class="text-sm">Este producto no está disponible actualmente.</p>
                        </div>
                    @endif
                    {{-- Botón Añadir al Carrito --}}
                    <div class="mt-8">
                        <button type="submit" 
                            class="w-full py-3 px-6 rounded-lg font-cinzel transition-colors {{ $product->is_active ? 'bg-[#006C55] hover:bg-[#005544] text-white' : 'bg-gray-300 cursor-not-allowed text-gray-500' }}"
                            {{ !$product->is_active ? 'disabled' : '' }}>
                            {{ $product->is_active ? 'Añadir al Carrito' : 'No Disponible' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Guía de Tallas -->
    <div id="sizeGuideModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg max-w-2xl w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-cinzel font-semibold">Guía de Tallas de Anillos</h2>
                <button onclick="closeSizeGuide()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="overflow-x-auto">
                <div class="max-h-[400px] overflow-y-auto">
                    <table class="w-full text-sm font-montserrat">
                        <thead class="sticky top-0 bg-white">
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 border">Diámetro (mm)</th>
                                <th class="px-4 py-2 border">Talla CL</th>
                                <th class="px-4 py-2 border">Circunferencia (mm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td class="px-4 py-2 border text-center">14.1</td><td class="px-4 py-2 border text-center">4</td><td class="px-4 py-2 border text-center">44.2</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 border text-center">14.5</td><td class="px-4 py-2 border text-center">6</td><td class="px-4 py-2 border text-center">45.5</td></tr>
                            <tr><td class="px-4 py-2 border text-center">14.9</td><td class="px-4 py-2 border text-center">8</td><td class="px-4 py-2 border text-center">46.8</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 border text-center">15.3</td><td class="px-4 py-2 border text-center">10</td><td class="px-4 py-2 border text-center">48.1</td></tr>
                            <tr><td class="px-4 py-2 border text-center">15.7</td><td class="px-4 py-2 border text-center">12</td><td class="px-4 py-2 border text-center">49.3</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 border text-center">16.1</td><td class="px-4 py-2 border text-center">14</td><td class="px-4 py-2 border text-center">50.6</td></tr>
                            <tr><td class="px-4 py-2 border text-center">16.5</td><td class="px-4 py-2 border text-center">16</td><td class="px-4 py-2 border text-center">51.9</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 border text-center">16.9</td><td class="px-4 py-2 border text-center">18</td><td class="px-4 py-2 border text-center">53.1</td></tr>
                            <tr><td class="px-4 py-2 border text-center">17.3</td><td class="px-4 py-2 border text-center">20</td><td class="px-4 py-2 border text-center">54.4</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 border text-center">17.7</td><td class="px-4 py-2 border text-center">22</td><td class="px-4 py-2 border text-center">55.7</td></tr>
                            <tr><td class="px-4 py-2 border text-center">18.1</td><td class="px-4 py-2 border text-center">24</td><td class="px-4 py-2 border text-center">56.9</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 border text-center">18.5</td><td class="px-4 py-2 border text-center">26</td><td class="px-4 py-2 border text-center">58.2</td></tr>
                            <tr><td class="px-4 py-2 border text-center">18.9</td><td class="px-4 py-2 border text-center">28</td><td class="px-4 py-2 border text-center">59.5</td></tr>
                            <tr class="bg-gray-50"><td class="px-4 py-2 border text-center">19.3</td><td class="px-4 py-2 border text-center">30</td><td class="px-4 py-2 border text-center">60.7</td></tr>
                            <tr><td class="px-4 py-2 border text-center">19.7</td><td class="px-4 py-2 border text-center">31</td><td class="px-4 py-2 border text-center">62.0</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-600">
                <p class="mt-2">* La circunferencia es la medida alrededor del dedo.</p>
            </div>
        </div>
    </div>

    <!-- Modal Guía de Tallas de Cadenas -->
    <div id="chainSizeGuideModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg max-w-2xl w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-cinzel font-semibold">
                    @if($product->category === 'Brazaletes')
                        Guía de Medidas para Brazaletes
                    @else
                        Guía de Medidas para Collares
                    @endif
                </h2>
                <button onclick="closeChainSizeGuide()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="overflow-x-auto">
                <div class="max-h-[400px] overflow-y-auto">
                    @if($product->category === 'Brazaletes')
                        <div class="p-4">
                            <h3 class="font-cinzel font-semibold mb-3">Cómo medir tu muñeca</h3>
                            <p class="mb-4 font-montserrat">Para encontrar tu talla perfecta de brazalete, sigue estos pasos:</p>
                            <ol class="list-decimal pl-5 mb-4 font-montserrat">
                                <li class="mb-2">Usa una cinta métrica flexible o una tira de papel alrededor de tu muñeca donde usarías el brazalete.</li>
                                <li class="mb-2">Si usas papel, marca donde se cruza y mide con una regla.</li>
                                <li class="mb-2">Añade 1-2 cm para un ajuste cómodo.</li>
                            </ol>
                            <div class="mt-4">
                                <h4 class="font-cinzel font-semibold mb-2">Medidas Recomendadas:</h4>
                                <ul class="list-disc pl-5 font-montserrat">
                                    <li>Ajuste Ceñido: 15-16 cm</li>
                                    <li>Ajuste Clásico: 17-18 cm</li>
                                    <li>Ajuste Holgado: 19-20 cm</li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="p-4">
                            <h3 class="font-cinzel font-semibold mb-3">Guía de Largos para Collares</h3>
                            <p class="mb-4 font-montserrat">Los diferentes largos de collar pueden crear distintos efectos:</p>
                            <ul class="space-y-3 font-montserrat">
                                <li><span class="font-semibold">40 cm - Gargantilla:</span> Se ajusta cerca del cuello.</li>
                                <li><span class="font-semibold">45 cm - Princesa:</span> Cae justo sobre la clavícula.</li>
                                <li><span class="font-semibold">50-55 cm - Matinée:</span> Cae sobre el busto.</li>
                            </ul>
                            <div class="mt-4">
                                <h4 class="font-cinzel font-semibold mb-2">Consejos de Estilo:</h4>
                                <ul class="list-disc pl-5 font-montserrat">
                                    <li>Para cuellos cortos: Prefiere largos de 45-50 cm</li>
                                    <li>Para cuellos largos: Puedes usar cualquier largo</li>
                                    <li>Para looks formales: 40-45 cm es ideal</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('customization-form');
        const options = document.querySelectorAll('.customization-option');
        const currentPrice = document.getElementById('current-price');
        const totalPriceInput = document.getElementById('total_price');
        const customizationsInput = document.getElementById('customizations');
        const basePrice = Math.round(parseFloat(totalPriceInput.value));

        // Objeto para mantener las selecciones actuales
        let currentSelections = {};

        // Función para manejar el cambio en el dropdown de talla de anillo
        window.handleRingSize = function(select) {
            const customizationName = select.dataset.customizationName;
            const customizationId = select.dataset.customizationId;
            const selectedOption = select.options[select.selectedIndex];
            
            currentSelections[customizationName] = {
                customizationId: customizationId,
                optionId: select.value,
                priceAdjustment: parseFloat(selectedOption.dataset.priceAdjustment || 0)
            };

            updateCustomizationsInput();
            updatePrice();
        };

        // Función para actualizar el input de customizations
        function updateCustomizationsInput() {
            const customizations = Object.entries(currentSelections).map(([customizationName, data]) => ({
                customization_id: data.customizationId,
                option_id: data.optionId,
                quantity: 1
            }));
            customizationsInput.value = JSON.stringify(customizations);
        }

        // Función para actualizar el precio
        function updatePrice() {
            let totalAdjustment = 0;
            Object.values(currentSelections).forEach(data => {
                totalAdjustment += data.priceAdjustment;
            });
            
            // Solo aplicar el redondeo atractivo al ajuste de precio
            if (totalAdjustment !== 0) {
                totalAdjustment = Math.round(totalAdjustment / 10) * 10; // round($price, -1)
                
                if (totalAdjustment % 100 < 50) {
                    totalAdjustment = Math.floor(totalAdjustment / 100) * 100 + 500;
                } else {
                    totalAdjustment = Math.ceil(totalAdjustment / 100) * 100 - 10;
                }
            }

            const newPrice = basePrice + totalAdjustment;
            currentPrice.textContent = new Intl.NumberFormat('es-CL', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(newPrice);
            totalPriceInput.value = newPrice;
        }

        // Inicializar las selecciones por defecto
        options.forEach(option => {
            if (option.classList.contains('selected-option')) {
                const customizationId = option.closest('[data-customization-id]').dataset.customizationId;
                const customizationName = option.dataset.customizationName;
                const optionId = option.dataset.optionId;
                const priceAdjustment = parseFloat(option.dataset.priceAdjustment || 0);

                currentSelections[customizationName] = {
                    customizationId: customizationId,
                    optionId: optionId,
                    priceAdjustment: priceAdjustment
                };
            }
        });

        // Actualizar inputs con las selecciones por defecto
        updateCustomizationsInput();
        updatePrice();

        // Event listener para las opciones de personalización
        options.forEach(option => {
            option.addEventListener('click', function() {
                const customizationContainer = this.closest('[data-customization-id]');
                const customizationId = customizationContainer.dataset.customizationId;
                const customizationName = this.dataset.customizationName;

                // Remover selección previa de TODAS las opciones del mismo tipo de personalización
                document.querySelectorAll(`[data-customization-name="${customizationName}"]`).forEach(opt => {
                    opt.classList.remove('selected-option', 'bg-[#f0f9f7]', 'border-[#006C55]');
                    opt.classList.add('border-gray-200');
                });

                // Aplicar nueva selección
                this.classList.add('selected-option', 'bg-[#f0f9f7]', 'border-[#006C55]');
                this.classList.remove('border-gray-200');

                // Actualizar selecciones actuales
                currentSelections[customizationName] = {
                    customizationId: customizationId,
                    optionId: this.dataset.optionId,
                    priceAdjustment: parseFloat(this.dataset.priceAdjustment || 0)
                };

                updateCustomizationsInput();
                updatePrice();
            });
        });

        // Validación del formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const customizationContainers = document.querySelectorAll('.mb-6[data-customization-id]');
            let allCustomizationsSelected = true;

            customizationContainers.forEach(container => {
                const customizationId = container.dataset.customizationId;
                const hasSelection = Object.values(currentSelections).some(
                    selection => selection.customizationId === customizationId
                );

                if (!hasSelection) {
                    allCustomizationsSelected = false;
                    container.querySelector('h3').scrollIntoView({ behavior: 'smooth' });
                }
            });

            if (!allCustomizationsSelected) {
                alert('Por favor, selecciona todas las opciones de personalización antes de continuar.');
                return;
            }

            this.submit();
        });
    });
</script>

<script>
    function openSizeGuide() {
        document.getElementById('sizeGuideModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSizeGuide() {
        document.getElementById('sizeGuideModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('sizeGuideModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSizeGuide();
        }
    });

    function openChainSizeGuide() {
        document.getElementById('chainSizeGuideModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeChainSizeGuide() {
        document.getElementById('chainSizeGuideModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Cerrar el modal al hacer clic fuera de él
    document.getElementById('chainSizeGuideModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeChainSizeGuide();
        }
    });
</script>
@endsection