@extends('template.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8 font-montserrat overflow-y-scroll">
    <div class="max-w-[800px] mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-cinzel font-medium text-cwhite-500">Editar Producto</h3>
        </div>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

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
                               value="{{ old('name', $product->name) }}"
                               class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select name="category" 
                                id="category"
                                required
                                class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                            <option value="">Seleccionar categoría</option>
                            @foreach(['Aros', 'Anillos', 'Brazaletes', 'Collares'] as $category)
                                <option value="{{ $category }}" {{ old('category', $product->category) == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                    <input type="file" 
                           name="image" 
                           id="image"
                           accept="image/*"
                           class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                    @if($product->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded">
                        </div>
                    @endif
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Costos y Precios --}}
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h4 class="font-medium text-gray-700 mb-2">Costos y Precios</h4>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="labor_hours" class="block text-sm font-medium text-gray-700 mb-1">Horas de Trabajo</label>
                        <input type="number" 
                               name="labor_hours" 
                               id="labor_hours"
                               required
                               min="0"
                               step="0.01"
                               value="{{ old('labor_hours', $product->labor_hours) }}"
                               class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                        @error('labor_hours')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="labor_cost_per_hour" class="block text-sm font-medium text-gray-700 mb-1">Costo por Hora</label>
                        <input type="number" 
                               name="labor_cost_per_hour" 
                               id="labor_cost_per_hour"
                               required
                               min="0"
                               step="0.01"
                               value="{{ old('labor_cost_per_hour', $product->labor_cost_per_hour) }}"
                               class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                        @error('labor_cost_per_hour')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            {{-- Materiales --}}
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h4 class="font-medium text-gray-700 mb-2">Materiales del Producto</h4>
                @foreach($product->materials as $index => $material)
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div>
                            <select name="materials[]" class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                                @foreach($materials as $mat)
                                    <option value="{{ $mat->id }}" 
                                            {{ old("materials.$index", $material->id) == $mat->id ? 'selected' : '' }}>
                                        {{ $mat->name }} - ${{ number_format($mat->price_per_unit, 0, ',', '.') }} por {{ $mat->unit }}
                                    </option>
                                @endforeach
                            </select>
                            @error("materials.$index")
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <input type="number"
                                   name="quantities[]" 
                                   value="{{ old("quantities.$index", $material->pivot->quantity_needed) }}"
                                   required 
                                   min="0" 
                                   step="0.01"
                                   class="w-full py-2 px-3 rounded-md border border-[#737878] bg-[#E0EFEC] text-gray-900">
                            @error("quantities.$index")
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>


            {{-- Botones de acción --}}
            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('admin.product') }}"
                   class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100">
                    Cancelar
                </a>
                <button type="submit"
                        class="py-2 px-4 bg-[#006C55] text-white rounded-md transition-colors">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection