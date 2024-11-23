@extends('template.master')

@section('content')
<div class="px-40 py-9 w-full flex flex-col">
    <div class="flex justify-between">
        <div class="w-[450px] h-[450px]">
            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="h-full w-full">
        </div>
        <div class="flex flex-col w-[450px]">
            <span id="product-name" class="text-2xl font-semibold font-cinzel pb-2">
                {{ $product->name }}
                <span id="product-materials" class="text-2xl font-semibold font-cinzel">
                    {{ $defaultMaterial->material->name ?? '' }}
                </span>
            </span>
            <div class="pt-10">
                <div class="flex items-start justify-between pb-5 border-b border-[#CED4E0]">
                    {{--PRECIO ACTUAL--}}
                    <span class="text-xl font-semibold font-cinzel">Precio: CL$ <span class="base-price">{{ number_format(($product->base_price), 0) }}</span></span>
                    {{--PRECIO ACTUAL--}}
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
                <div class="flex flex-wrap gap-4" id="materials-container">
                    {{--MATERIAL BASE AJUSTABLE--}}
                    @foreach ($materialOptions as $materialOption)
                    <div class="material-card w-[100px] h-36 flex flex-col pt-4 gap-4 items-center text-center text-sm border border-[#CED4E0] rounded-lg cursor-pointer {{ $defaultMaterial && $defaultMaterial->customization_option_id == $materialOption->id ? 'default' : '' }}">
                        <span id="option-name" class="w-full h-12 font-cinzel font-bold">{{ $materialOption->option_name }}</span>
                        <span id="final-price" class="w-full font-montserrat font-bold hidden">
                            CL$ {{ number_format(($alternativeMaterials->where('customization_option_id', $materialOption->id)->first()?->final_price ?? $product->base_price), 0) }}
                        </span>
                    </div>
                    @endforeach
                    {{--MATERIAL BASE AJUSTABLE--}}

                    {{--LONGITUD AJUSTABLE--}}
                    @if ($chainOptions -> isNotEmpty())
                    <div class="flex flex-col w-full">
                        <div class="flex justify-between items-start w-full">
                            <h3 class="text-sm font-semibold font-montserrat">
                                Longitud del {{ $product->category === 'Brazaletes' ? 'Brazalete' : 'Collar' }}:
                            </h3>
                            <span class="cursor-pointer underline text-sm text-[#808080] font-montserrat font-semibold">Guía de Tallas</span>
                        </div>
                        {{--DROPDOWN--}}
                        <div class="mt-3 relative text-md">
                            <button id="dropdownButton"
                                    class="border border-[#74777e] rounded-sm py-2 px-4 w-full flex items-center justify-between"
                                    onclick="toggleMenuAndSetDefault()">
                                <span id="buttonText"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6" fill="none">
                                    <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu hidden border-x border-b border-[#74777e] w-full">
                                @foreach ($chainOptions as $chainOption)
                                    <li class="cursor-pointer px-4 py-2 hover:bg-[#d8dadf]">{{ $chainOption->option_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        {{--DROPDOWN--}}
                    </div>
                    @endif
                    {{--LONGITUD AJUSTABLE--}}

                    {{--TALLA AJUSTABLE--}}
                    @if ($sizeOptions -> isNotEmpty() && $product->category == 'Anillos')
                    <div class="flex flex-col w-full">
                        <div class="flex justify-between items-start w-full">
                            <h3 class="text-sm font-semibold font-montserrat">
                                Talla del anillo
                            </h3>
                            <span class="cursor-pointer underline text-sm text-[#808080] font-montserrat font-semibold">Guía de Tallas</span>
                        </div>
                        {{--DROPDOWN--}}
                        <div class="mt-3 relative text-md">
                            <button id="dropdownButton"
                                    class="border border-[#74777e] rounded-sm py-2 px-4 w-full flex items-center justify-between"
                                    onclick="toggleMenuAndSetDefault()">
                                <span id="buttonText"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6" fill="none">
                                    <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu hidden border-x border-b border-[#74777e] w-full">
                                @foreach ($sizeOptions as $sizeOption)
                                    <li class="cursor-pointer px-4 py-2 hover:bg-[#d8dadf]">{{ $sizeOption->option_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        {{--DROPDOWN--}}
                    </div>
                    @endif
                    {{--TALLA AJUSTABLE--}}

                    <span class="bg-[#CED4E0] w-full h-[1px]"></span>

                    {{--INCRUSTACIÓN--}}
                    @if ($product->inlay == true)
                    <div class="parent-inlay flex flex-wrap gap-4 mt-3">
                        <div class="w-full font-cinzel font-bold">Incrustación</div>
                        {{--NO SE QUIERE INCRUSTACIÓN--}}
                        <div id="inlay-card" class="no-inlay w-[100px] h-36 flex flex-col pt-4 gap-4 items-center text-center text-sm border border-[#CED4E0] rounded-lg cursor-pointer">
                            <span id="inlay-name" class="h-12 font-montserrat font-bold">Sin Incrustación</span>
                        </div>
                        {{--NO SE QUIERE INCRUSTACIÓN--}}

                        {{--SE QUIERE INCRUSTACIÓN--}}
                        @foreach ($inlayOptions as $option)
                        @php
                            $customizationMaterial = $option->customizationMaterials->first(); // Obtener el primer material relacionado
                            $priceAdjustment = $customizationMaterial->price_adjustment ?? 0; // Precio de ajuste o 0 si no existe
                            $quantityNeeded = $customizationMaterial->quantity_needed ?? 0; // Cantidad necesaria o 0 si no existe
                        @endphp
                        <div id="inlay-card" class="w-[100px] h-36 flex flex-col pt-4 gap-1 items-center text-center text-sm border border-[#CED4E0] rounded-lg cursor-pointer">
                            <span id="inlay-quantity-needed" class="w-full font-montserrat font-semibold">
                                {{ $quantityNeeded }} <br> quilate
                            </span>
                            <span id="inlay-name" class="w-full pt-2 h-6 font-cinzel font-bold">{{ $option->option_name }}</span>
                            <span id="inlay-final-price" class="w-full font-montserrat font-bold hidden">
                                CL$ {{ number_format(($priceAdjustment), 0) }}
                            </span>
                        </div>
                        @endforeach
                        {{--SE QUIERE INCRUSTACIÓN--}}
                    </div>
                    <span class="bg-[#CED4E0] w-full mt-3 h-[1px]"></span>
                    @endif
                    {{--INCRUSTACIÓN--}}

                    {{--BAÑADO EN MATERIAL--}}
                    <div class="parent-plated flex flex-wrap gap-4 mt-3">
                        <div class="w-full font-cinzel font-bold">Bañado en</div>
                        {{--NO SE QUIERE BAÑADO--}}
                        <div id="plated-card" class="no-plated w-[100px] h-36 flex flex-col pt-4 gap-4 items-center text-center text-sm border border-[#CED4E0] rounded-lg cursor-pointer">
                            <span id="plated-name" class="h-12 font-montserrat font-bold">Sin bañado</span>
                        </div>
                        {{--NO SE QUIERE BAÑADO--}}
                        @foreach ($platedOptions as $platedOption)
                        @php
                            $customizationMaterial = $platedOption->customizationMaterials->first(); // Obtener el primer material relacionado
                            $priceAdjustment = $customizationMaterial->price_adjustment ?? 0; // Precio de ajuste o 0 si no existe
                            $quantityNeeded = $customizationMaterial->quantity_needed ?? 0; // Cantidad necesaria o 0 si no existe
                        @endphp
                        <div id="plated-card" 
                        class="w-[100px] h-36 flex flex-col pt-4 gap-4 items-center text-center text-sm border border-[#CED4E0] rounded-lg cursor-pointer {{ $defaultMaterial && $defaultMaterial->customization_option_id == $materialOption->id ? 'default' : '' }}">
                            <span id="plated-name" class="w-full h-12 font-cinzel font-bold">{{ $platedOption->option_name }}</span>
                            <span id="plated-final-price" class="w-full font-montserrat font-bold hidden">
                                CL$ {{  number_format(($priceAdjustment), 0) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    {{--BAÑADO EN MATERIAL--}}
                </div>

                {{--AÑADIR AL CARRITO--}}
                <div class="mt-6 flex flex-col gap-3">
                    <span class="text-xl font-semibold font-cinzel">Subtotal: CL$ <span class="base-price">{{ number_format(($product->base_price), 0) }}</span></span>
                    <button class="w-full bg-[#008769] font-montserrat rounded-lg py-2 font-bold text-cwhite-500">AGREGAR AL CARRO</button>
                </div>
                {{--AÑADIR AL CARRITO--}}

                {{--INFO ENVÍO--}}
                <div class="w-full mt-6 flex flex-col gap-3">
                    <div class="flex items-center gap-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-black h-6 w-6" fill="none">
                            <path d="M21 7V12M3 7C3 10.0645 3 16.7742 3 17.1613C3 18.5438 4.94564 19.3657 8.83693 21.0095C10.4002 21.6698 11.1818 22 12 22L12 11.3548" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15 19C15 19 15.875 19 16.75 21C16.75 21 19.5294 16 22 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.32592 9.69138L5.40472 8.27785C3.80157 7.5021 3 7.11423 3 6.5C3 5.88577 3.80157 5.4979 5.40472 4.72215L8.32592 3.30862C10.1288 2.43621 11.0303 2 12 2C12.9697 2 13.8712 2.4362 15.6741 3.30862L18.5953 4.72215C20.1984 5.4979 21 5.88577 21 6.5C21 7.11423 20.1984 7.5021 18.5953 8.27785L15.6741 9.69138C13.8712 10.5638 12.9697 11 12 11C11.0303 11 10.1288 10.5638 8.32592 9.69138Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 12L8 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17 4L7 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="font-montserrat text-black text-sm">Envío gratis</p>
                    </div>
                    <div class="flex items-center gap-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-black h-6 w-6" fill="none">
                            <path d="M3 13V8H21V13C21 16.7712 21 18.6569 19.8284 19.8284C18.6569 21 16.7712 21 13 21H11C7.22876 21 5.34315 21 4.17157 19.8284C3 18.6569 3 16.7712 3 13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 8L3.86538 6.07692C4.53654 4.58547 4.87211 3.83975 5.55231 3.41987C6.23251 3 7.105 3 8.85 3H15.15C16.895 3 17.7675 3 18.4477 3.41987C19.1279 3.83975 19.4635 4.58547 20.1346 6.07692L21 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M12 8V3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M8.5 13.5H14C15.1046 13.5 16 14.3954 16 15.5C16 16.6046 15.1046 17.5 14 17.5H13M10 11.5L8 13.5L10 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="font-montserrat text-black text-sm">Devoluciones de hasta 60 días</p>
                    </div>
                    <div class="flex items-center gap-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-black h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <path d="M3 12C7.5 12 12 7.5 12 3C12 7.5 16.5 12 21 12C16.5 12 12 16.5 12 21C12 16.5 7.5 12 3 12Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M2 19.5C2.83333 19.5 4.5 17.8333 4.5 17C4.5 17.8333 6.16667 19.5 7 19.5C6.16667 19.5 4.5 21.1667 4.5 22C4.5 21.1667 2.83333 19.5 2 19.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M16 5C17 5 19 3 19 2C19 3 21 5 22 5C21 5 19 7 19 8C19 7 17 5 16 5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                        <p class="font-montserrat text-black text-sm">Garantía de 2 años</p>
                    </div>
                </div>
                {{--INFO ENVÍO--}}
            </div>
            {{--OPCIONES DE PERSONALIZACIÓN--}}
        </div>
    </div>
    <div class="w-full mt-20 flex">
        <div class="w-[35%]">
            <ul class="text-lg uppercase font-cinzel font-bold flex flex-col gap-3">
                <li><span class="underline-custom cursor-pointer" data-target="descripcion">Descripción y Materiales</span></li>
                <li><span class="underline-custom cursor-pointer" data-target="detalles">Detalles del Producto</span></li>
                <li><span class="underline-custom cursor-pointer" data-target="envio">Envío y Devoluciones</span></li>
            </ul>
        </div>
        <div class="w-[65%]">
            <p id="descripcion" class="content-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima eum fuga eos, fugiat nostrum laudantium, consectetur rerum asperiores, unde dignissimos libero dolorum numquam? Voluptates delectus inventore, sequi explicabo odio fuga.</p>
            <p id="detalles" class="content-paragraph hidden">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum nostrum veniam repudiandae officiis esse fuga possimus modi voluptatum reprehenderit tempore ipsa maxime ipsam assumenda ad, recusandae incidunt, nulla, natus aliquid.</p>
            <p id="envio" class="content-paragraph hidden">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusantium alias placeat iusto eum harum sed deserunt facere porro. Autem quis assumenda debitis error dolorum velit nostrum facilis enim sapiente consectetur.</p>
        </div>
    </div>
</div>

{{--FUNCIONALIDAD DE PRECIO--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const materialsContainer = document.getElementById("materials-container");
        const inlayContainer = document.querySelector(".flex.flex-wrap.gap-4.mt-3"); // Contenedor de #inlay-card
        const platedContainer = document.querySelector(".parent-plated"); // Contenedor de #plated-card
        const basePriceElement = document.querySelector(".base-price");
        const quantityElement = document.getElementById("quantity");
        const productMaterialsElement = document.getElementById("product-materials");
        let selectedMaterialCard = null;
        let selectedInlayCard = null;
        let selectedPlatedCard = null;
        let basePrice = parseInt(basePriceElement.textContent.replace(/[^\d]/g, ""));
        let currentInlayAdjustment = 0; // Ajuste de incrustación
        let currentPlatedAdjustment = 0; // Ajuste de bañado

        // Escuchar clics en los cards de cambio de material
        materialsContainer.addEventListener("click", function (event) {
            const card = event.target.closest(".material-card"); // Cambiado a ".material-card"
            if (card) {
                // Cambiar selección visual de materiales
                if (selectedMaterialCard) {
                    selectedMaterialCard.classList.remove("selected");
                }
                card.classList.add("selected");
                selectedMaterialCard = card;

                // Obtener precio del material seleccionado
                const finalPriceElement = card.querySelector("#final-price"); // Cambiado a ".final-price"
                basePrice = parseInt(finalPriceElement.textContent.replace(/[^\d]/g, ""));

                // Obtener nombre del material seleccionado
                const materialNameElement = card.querySelector("#option-name"); // Cambiado a ".option-name"
                const materialName = materialNameElement.textContent.trim();

                // Actualizar el precio base y el nombre del material
                updateMaterialName(materialName);
                updatePrices(); // Recalcula el precio
            }
        });


        // Escuchar clics en los cards de bañados
        platedContainer.addEventListener("click", function (event) {
            const card = event.target.closest("#plated-card");
            if (card) {
                // Cambiar selección visual de bañados
                if (selectedPlatedCard) {
                    selectedPlatedCard.classList.remove("selected");
                }
                card.classList.add("selected");
                selectedPlatedCard = card;

                // Manejar el caso de "Sin Bañado"
                if (card.classList.contains("no-plated")) {
                    currentPlatedAdjustment = 0; // Establece el ajuste en 0
                } else {
                    // Obtener precio de ajuste del "bañado" seleccionado
                    const adjustmentElement = card.querySelector("#plated-final-price");
                    currentPlatedAdjustment = parseInt(adjustmentElement.textContent.replace(/[^\d]/g, "")) || 0;
                }

                // Recalcular el precio con el nuevo ajuste
                updatePrices();
            }
        });

        // Escuchar clics en los cards de incrustaciones
        inlayContainer.addEventListener("click", function (event) {
            const card = event.target.closest("#inlay-card");
            if (card) {
                // Cambiar selección visual de incrustaciones
                if (selectedInlayCard) {
                    selectedInlayCard.classList.remove("selected");
                }
                card.classList.add("selected");
                selectedInlayCard = card;

                // Manejar el caso de "Sin Incrustación"
                if (card.classList.contains("no-inlay")) {
                    currentInlayAdjustment = 0; // Establece el ajuste en 0
                } else {
                    // Obtener precio de ajuste de la incrustación seleccionada
                    const adjustmentElement = card.querySelector("#inlay-final-price");
                    currentInlayAdjustment = parseInt(adjustmentElement.textContent.replace(/[^\d]/g, "")) || 0;
                }

                // Recalcular el precio con el nuevo ajuste
                updatePrices();
            }
        });

        // Incrementar cantidad
        window.increaseValue = function () {
            let currentValue = parseInt(quantityElement.textContent);
            quantityElement.textContent = currentValue + 1; // Incrementar cantidad
            updatePrices(); // Recalcular precio
        };

        // Disminuir cantidad
        window.decreaseValue = function () {
            let currentValue = parseInt(quantityElement.textContent);
            if (currentValue > 1) { // Evitar valores menores que 1
                quantityElement.textContent = currentValue - 1; // Disminuir cantidad
                updatePrices(); // Recalcular precio
            }
        };

        function updatePrices() {
            const quantity = parseInt(quantityElement.textContent);
            const priceWithoutMargin = basePrice;

            const adjustedPrice = (priceWithoutMargin + currentInlayAdjustment + currentPlatedAdjustment) * 1.2; // Agregar ajustes y margen

            let totalPrice = (adjustedPrice * quantity) * 1.19; // Multiplicar por la cantidad

            const formattedPrice = Math.round(totalPrice).toLocaleString("es-CL");
            const priceElements = document.querySelectorAll(".base-price");
            priceElements.forEach(element => {
                element.textContent = formattedPrice;
            });
        }

        // Actualizar el nombre del material seleccionado
        function updateMaterialName(materialName) {
            productMaterialsElement.textContent = materialName;
        }

        // Seleccionar la tarjeta de material por defecto al cargar la página
        selectDefaultMaterialCard();
    });
</script>
{{--FUNCIONALIDAD DE PRECIO--}}

{{--FUNCIONALIDAD DEL DROPDOWN--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownButton = document.getElementById("dropdownButton");
        const dropdownMenu = document.querySelector(".dropdown-menu");
        const buttonText = document.getElementById("buttonText");
        const dropdownItems = dropdownMenu.querySelectorAll("li");

        // Función para alternar el menú
        function toggleMenu() {
            dropdownMenu.classList.toggle("hidden");
        }

        // Función para cerrar el menú
        function closeMenu() {
            dropdownMenu.classList.add("hidden");
        }

        // Función para establecer la primera opción como seleccionada por defecto
        function setDefaultOption() {
            if (dropdownItems.length > 0) {
                const firstItem = dropdownItems[0];
                buttonText.textContent = firstItem.textContent.trim();
            }
        }

        // Función para manejar la selección de opciones
        function selectOption(event) {
            const selectedItem = event.target;
            buttonText.textContent = selectedItem.textContent.trim();
            closeMenu();
        }

        // Asignar eventos
        dropdownButton.addEventListener("click", toggleMenu);
        dropdownItems.forEach(item => {
            item.addEventListener("click", selectOption);
        });

        // Establecer la opción por defecto al cargar
        setDefaultOption();
    });
</script>
{{--FUNCIONALIDAD DEL DROPDOWN--}}

{{--FUNCIONALIDAD PARA MOSTRAR INFO/DESCRIPCIÓN--}}
<script>
    // Seleccionamos todos los elementos <span> con la clase .underline-custom
    const items = document.querySelectorAll('.underline-custom');
    const paragraphs = document.querySelectorAll('.content-paragraph');
  
    // Función para mostrar el párrafo correspondiente
    function showParagraph(target) {
      // Mostrar el párrafo correspondiente y ocultar los demás
      paragraphs.forEach(p => {
        if (p.id === target) {
          p.classList.remove('hidden'); // Mostrar el párrafo correspondiente
        } else {
          p.classList.add('hidden'); // Ocultar los demás
        }
      });
    }
  
    // Añadimos un event listener a cada elemento para manejar el clic
    items.forEach(item => {
      item.addEventListener('click', function() {
        // Eliminar la clase 'selected' de todos los elementos
        items.forEach(i => i.classList.remove('selected'));
  
        // Añadir la clase 'selected' al elemento clicado
        this.classList.add('selected');
  
        // Obtener el valor del data-target del span (relacionado con el párrafo)
        const target = this.getAttribute('data-target');
  
        // Mostrar el párrafo correspondiente
        showParagraph(target);
      });
    });
  
    // Mostrar el párrafo correspondiente al cargar la página
    // Inicialmente, seleccionamos el primer elemento y mostramos el párrafo correspondiente
    window.onload = function() {
      // El primer span (por defecto seleccionado) es el primero en la lista
      const firstItem = items[0];
      firstItem.classList.add('selected'); // Seleccionamos la primera opción
  
      const firstTarget = firstItem.getAttribute('data-target');
      showParagraph(firstTarget); // Mostramos el párrafo correspondiente al primer item
    }
</script>
{{--SCRIPT PARA MOSTRAR INFO/DESCRIPCIÓN--}}

{{-- Estilo CSS adicional para los cards --}}
<style>
    .material-card.selected {
        border: 1px solid #006c55;
    }

    #inlay-card.selected {
        border: 1px solid #006c55;
    }

    #plated-card.selected {
        border: 1px solid #006c55;
    }
    .underline-custom {
        position: relative;
        display: inline-block;
        transition: all 0.3s ease; /* Suaviza el efecto cuando se selecciona */
    }

    /* Subrayado cuando el elemento está seleccionado */
    .underline-custom.selected::after {
        content: "";
        position: absolute;
        bottom: -2px; /* Ajusta esto para mover el subrayado más abajo */
        left: 0;
        width: 100%;
        height: 2px; /* Ajusta el grosor del subrayado */
        background-color: currentColor; /* Usa el color del texto */
    }
</style>
{{--FUNCIONALIDAD DE PRECIO--}}
@endsection
