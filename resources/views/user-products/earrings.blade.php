@extends('template.master')

@section('content')
<div class="w-full h-full flex">
    {{--SIDEBAR--}}
    <div class="h-[800px] w-[25%] flex flex-col font-cinzel text-black shadow-right-only sticky top-0 z-50">
        <div class="ml-8">
            <h4 class="mt-5 text-2xl">
                Filtrar Y Ordenar
            </h4>
            <span class="text-lg">
                {{ $products->count() }} item(s)
            </span>
        
            <div class="my-6 relative text-xl">
                <button id="dropdownButton"
                        class="border rounded-sm py-3 px-3 w-[calc(100%-32px)] flex items-center justify-between"
                        onclick="toggleMenuAndSetDefault()">
                    <span id="buttonText"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6" fill="none">
                        <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown-menu hidden pt-1 shadow-md w-[calc(100%-32px)]">
                    <li>
                        <a class="cursor-pointer bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap filter-option" data-filter="new-products">Nuevos Productos</a>
                    </li>
                    <li>
                        <a class="cursor-pointer bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap filter-option" data-filter="price-asc">Precio: Menor a Mayor</a>
                    </li>
                    <li>
                        <a class="cursor-pointer rounded-b bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap filter-option" data-filter="price-desc">Precio: Mayor a Menor</a>
                    </li>
                </ul>
            </div>

            {{--FILTRO MATERIALES--}}
            <div class="my-6 relative text-xl">
                <button class="toggle-button py-3 w-[calc(100%-32px)] flex items-center justify-between">
                    Materiales
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-[calc(100%-32px)]">
                    @foreach ($selectedMaterial as $material)
                    <li>
                        <label for="">
                            <input type="checkbox" class="material-checkbox" data-material="{{ $material->name }}">
                            <span>{{$material->name}}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{--FILTRO MATERIALES--}}

            {{--FILTRO GEMSTONES--}}
            <div class="my-6 relative text-xl">
                <button class="toggle-button py-3 w-[calc(100%-32px)] flex items-center justify-between">
                    Incrustaciones
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-[calc(100%-32px)]">
                    @foreach ($selectedGemstone as $gemstone)
                    <li>
                        <label for="">
                            <input type="checkbox" class="gemstone-checkbox" data-gemstone="{{ $gemstone->name }}">
                            <span>{{$gemstone->name}}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{--FILTRO GEMSTONES--}}
        </div>
    </div>
    {{--SIDEBAR--}}
    
    {{--PRODUCTOS--}}
    <div class="h-full w-[75%] p-5 flex flex-wrap products-container">
        @foreach ($products as $product)
        <div class="w-[30%] mr-7 mb-6 font-montserrat">
            <a href="{{ route('jewelry.show', ['id' => $product->id]) }}" class="w-full h-[300px]">
                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-[300px] object-cover">
            </a>
            <h4 class="pt-3">{{$product->name}}</h4>
            <span class="font-bold" data-calculated-price="{{ $product->calculated_price }}">CL$ {{ $product->formatted_price }}</span>
        </div>    
        @endforeach

        <div id="end-marker" class="w-full h-1 hidden"></div>
    </div>
    {{--PRODUCTOS--}}

</div>
{{--FUNCIONALIDAD DE MOSTRAR OPCIONES DE FILTRO--}}
<script>
    // Selecciona todos los botones con clase 'toggle-button'
    const toggleButtons = document.querySelectorAll('.toggle-button');
    const filterOptions = document.querySelectorAll('.filter-option'); // Selecciona las opciones de filtro
    const buttonText = document.getElementById('buttonText'); // Elemento donde se mostrará el texto seleccionado

    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Encuentra el contenedor de este botón
            const parentDiv = button.closest('.my-6');
            const plusIcon = parentDiv.querySelector('.plus-icon');
            const minusIcon = parentDiv.querySelector('.minus-icon');
            const dropdownMenu = parentDiv.querySelector('.dropdown');

            // Cierra cualquier menú abierto antes de abrir el actual
            document.querySelectorAll('.dropdown').forEach(menu => {
                if (!menu.classList.contains('hidden') && menu !== dropdownMenu) {
                    // Cierra el menú que no corresponde al botón actual
                    menu.classList.add('hidden');
                    menu.closest('.my-6').querySelector('.plus-icon').classList.remove('hidden');
                    menu.closest('.my-6').querySelector('.minus-icon').classList.add('hidden');
                }
            });

            // Alterna la visibilidad del menú y los iconos en el contenedor actual
            plusIcon.classList.toggle('hidden');
            minusIcon.classList.toggle('hidden');
            dropdownMenu.classList.toggle('hidden');
        });
    });

    // Escucha los clics en las opciones de filtro para actualizar el texto del botón y cerrar el dropdown
    filterOptions.forEach(option => {
        option.addEventListener('click', function (e) {
            e.preventDefault();
            buttonText.textContent = this.textContent; // Cambia el texto del botón al de la opción seleccionada

            // Cierra el dropdown después de seleccionar la opción
            const dropdownMenu = this.closest('.dropdown-menu');
            dropdownMenu.classList.add('hidden');
            const parentDiv = dropdownMenu.closest('.my-6');
            parentDiv.querySelector('.plus-icon').classList.remove('hidden');
            parentDiv.querySelector('.minus-icon').classList.add('hidden');
        });
    });
</script>
{{--FUNCIONALIDAD DE MOSTRAR OPCIONES DE FILTRO--}}

{{--FUNCIONALIDAD DEL DROPDOWN--}}
<script>
    // Función para configurar el texto del botón con la primera opción del ul
    function setDefaultButtonText() {
        const firstOptionText = document.querySelector(".dropdown-menu li:first-child a").textContent;
        document.getElementById("buttonText").textContent = firstOptionText;
    }

    // Llamada a la función al cargar la página
    window.onload = setDefaultButtonText;

    // Función para alternar el menú
    function toggleMenuAndSetDefault() {
        const menu = document.querySelector(".dropdown-menu");
        menu.classList.toggle("hidden");
    }
</script>
{{--FUNCIONALIDAD DEL DROPDOWN--}}

{{--SCRIPT PARA FILTRAR PRODUCTOS--}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const materialCheckboxes = document.querySelectorAll('.material-checkbox');
        const gemstoneCheckboxes = document.querySelectorAll('.gemstone-checkbox');
        const filterOptions = document.querySelectorAll('.filter-option');
        const productsContainer = document.querySelector('.products-container');
        const allProducts = @json($products);
        let activeFilter = null;

        function allowOnlyOneSelection(checkboxes) {
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        checkboxes.forEach(otherCheckbox => {
                            if (otherCheckbox !== this) {
                                otherCheckbox.checked = false;
                            }
                        });
                    }
                    filterProducts(); // Llamar a la función de filtrado cuando se cambie la selección
                });
            });
        }

        allowOnlyOneSelection(materialCheckboxes);
        allowOnlyOneSelection(gemstoneCheckboxes);

        // Evento para los filtros de la lista
        filterOptions.forEach(option => {
            option.addEventListener('click', function (e) {
                e.preventDefault();
                activeFilter = this.getAttribute('data-filter');
                filterProducts();
            });
        });

        function filterProducts() {
            const selectedMaterials = Array.from(materialCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.getAttribute('data-material'));

            const selectedGemstones = Array.from(gemstoneCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.getAttribute('data-gemstone'));

            let filteredProducts = allProducts;

            // Filtrar por categorías, materiales e incrustaciones
            filteredProducts = filteredProducts.filter(product => {
                const productMaterials = product.materials.map(material => material.name);

                const materialMatch = selectedMaterials.length === 0 || selectedMaterials.some(material => productMaterials.includes(material));
                const gemstoneMatch = selectedGemstones.length === 0 || selectedGemstones.some(gemstone => product.gemstones.includes(gemstone));

                return materialMatch && gemstoneMatch;
            });

            // Aplicar filtro adicional basado en la opción seleccionada
            if (activeFilter === 'new-products') {
                const currentDate = new Date();
                filteredProducts = filteredProducts.filter(product => {
                    const updatedAt = new Date(product.updated_at);
                    return (currentDate - updatedAt) / (1000 * 60 * 60 * 24) <= 7; // Productos actualizados en los últimos 7 días
                });
                if (filteredProducts.length === 0) {
                    filteredProducts = allProducts; // Mostrar todos los productos si no hay nuevos
                }
            } else if (activeFilter === 'price-asc') {
                filteredProducts.sort((a, b) => a.base_price - b.base_price); // Ordenar por precio de menor a mayor
            } else if (activeFilter === 'price-desc') {
                filteredProducts.sort((a, b) => b.base_price - a.base_price); // Ordenar por precio de mayor a menor
            }

            renderProducts(filteredProducts);
        }

        function renderProducts(products) {
            productsContainer.innerHTML = ''; // Limpiar productos existentes

            products.forEach(product => {
                const productHtml = `
                    <div class="w-[30%] mr-7 mb-6 font-montserrat">
                        <a href="/jewelry/product/${product.id}" class="w-full h-[300px]">
                            <img src="${product.image_url}" alt="" class="w-full h-[300px] object-cover">
                        </a>
                        <h4 class="pt-3">${product.name}</h4>
                        <span class="font-bold">CL$ ${new Intl.NumberFormat("en-US").format(product.calculated_price)}</span>
                    </div>
                `;
                productsContainer.innerHTML += productHtml;
            });
        }

        // Inicializar el filtro en caso de que haya filtros pre-seleccionados
        filterProducts();
    });
</script>
{{--SCRIPT PARA FILTRAR PRODUCTOS--}}

{{--SCRIPT PARA MANTENER EL COMPORTAMIENTO STICKY--}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.querySelector(".sidebar");
        const endMarker = document.getElementById("end-marker");
        const productsContainer = document.querySelector(".products-container");
        const initialSidebarTop = sidebar.offsetTop;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    // Cuando el marcador no es visible, "pegar" el sidebar
                    sidebar.style.position = "absolute";
                    sidebar.style.top = `${productsContainer.offsetHeight - sidebar.offsetHeight}px`;
                } else {
                    // Volver a sticky cuando el marcador es visible
                    sidebar.style.position = "sticky";
                    sidebar.style.top = "0";
                }
            });
        }, { threshold: 0 });

        observer.observe(endMarker);
    });
</script>
{{--SCRIPT PARA MANTENER EL COMPORTAMIENTO STICKY--}}
@endsection