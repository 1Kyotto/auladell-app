@extends('template.dashboard')

@section('content')
<div class="flex flex-1 flex-col h-full text-cblack-500 font-montserrat">
    {{-- Mensajes de notificación --}}
    @if(session('success'))
        <div id="success-alert" class="mb-4 bg-green-100 border mx-16 border-green-400 text-green-700 py-3 rounded relative transition-opacity duration-500" role="alert">
            <span class="block sm:inline px-6">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 mx-16 py-3 rounded relative" role="alert">
            <span class="block sm:inline px-6">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Header y Estadísticas --}}
    <div class="flex-shrink-0 px-6 pt-5 pb-8">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-cinzel text-cwhite-500">Productos</h1>
            <button onclick="openAddProduct()" class="bg-[#006C55] hover:bg-[#005544] text-white font-medium py-2 px-4 rounded-md text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Añadir Producto
            </button>
        </div>

        {{-- Cards de Estadísticas --}}
        <div class="grid grid-cols-4 gap-8">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4">
                    <div class="text-[13px] font-cinzel text-gray-500">Total de productos</div>
                    <div class="text-lg font-bold">{{ $items }}</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4">
                    <div class="text-[13px] font-cinzel text-gray-500">Productos activos</div>
                    <div class="text-lg font-bold" data-counter="actives">{{ $actives }}</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4">
                    <div class="text-[13px] font-cinzel text-gray-500">Productos inactivos</div>
                    <div class="text-lg font-bold" data-counter="inactives">{{ $items - $actives }}</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 flex flex-col">
                    <div class="text-[13px] font-cinzel text-gray-500">Categorías</div>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold">Aros: {{ $aros }}</span>
                        <span class="text-sm font-bold">Anillos: {{ $anillos }}</span>
                        <span class="text-sm font-bold">Brazaletes: {{ $brazaletes }}</span>
                        <span class="text-sm font-bold">Collares: {{ $collares }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de Productos --}}
    <div class="flex-1 px-6 pb-6 min-h-0">
        <div class="flex flex-col h-full bg-[#E0E0E0] shadow-sm">
            {{-- Contenedor de la tabla con scroll --}}
            <div class="flex-1 overflow-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Producto
                            </th>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio Base
                            </th>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoría
                            </th>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Personalizaciones
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span class="font-cinzel">Estado</span>
                                    <div class="group relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div class="hidden group-hover:block absolute z-10 text-center w-48 p-2 mt-1 text-sm text-gray-500 bg-white rounded-lg shadow-lg border border-gray-200 -left-40">
                                            Haz clic en el estado para cambiar entre <strong class="text-[#006C55]">Activo</strong>/<strong class="text-[#006C55]">Inactivo</strong>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <span class="font-cinzel">Acciones</span>
                                    <div class="group relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div class="hidden group-hover:block absolute z-10 text-center w-48 p-2 mt-1 text-sm text-gray-500 bg-white rounded-lg shadow-lg border border-gray-200 -left-40">
                                            Haz clic en la acción correspondiente para <strong class="text-[#006C55]">editar</strong> o <strong class="text-[#006C55]">eliminar</strong> un producto.
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $product->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    ${{ number_format($product->raw_price, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $product->category }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex justify-center items-center gap-5">
                                    <button onclick="openCustomizationsModal({{ $product->id }})" class="text-[#006C55] hover:text-[#005544] font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                            <path d="M15.2141 5.98239L16.6158 4.58063C17.39 3.80646 18.6452 3.80646 19.4194 4.58063C20.1935 5.3548 20.1935 6.60998 19.4194 7.38415L18.0176 8.78591M15.2141 5.98239L6.98023 14.2163C5.93493 15.2616 5.41226 15.7842 5.05637 16.4211C4.70047 17.058 4.3424 18.5619 4 20C5.43809 19.6576 6.94199 19.2995 7.57889 18.9436C8.21579 18.5877 8.73844 18.0651 9.78375 17.0198L18.0176 8.78591M15.2141 5.98239L18.0176 8.78591" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11 20H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </button>

                                    <button onclick="openAddCustomizationsModal({{ $product->id }})" class="text-[#006C55] hover:text-[#005544] font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" stroke="currentColor" fill="none">
                                            <path d="M12 8V16M16 12L8 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z" stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button 
                                    onclick="toggleProductStatus({{ $product->id }})"
                                    data-product-id="{{ $product->id }}"
                                    class="w-[85px] px-4 py-1.5 text-xs font-medium tracking-wide rounded-md transition-all duration-200 focus:outline-none text-center {{ $product->is_active ? 'bg-[#E0EFEC] text-[#006C55] hover:bg-[#006C55] hover:text-white' : 'bg-[#FFEAE5] text-[#56170D] hover:bg-[#F8B7AA]' }}"
                                >
                                    {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap items-center flex gap-6">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="text-[#006C55] hover:text-[#005544] font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                        <path d="M15.2141 5.98239L16.6158 4.58063C17.39 3.80646 18.6452 3.80646 19.4194 4.58063C20.1935 5.3548 20.1935 6.60998 19.4194 7.38415L18.0176 8.78591M15.2141 5.98239L6.98023 14.2163C5.93493 15.2616 5.41226 15.7842 5.05637 16.4211C4.70047 17.058 4.3424 18.5619 4 20C5.43809 19.6576 6.94199 19.2995 7.57889 18.9436C8.21579 18.5877 8.73844 18.0651 9.78375 17.0198L18.0176 8.78591M15.2141 5.98239L18.0176 8.78591" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11 20H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </a>
                                <button onclick="openDeleteModal('{{ $product->id }}')" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5" fill="none">
                                        <path d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M9.5 16.5L9.5 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M14.5 16.5L14.5 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Paginación --}}
            <div class="flex-shrink-0 px-6 py-4 border-t border-gray-200 bg-white">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Modal de Añadir Producto --}}
<div id="addProductModal" class="fixed font-montserrat inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 999;">
    <div class="relative top-5 mx-auto p-5 border w-[800px] shadow-lg rounded-md bg-white mb-10">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-cinzel font-medium text-gray-900">Añadir Nuevo Producto</h3>
            <button type="button" onclick="closeAddModal()" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Cerrar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.products.store-step1') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            {{-- Información Básica --}}
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h4 class="font-medium text-gray-700 mb-2">Información Básica</h4>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               required
                               class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select name="category" 
                                id="category"
                                required
                                class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                            <option value="">Seleccionar categoría</option>
                            <option value="Aros">Aros</option>
                            <option value="Anillos">Anillos</option>
                            <option value="Brazaletes">Brazaletes</option>
                            <option value="Collares">Collares</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                    <input type="file" 
                           name="image" 
                           id="image"
                           required
                           accept="image/*"
                           class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                </div>
            </div>

            {{-- Costos y Precios --}}
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h4 class="font-medium text-gray-700 mb-2">Costos y Precios</h4>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="labor_hours" class="block text-sm font-medium text-gray-700 mb-1">Horas de trabajo necesarias</label>
                        <input type="number" 
                               name="labor_hours" 
                               id="labor_hours"
                               required
                               min="0"
                               step="0.5"
                               class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900"
                               onchange="calculatePrices()">
                    </div>
                    <div>
                        <label for="labor_cost_per_hour" class="block text-sm font-medium text-gray-700 mb-1">Costo por hora de trabajo</label>
                        <input type="number" 
                               name="labor_cost_per_hour" 
                               id="labor_cost_per_hour"
                               required
                               min="0"
                               step="100"
                               class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900"
                               onchange="calculatePrices()">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="raw_price_display" class="block text-sm font-medium text-gray-700 mb-1">Costo Base</label>
                        <input type="text" readonly id="raw_price_display" class="w-full py-2 px-3 rounded-md border border-gray-300 bg-gray-100 text-gray-900">
                        <input type="hidden" name="raw_price" id="raw_price">
                    </div>
                    <div>
                        <label for="price_with_margin_display" class="block text-sm font-medium text-gray-700 mb-1">Precio con Margen</label>
                        <input type="text" readonly id="price_with_margin_display" class="w-full py-2 px-3 rounded-md border border-gray-300 bg-gray-100 text-gray-900">
                        <input type="hidden" name="price_with_margin" id="price_with_margin">
                    </div>
                    <div>
                        <label for="final_price_display" class="block text-sm font-medium text-gray-700 mb-1">Precio Final</label>
                        <input type="text" readonly id="final_price_display" class="w-full py-2 px-3 rounded-md border border-gray-300 bg-gray-100 text-gray-900">
                        <input type="hidden" name="final_price" id="final_price">
                    </div>
                </div>
            </div>

            {{-- Materiales --}}
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h4 class="font-medium text-gray-700 mb-2">Materiales</h4>
                <div id="materials_container">
                    <div class="material-row flex items-end gap-2">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Material Base</label>
                            <select name="materials[]" data-is-base="true" required class="w-full py-3 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900"
                                    onchange="this.form.base_material.value = this.value">
                                <option value="">Seleccionar material base</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" data-price="{{ $material->price_per_unit }}">
                                        {{ $material->name }} ({{ $material->unit }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="base_material" id="base_material">
                        </div>
                        <div class="w-32">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                            <input type="number" 
                                   name="quantities[]" 
                                   placeholder="Cantidad" 
                                   required 
                                   min="0" 
                                   step="0.01"
                                   class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                        </div>
                        <button type="button" onclick="addAddMaterialRow()" class="px-3 py-2 bg-[#006C55] text-white rounded-md hover:bg-[#005543] transition-colors">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" 
                        onclick="document.getElementById('addProductModal').classList.add('hidden')"
                        class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="submit"
                        class="py-2 px-4 bg-[#006C55] hover:bg-[#005544] text-white font-medium rounded-md text-sm">
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal de Personalizaciones Existentes --}}
<div id="customizationsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden text-cblack-500">
    <div class="relative top-20 mx-auto p-5 border w-11/12 lg:w-4/5 shadow-lg rounded-md bg-white">
        <div class="flex flex-col">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-cinzel font-semibold text-gray-900">Personalizaciones Actuales del Producto</h3>
                <button onclick="closeCustomizationsModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div>
                {{-- Lista de Personalizaciones Existentes --}}
                <div class="bg-white p-4 rounded-lg shadow mb-4">
                    <input type="hidden" id="productId" name="product_id">
                    
                    {{-- Tabs de Personalizaciones --}}
                    <div class="mb-4" id="customizationTabs">
                        {{-- Los tabs se generarán dinámicamente --}}
                    </div>
                    
                    {{-- Contenido de las personalizaciones --}}
                    <div id="currentCustomizations" class="space-y-4">
                        {{-- El contenido se cargará dinámicamente --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de Personalizaciones Nuevas--}}
<div id="customizationsAddModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden text-cblack-500">
    <div class="relative top-20 mx-auto p-5 border w-11/12 lg:w-4/5 shadow-lg rounded-md bg-white">
        <div class="flex flex-col">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-cinzel font-semibold text-gray-900">Añadir Personalizaciones al Producto</h3>
                <button onclick="closeAddCustomizationsModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="addCustomizationForm" action="{{ route('admin.products.store-customization') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="product_id" id="customizationProductId">
                
                <div class="space-y-4">
                    <!-- Selección de Personalización -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Personalización</label>
                        <select name="customization_id" id="customizationSelect" class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900" required>
                            <option value="">Seleccionar personalización</option>
                            @foreach($customizations as $customization)
                                <option value="{{ $customization->id }}" data-category='{{ $customization->category }}'>{{ $customization->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Opciones de Personalización -->
                    <div id="optionsContainer" class="hidden">
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-medium text-gray-700">Opciones Disponibles</label>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" 
                                    id="selectAllOptions" 
                                    class="rounded border-gray-300 text-[#006C55] focus:ring-[#006C55]">
                                <label for="selectAllOptions" class="text-sm text-gray-700">Seleccionar todas</label>
                            </div>
                        </div>
                        <div id="customizationOptions" class="space-y-2">
                            <!-- Las opciones se cargarán dinámicamente -->
                        </div>
                    </div>

                    <!-- Contenedor de Materiales -->
                    <div id="materialsContainer" class="hidden space-y-4">
                        <!-- Las secciones de materiales se agregarán dinámicamente aquí -->
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" 
                            onclick="closeAddCustomizationsModal()"
                            class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="py-2 px-4 bg-[#006C55] hover:bg-[#005544] text-white font-medium rounded-md text-sm">
                        Guardar Personalización
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal de Confirmación de Estado --}}
<div id="toggleStatusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 999;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg font-cinzel leading-6 font-medium text-gray-900">Confirmar cambio de estado</h3>
            <div class="mt-2 px-7 py-3 flex flex-col text-start gap-3">
                <p class="text-sm text-gray-500 font-montserrat">
                    ¿Estás seguro de que deseas cambiar el estado de este producto?
                </p>
                <p class="text-sm text-gray-500 font-bold">
                    Esta acción podría tener consecuencias significativas para los clientes.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmToggleStatus"
                    class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Confirmar
                </button>
                <button onclick="closeToggleStatusModal()"
                    class="mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal de Confirmación de Eliminación --}}
<div id="deleteConfirmModal" class="fixed inset-0 text-cblack-500 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full mx-4">
        <h3 class="text-xl font-bold mb-4 font-cinzel">Confirmar eliminación</h3>
        <p class="text-gray-600 mb-1">¿Estás seguro de que deseas archivar este producto?</p>
        <p class="text-gray-600 mb-6 font-bold">Esta acción no se puede deshacer.</p>
        <div class="flex justify-end gap-4">
            <button onclick="closeDeleteModal()" class="px-4 py-2 border text-cblack-500 border-gray-300 rounded-md hover:bg-gray-100">
                Cancelar
            </button>
            <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Eliminar
            </button>
        </div>
    </div>
</div>

{{--SCRIPT PARA AÑADIR PRODUCTO--}}
<script>
    // Función para abrir el modal
    window.openAddProduct = function() {
        try {
            // Mostrar el modal
            const modal = document.getElementById('addProductModal');
            modal.classList.remove('hidden');

            // Limpiar el formulario
            const form = document.getElementById('addProductForm');
            if (form) form.reset();

            // Limpiar materiales adicionales
            const materialsContainer = document.getElementById('materials_container');
            const materialRows = materialsContainer.querySelectorAll('.material-row:not(:first-child)');
            materialRows.forEach(row => row.remove());

            // Calcular precios iniciales
            calculateAddPrices();
        } catch (error) {
            console.error('Error en openAddProduct:', error);
        }
    }

    // Función para cerrar el modal
    window.closeAddModal = function() {
        document.getElementById('addProductModal').classList.add('hidden');
    }

    // Función para calcular precios específica para añadir
    function calculateAddPrices() {
        try {
            const laborHours = parseFloat(document.getElementById('labor_hours').value) || 0;
            const laborCost = parseFloat(document.getElementById('labor_cost_per_hour').value) || 0;
            
            // Calcular costo de materiales
            let materialsCost = 0;

            // Calcular costo del material base
            const baseMaterialSelect = document.querySelector('#addProductModal select[data-is-base="true"]');
            const baseQuantity = document.getElementById('base_quantity');
            if (baseMaterialSelect && baseQuantity && baseMaterialSelect.value) {
                const selectedOption = baseMaterialSelect.selectedOptions[0];
                if (selectedOption && selectedOption.dataset.price) {
                    const price = parseFloat(selectedOption.dataset.price) || 0;
                    materialsCost += price * parseFloat(baseQuantity.value || 0);
                }
            }

            // Calcular costo de materiales adicionales
            const materialRows = document.querySelectorAll('#addProductModal .material-row');
            materialRows.forEach(row => {
                const material = row.querySelector('select[name="materials[]"]');
                const quantity = row.querySelector('input[name="quantities[]"]');
                if (material && material.value && quantity && quantity.value) {
                    const selectedOption = material.selectedOptions[0];
                    if (selectedOption && selectedOption.dataset.price) {
                        const price = parseFloat(selectedOption.dataset.price) || 0;
                        materialsCost += price * parseFloat(quantity.value);
                    }
                }
            });

            // Calcular precios
            const rawPrice = (laborHours * laborCost) + materialsCost;
            const priceWithMargin = rawPrice * (1 + MARGIN);
            const finalPrice = Math.ceil(priceWithMargin * (1 + IVA) / 100) * 100;

            // Actualizar campos
            document.getElementById('raw_price').value = rawPrice;
            document.getElementById('price_with_margin').value = priceWithMargin;
            document.getElementById('final_price').value = finalPrice;

            // Actualizar displays
            document.getElementById('raw_price_display').value = formatCurrency(rawPrice);
            document.getElementById('price_with_margin_display').value = formatCurrency(priceWithMargin);
            document.getElementById('final_price_display').value = formatCurrency(finalPrice);
        } catch (error) {
            console.error('Error en calculateAddPrices:', error);
        }
    }

    // Función para agregar material específica para añadir
    window.addAddMaterialRow = function() {
        const container = document.getElementById('materials_container');
        const baseSelect = container.querySelector('select[name="materials[]"]');
        const options = Array.from(baseSelect.options).map(opt => {
            return `<option value="${opt.value}" data-price="${opt.dataset.price}">${opt.textContent}</option>`;
        }).join('');

        const newRow = document.createElement('div');
        newRow.className = 'material-row flex items-end gap-2 mt-2';
        newRow.innerHTML = `
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Material Adicional</label>
                <select name="materials[]" 
                        class="w-full py-3 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900"
                        onchange="calculateAddPrices()">
                    <option value="">Seleccionar material adicional</option>
                    ${options}
                </select>
            </div>
            <div class="w-32">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                <input type="number" 
                    name="quantities[]" 
                    placeholder="Cantidad" 
                    required 
                    min="0" 
                    step="0.01"
                    onchange="calculateAddPrices()"
                    class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
            </div>
            <button type="button" onclick="removeAddMaterialRow(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(newRow);
    }

    // Función para remover material específica para añadir
    window.removeAddMaterialRow = function(button) {
        button.closest('.material-row').remove();
        calculateAddPrices();
    }

    // Agregar event listeners cuando el DOM esté cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Agregar event listeners para cálculos automatizados
        const laborHours = document.getElementById('labor_hours');
        const laborCost = document.getElementById('labor_cost_per_hour');
        const materialsContainer = document.getElementById('materials_container');
        const baseQuantity = document.getElementById('base_quantity');

        if (laborHours) laborHours.addEventListener('input', calculateAddPrices);
        if (laborCost) laborCost.addEventListener('input', calculateAddPrices);
        if (baseQuantity) baseQuantity.addEventListener('input', calculateAddPrices);
        if (materialsContainer) {
            materialsContainer.addEventListener('input', calculateAddPrices);
            materialsContainer.addEventListener('change', calculateAddPrices);
        }
    });
</script>
{{--SCRIPT PARA AÑADIR PRODUCTO--}}

{{-- CONSTANTES GLOBALES --}}
<script>
    // Constantes globales para toda la aplicación
    const MARGIN = 0.20; // 20%
    const IVA = 0.19;   // 19%

    // Función de formateo de moneda compartida
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP',
            minimumFractionDigits: 0
        }).format(amount);
    }
</script>
{{-- CONSTANTES GLOBALES --}}

{{--SCRIPT PARA ELIMINAR PRODUCTO--}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let deleteForm = null;
    
        window.openDeleteModal = function(productId) {
            console.log('Opening modal for product:', productId); // Para debugging
            // Crear el formulario dinámicamente
            deleteForm = document.createElement('form');
            deleteForm.method = 'POST';
            deleteForm.action = `/dashboard/product/${productId}`;
            
            // Agregar los tokens CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            deleteForm.appendChild(csrfToken);
            
            // Agregar el método DELETE
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            deleteForm.appendChild(methodField);
    
            // Mostrar el modal
            const modal = document.getElementById('deleteConfirmModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                console.error('Modal not found'); // Para debugging
            }
        }
    
        window.closeDeleteModal = function() {
            const modal = document.getElementById('deleteConfirmModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                deleteForm = null;
            }
        }
    
        // Agregar el event listener para el botón de confirmar
        const confirmButton = document.getElementById('confirmDelete');
        if (confirmButton) {
            confirmButton.addEventListener('click', function() {
                if (deleteForm) {
                    document.body.appendChild(deleteForm);
                    deleteForm.submit();
                }
                closeDeleteModal();
            });
        }
    
        // Cerrar modal al hacer clic fuera de él
        const deleteModal = document.getElementById('deleteConfirmModal');
        if (deleteModal) {
            deleteModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDeleteModal();
                }
            });
        }
    
    });
</script>
{{--SCRIPT PARA ELIMINAR PRODUCTO--}}

{{--SCRIPT PARA ELIMINAR ALERTA--}}
<script>
    // Esperar a que el DOM esté cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el elemento de alerta
        const successAlert = document.getElementById('success-alert');
        
        if (successAlert) {
            // Después de 3 segundos, agregar clase para fade out
            setTimeout(function() {
                successAlert.style.opacity = '0';
                
                // Después de la transición, remover el elemento
                setTimeout(function() {
                    successAlert.remove();
                }, 500); // 500ms para que coincida con la duración de la transición
            }, 3000); // 3 segundos
        }
    });
</script>
{{--SCRIPT PARA ELIMINAR ALERTA--}}

{{--SCRIPT PARA FUNCIONANMIENTO DEL MODAL CUSTOMIZATIONS ACTUALES--}}
<script>
    // Función para abrir el modal de personalizaciones
    function openCustomizationsModal(productId) {
        console.log('Opening modal for product:', productId); // Agregamos log para debug
        document.getElementById('productId').value = productId;
        document.getElementById('customizationsModal').classList.remove('hidden');
        loadCustomizations(productId);
    }

    // Función para cerrar el modal
    function closeCustomizationsModal() {
        document.getElementById('customizationsModal').classList.add('hidden');
    }

    let openAccordionType = null;

    // Función para cargar las personalizaciones existentes
    async function loadCustomizations(productId) {
        try {
            const response = await fetch(`/dashboard/product/${productId}/customizations`);
            const data = await response.json();
            
            const container = document.getElementById('currentCustomizations');
            container.innerHTML = '';

            if (!data.success) {
                container.innerHTML = `<div class="text-red-600">Error: ${data.error}</div>`;
                return;
            }

            if (!data.data || data.data.length === 0) {
                container.innerHTML = '<div class="text-gray-500">No hay personalizaciones para este producto</div>';
                return;
            }

            // Agrupar personalizaciones por tipo
            const groupedCustomizations = data.data.reduce((acc, curr) => {
                if (!acc[curr.customization_name]) {
                    acc[curr.customization_name] = [];
                }
                acc[curr.customization_name].push(curr);
                return acc;
            }, {});

            // Crear acordeón
            Object.entries(groupedCustomizations).forEach(([type, customizations], index) => {
                const accordion = document.createElement('div');
                accordion.className = 'border border-gray-200 rounded-lg mb-2';
                
                const header = document.createElement('button');
                header.className = 'w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition-colors';
                header.innerHTML = `
                    <span class="font-medium">${type}</span>
                    <svg class="w-5 h-5 transform transition-transform duration-200 ${index === 0 ? 'rotate-180' : ''}" 
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" 
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                              clip-rule="evenodd" />
                    </svg>
                `;
                
                const content = document.createElement('div');
                content.className = `p-4 bg-white ${type === openAccordionType ? '' : 'hidden'}`;
                content.innerHTML = `
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        ${customizations.map(customization => `
                            <div class="bg-gray-50 p-3 rounded-lg relative">
                                <div class="pr-8">
                                    <p class="text-sm text-gray-600">${customization.option_name || 'Sin opción'}</p>
                                    ${customization.material_name ? 
                                        `<p class="text-sm text-gray-500">Material: ${customization.material_name}</p>` : ''}
                                    ${customization.quantity_needed ? 
                                        `<p class="text-sm text-gray-500">Cantidad: ${customization.quantity_needed}</p>` : ''}
                                </div>
                                <button onclick="deleteCustomization(${customization.id})" 
                                        class="absolute top-2 right-2 text-red-600 hover:text-red-700">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        `).join('')}
                    </div>
                `;
                
                // Toggle acordeón
                header.onclick = () => {
                    const arrow = header.querySelector('svg');
                    arrow.classList.toggle('rotate-180');
                    content.classList.toggle('hidden');
                    // Actualizar el tipo de acordeón abierto
                    openAccordionType = content.classList.contains('hidden') ? null : type;
                };
                
                accordion.appendChild(header);
                accordion.appendChild(content);
                container.appendChild(accordion);
            });

        } catch (error) {
            console.error('Error:', error);
            const container = document.getElementById('currentCustomizations');
            container.innerHTML = '<div class="text-red-600">Error al cargar las personalizaciones</div>';
        }
    }

    // Función para eliminar una personalización
    async function deleteCustomization(id) {
        if (!confirm('¿Estás seguro de que deseas eliminar esta personalización?')) {
            return;
        }

        try {
            const response = await fetch(`/dashboard/product/customization/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            const data = await response.json();

            if (data.success) {
                // Recargar la lista de personalizaciones
                loadCustomizations(document.getElementById('productId').value);
            } else {
                // Mostrar mensaje de error en un alert personalizado
                const errorMessage = data.message || 'Error al eliminar la personalización';
                const alertDiv = document.createElement('div');
                alertDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
                alertDiv.innerHTML = `
                    <span class="block sm:inline">${errorMessage}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="this.parentElement.parentElement.remove()"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Cerrar</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                        </svg>
                    </span>
                `;
                
                // Insertar el mensaje de error al principio del modal
                const modalContent = document.querySelector('#customizationsModal .flex.flex-col');
                modalContent.insertBefore(alertDiv, modalContent.firstChild);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al eliminar la personalización');
        }
    }
</script>
{{--SCRIPT PARA FUNCIONANMIENTO DEL MODAL CUSTOMIZATIONS ACTUALES--}}

{{--SCRIPT PARA FUNCIONANMIENTO DEL MODAL CUSTOMIZATIONS NUEVAS--}}
<script>
    // Función para abrir el modal de personalizaciones
    function openAddCustomizationsModal(productId) {
        document.getElementById('customizationProductId').value = productId;
        document.getElementById('customizationsAddModal').classList.remove('hidden');
    }

    // Función para cerrar el modal
    function closeAddCustomizationsModal() {
        document.getElementById('customizationsAddModal').classList.add('hidden');
        // Limpiar el formulario
        document.getElementById('addCustomizationForm').reset();
        document.getElementById('optionsContainer').classList.add('hidden');
        document.getElementById('materialsContainer').classList.add('hidden');
    }

    // Función para agregar una nueva fila de material
    function addCustomizationMaterialRow() {
        const container = document.getElementById('materials_container');
        const newRow = document.createElement('div');
        newRow.className = 'material-row flex items-end gap-2 mt-2';
        
        newRow.innerHTML = `
            <div class="flex-1">
                <select name="materials[]" class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                    <option value="">Seleccionar material</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}" data-price="{{ $material->price_per_unit }}">
                            {{ $material->name }} ({{ $material->unit }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-32">
                <input type="number" 
                       name="quantities[]" 
                       placeholder="Cantidad" 
                       min="0" 
                       step="0.01"
                       class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="px-2 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        
        container.appendChild(newRow);
    }

    // Event listener para el select de personalización
    document.getElementById('customizationSelect').addEventListener('change', async function() {
        const customizationId = this.value;
        const optionsContainer = document.getElementById('optionsContainer');
        const materialsContainer = document.getElementById('materialsContainer');
        
        if (!customizationId) {
            optionsContainer.classList.add('hidden');
            materialsContainer.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch(`/dashboard/customization/${customizationId}/options`);
            const data = await response.json();

            if (data.options && data.options.length > 0) {
                optionsContainer.innerHTML = `
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" id="selectAllOptions" class="mr-2 rounded border-gray-300 text-[#006C55] focus:ring-[#006C55]">
                            <span>Seleccionar todas las opciones</span>
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        ${data.options.map(option => `
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="option_${option.id}"
                                       name="customization_options[]" 
                                       value="${option.id}"
                                       data-option-name="${option.option_name}"
                                       data-requires-material="${option.requires_material}"
                                       class="option-checkbox rounded border-gray-300 text-[#006C55] focus:ring-[#006C55]">
                                <label for="option_${option.id}" class="text-sm text-gray-700 ml-2">${option.option_name}</label>
                            </div>
                        `).join('')}
                    </div>
                `;

                optionsContainer.classList.remove('hidden');

                const selectAllCheckbox = document.getElementById('selectAllOptions');
                const optionCheckboxes = document.querySelectorAll('.option-checkbox');

                // Event listener para "Seleccionar todas"
                selectAllCheckbox.addEventListener('change', function() {
                    const optionCheckboxes = document.querySelectorAll('.option-checkbox');
                    optionCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                        updateMaterialsForOption(checkbox);
                    });
                });

                // Event listeners para opciones individuales
                optionCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const allChecked = Array.from(optionCheckboxes).every(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                        updateMaterialsForOption(this);
                    });
                });
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    // Función para actualizar la sección de materiales para una opción
    function updateMaterialsForOption(checkbox) {
        const optionId = checkbox.value;
        const optionName = checkbox.dataset.optionName;
        const requiresMaterial = checkbox.dataset.requiresMaterial === "1";
        const materialsContainer = document.getElementById('materialsContainer');
        const existingSection = document.getElementById(`materials_section_${optionId}`);
        
        console.log('Updating materials for option:', {
            optionId,
            optionName,
            requiresMaterial,
            checked: checkbox.checked,
            materialsContainerExists: !!materialsContainer,
            existingSectionExists: !!existingSection
        });

        if (!materialsContainer) {
            console.error('Materials container not found');
            return;
        }

        // Si la opción no requiere materiales o está desmarcada
        if (!requiresMaterial || !checkbox.checked) {
            if (existingSection) {
                existingSection.remove();
            }
            // Ocultar el contenedor si no hay más secciones de materiales
            const hasOtherSections = materialsContainer.querySelector('[id^="materials_section_"]');
            if (!hasOtherSections) {
                materialsContainer.classList.add('hidden');
            }
            return;
        }

        // Mostrar el contenedor de materiales
        materialsContainer.classList.remove('hidden');

        if (checkbox.checked && !existingSection) {
            const section = document.createElement('div');
            section.id = `materials_section_${optionId}`;
            section.className = 'bg-gray-50 p-4 rounded-lg mb-4';
            section.innerHTML = `
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-medium text-gray-700">Materiales para: ${optionName}</h4>
                    <button type="button" 
                            onclick="addMaterialRow('${optionId}')" 
                            class="px-3 py-1 bg-[#006C55] text-white rounded-md hover:bg-[#005544] text-sm">
                        Agregar Material
                    </button>
                </div>
                <div id="materials_container_${optionId}" class="space-y-2">
                    <div class="material-row flex items-end gap-2">
                        <div class="flex-1">
                            <select name="materials[${optionId}][]" class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900" required>
                                <option value="">Seleccionar material</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" data-price="{{ $material->price_per_unit }}">
                                        {{ $material->name }} ({{ $material->unit }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-32">
                            <input type="number" 
                                   name="quantities[${optionId}][]" 
                                   placeholder="Cantidad" 
                                   min="0" 
                                   step="0.01"
                                   class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900"
                                   required>
                        </div>
                    </div>
                </div>
            `;
            materialsContainer.appendChild(section);
        } else if (!checkbox.checked && existingSection) {
            // Eliminar la sección de materiales si la opción se desmarca
            existingSection.remove();
        }
    }

        // Función para agregar una fila de material a una opción específica
        function addMaterialRow(optionId) {
        const container = document.getElementById(`materials_container_${optionId}`);
        const newRow = document.createElement('div');
        newRow.className = 'material-row flex items-end gap-2 mt-2';
        
        newRow.innerHTML = `
            <div class="flex-1">
                <select name="materials[${optionId}][]" class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900" required>
                    <option value="">Seleccionar material</option>
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}" data-price="{{ $material->price_per_unit }}">
                            {{ $material->name }} ({{ $material->unit }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-32">
                <input type="number" 
                       name="quantities[${optionId}][]" 
                       placeholder="Cantidad" 
                       min="0" 
                       step="0.01"
                       class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900"
                       required>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="px-2 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        
        container.appendChild(newRow);
    }
</script>
{{--SCRIPT PARA FUNCIONANMIENTO DEL MODAL CUSTOMIZATIONS NUEVAS--}}

{{--SCRIPT PARA EL CAMBIO DE ESTADO--}}
<script>
    let currentProductId = null;

    function openToggleStatusModal(productId) {
        currentProductId = productId;
        document.getElementById('toggleStatusModal').classList.remove('hidden');
    }

    function closeToggleStatusModal() {
        document.getElementById('toggleStatusModal').classList.add('hidden');
        currentProductId = null;
    }

    function updateCounters(isActive) {
        const activesCounter = document.querySelector('[data-counter="actives"]');
        const inactivesCounter = document.querySelector('[data-counter="inactives"]');
        
        let actives = parseInt(activesCounter.textContent);
        let inactives = parseInt(inactivesCounter.textContent);
        
        if (isActive) {
            actives += 1;
            inactives -= 1;
        } else {
            actives -= 1;
            inactives += 1;
        }
        
        activesCounter.textContent = actives;
        inactivesCounter.textContent = inactives;
    }

    // Función para cambiar el estado del producto
    function toggleProductStatus(productId) {
        openToggleStatusModal(productId);
    }

    // Event listener para el botón de confirmar
    document.getElementById('confirmToggleStatus').addEventListener('click', function() {
        if (currentProductId) {
            fetch(`/dashboard/product/${currentProductId}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const button = document.querySelector(`[data-product-id="${currentProductId}"]`);
                if (data.is_active) {
                    button.textContent = 'Activo';
                    button.classList.remove('bg-[#FFEAE5]', 'text-[#56170D]', 'hover:bg-[#F8B7AA]');
                    button.classList.add('bg-[#E0EFEC]', 'text-[#006C55]', 'hover:bg-[#006C55]', 'hover:text-white');
                } else {
                    button.textContent = 'Inactivo';
                    button.classList.remove('bg-[#E0EFEC]', 'text-[#006C55]', 'hover:bg-[#006C55]', 'hover:text-white');
                    button.classList.add('bg-[#FFEAE5]', 'text-[#56170D]', 'hover:bg-[#F8B7AA]');
                }
                // Actualizar los contadores
                updateCounters(data.is_active);
                // Cerrar el modal
                closeToggleStatusModal();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al cambiar el estado del producto');
                closeToggleStatusModal();
            });
        }
    });
</script>
{{--SCRIPT PARA EL CAMBIO DE ESTADO--}}
@endsection