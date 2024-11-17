@extends('template.master')

@section('content')
<div class="w-full h-full flex">
    {{--SIDEBAR--}}
    <div class="h-[100dvh] w-[25%] flex flex-col font-cinzel text-black shadow-right-only sticky top-0 z-50">
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
                        <a href="" class="rounded-t bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap">Trending Now</a>
                    </li>
                    <li>
                        <a href="" class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap">Bestsellers</a>
                    </li>
                    <li>
                        <a href="" class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap">Newest</a>
                    </li>
                    <li>
                        <a href="" class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap">Price Low to High</a>
                    </li>
                    <li>
                        <a href="" class="rounded-b bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-nowrap">Price High to Low</a>
                    </li>
                </ul>
            </div>

            {{--FILTRO CATEGORIA AJAX--}}
            <div class="my-6 relative text-xl">
                <button class="toggle-button py-3 w-[calc(100%-32px)] flex items-center justify-between">
                    Categoría
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-[calc(100%-32px)]">
                    @foreach ($products->unique('category') as $product)
                    <li>
                        <label for="">
                            <input type="checkbox" class="category-checkbox" data-category="{{ $product->category }}">
                            <span>{{ $product->category }}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{--FILTRO CATEGORIA AJAX--}}

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
                            <input type="checkbox">
                            <span>{{$material->name}}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            {{--FILTRO MATERIALES--}}
    
            {{--FILTRO COLECCION--}}
            <div class="my-6 relative text-xl">
                <button class="toggle-button py-3 w-[calc(100%-32px)] flex items-center justify-between">
                    Colección
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-[calc(100%-32px)]">
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Aros</span>
                        </label>
                    </li>
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Anillos</span>
                        </label>
                    </li>
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Brazaletes</span>
                        </label>
                    </li>
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Collares</span>
                        </label>
                    </li>
                </ul>
            </div>
            {{--FILTRO COLECCION--}}
    
            {{--FILTRO ACABADO--}}
            <div class="my-6 relative text-xl">
                <button class="toggle-button py-3 w-[calc(100%-32px)] flex items-center justify-between">
                    Acabado
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-[calc(100%-32px)]">
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Aros</span>
                        </label>
                    </li>
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Anillos</span>
                        </label>
                    </li>
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Brazaletes</span>
                        </label>
                    </li>
                    <li>
                        <label for="">
                            <input type="checkbox">
                            <span>Collares</span>
                        </label>
                    </li>
                </ul>
            </div>
            {{--FILTRO ACABADO--}}
        </div>
    </div>
    {{--SIDEBAR--}}
    
    {{--PRODUCTOS--}}
    <div class="h-full w-[75%] p-5 flex flex-wrap products-container">
        @foreach ($products as $product)
        <div class="w-[30%] mr-7 mb-6">
            <a href="" class="w-full h-[300px]">
                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-[300px] object-cover">
            </a>
            <h4 class="pt-3">{{$product->name}}</h4>
            <span>CL$ {{ number_format($product->base_price, 0) }}</span>
            <div class="">
                <button>
                    Añadir al carro
                    <svg class="w-[110px] h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                        <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                        <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
                    </svg>
                </button>
            </div>
        </div>    
        @endforeach
    </div>
    {{--PRODUCTOS--}}

</div>
{{--FUNCIONALIDAD DE MOSTRAR OPCIONES DE FILTRO--}}
<script>
    // Selecciona todos los botones con clase 'toggle-button'
    const toggleButtons = document.querySelectorAll('.toggle-button');

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

{{--SCRIPT PARA FILTRAR PRODUCTOS POR CATEGORIA--}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.category-checkbox');
        const productsContainer = document.querySelector('.products-container');  // Asegúrate de tener una clase para el contenedor de productos
        const allProducts = @json($products);  // Pasa todos los productos al frontend

        checkboxes.forEach(checkbox => {
            // Añadimos un listener a cada checkbox
            checkbox.addEventListener('change', function() {
                // Si el checkbox es seleccionado
                if (this.checked) {
                    // Desmarcamos todos los demás checkboxes
                    checkboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        }
                    });

                    // Ahora, si este checkbox está marcado, podemos realizar el filtrado
                    filterProducts();
                } else {
                    // Si se desmarca, no hacemos nada, solo se mantienen los productos previamente filtrados
                    filterProducts();
                }
            });
        });

        // Función para mostrar productos según la categoría seleccionada
        function filterProducts() {
            // Obtener todas las categorías seleccionadas
            const selectedCategories = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.getAttribute('data-category'));

            // Si no hay categorías seleccionadas, mostrar todos los productos
            if (selectedCategories.length === 0) {
                renderProducts(allProducts);  // Muestra todos los productos
                return;  // No filtramos nada más
            }

            // Filtrar los productos según las categorías seleccionadas
            const filteredProducts = allProducts.filter(product => {
                return selectedCategories.includes(product.category);
            });

            // Mostrar los productos filtrados
            renderProducts(filteredProducts);
        }

        // Función para renderizar los productos
        function renderProducts(products) {
            productsContainer.innerHTML = '';  // Limpiar productos existentes

            products.forEach(product => {
                const productHtml = `
                    <div class="w-[30%] mr-7 mb-6">
                        <a href="" class="w-full h-[300px]">
                            <img src="${product.image_url}" alt="" class="w-full h-[300px] object-cover">
                        </a>
                        <h4 class="pt-3">${product.name}</h4>
                        <span>CL$ ${new Intl.NumberFormat().format(product.base_price)}</span>
                        <div class="">
                            <button>Añadir al carro
                                <svg class="w-[110px] h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                                    <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                                    <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                productsContainer.innerHTML += productHtml;
            });
        }

        // Escuchar cambios en los checkboxes de categoría
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', filterProducts);
        });

        // Inicializar el filtro en caso de que haya categorías pre-seleccionadas
        filterProducts();
    });
</script>
{{--SCRIPT PARA FILTRAR PRODUCTOS POR CATEGORIA--}}
@endsection