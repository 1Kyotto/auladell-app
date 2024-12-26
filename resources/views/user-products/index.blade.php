@extends('template.master')

@section('content')
<div class="w-full h-full flex">
    {{--SIDEBAR--}}
    <div class="h-[800px] w-[25%] flex flex-col font-cinzel text-black shadow-right-only sticky top-0 z-50">
        <div class="px-8">
            <div class="flex flex-col w-full border-b border-[#CED4E0] pb-3">
                <h4 class="mt-5 text-2xl">
                    Filtros
                </h4>
                <span class="text-lg">
                    {{ $products->count() }} item(s)
                </span>
            </div>

            {{--FILTRO CATEGORIAS--}}
            @if ($currentCategory == 'all-products')
            <div class="my-6 relative text-xl">
                <button class="toggle-button py-3 w-full flex items-center justify-between">
                    Categorías
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-full">
                    @foreach ($categories as $name => $value)
                    <li>
                        <label>
                            <input type="checkbox" name="category-filter" value="{{ $value }}" class="category-checkbox" {{ $value === 'all-products' ? 'checked' : '' }}>
                            <span>{{ $name }}</span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{--FILTRO MATERIALES--}}
            <div class="my-6 relative text-xl w-full">
                <button class="toggle-button py-3 w-full flex items-center justify-between">
                    Materiales
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-full">
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
                <button class="toggle-button py-3 w-full flex items-center justify-between">
                    Incrustaciones
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="plus-icon h-5 w-5" fill="none">
                        <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
    
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="minus-icon h-5 w-5 hidden" fill="none">
                        <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="dropdown hidden pl-6 w-full">
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

{{--SCRIPT PARA FILTRAR PRODUCTOS--}}
<script>
    // Selecciona todos los botones con clase 'toggle-button'
    const toggleButtons = document.querySelectorAll('.toggle-button');
    const materialCheckboxes = document.querySelectorAll('.material-checkbox');
    const gemstoneCheckboxes = document.querySelectorAll('.gemstone-checkbox');
    const productsContainer = document.querySelector('.products-container');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const allProducts = @json($products);

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
                filterProducts();
            });
        });
    }

    allowOnlyOneSelection(materialCheckboxes);
    allowOnlyOneSelection(gemstoneCheckboxes);
    allowOnlyOneSelection(categoryCheckboxes);

    // Manejo de los toggles para mostrar/ocultar filtros
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            const plusIcon = this.querySelector('.plus-icon');
            const minusIcon = this.querySelector('.minus-icon');
            
            dropdown.classList.toggle('hidden');
            plusIcon.classList.toggle('hidden');
            minusIcon.classList.toggle('hidden');
        });
    });

    function filterProducts() {
        let filteredProducts = [...allProducts];

        // Aplicar filtro de categoría
        const selectedCategory = Array.from(categoryCheckboxes)
            .find(cb => cb.checked);
        if (selectedCategory && selectedCategory.value !== 'all-products') {
            filteredProducts = filteredProducts.filter(product => 
                product.category === selectedCategory.value
            );
        }

        // Aplicar filtro de material
        const selectedMaterial = Array.from(materialCheckboxes)
            .find(cb => cb.checked);
        if (selectedMaterial) {
            const materialName = selectedMaterial.dataset.material;
            filteredProducts = filteredProducts.filter(product => 
                product.materials.some(m => m.name === materialName)
            );
        }

        // Aplicar filtro de incrustaciones
        const selectedGemstone = Array.from(gemstoneCheckboxes)
            .find(cb => cb.checked);
        if (selectedGemstone) {
            const gemstoneName = selectedGemstone.dataset.gemstone;
            filteredProducts = filteredProducts.filter(product => 
                product.gemstones.includes(gemstoneName)
            );
        }

        renderProducts(filteredProducts);
    }

    function renderProducts(products) {
        productsContainer.innerHTML = products.map(product => `
            <div class="w-[30%] mr-7 mb-6 font-montserrat">
                <a href="/jewelry/product/${product.id}" class="w-full h-[300px]">
                    <img src="${product.image_url}" alt="" class="w-full h-[300px] object-cover">
                </a>
                <h4 class="pt-3">${product.name}</h4>
                <span class="font-bold" data-calculated-price="${product.calculated_price}">CL$ ${product.formatted_price}</span>
            </div>
        `).join('');
    }
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