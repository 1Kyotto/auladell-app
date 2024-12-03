@extends('template.dashboard')

@section('content')
<div class="flex flex-col h-full text-cblack-500 font-montserrat text-sm">
    {{-- Mensajes de notificación --}}
    @if(session('success'))
        <div id="success-alert" class="mb-4 bg-green-100 border mx-16 border-green-400 text-green-700 py-3 rounded relative transition-opacity duration-500" role="alert">
            <span class="block sm:inline px-6">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Header y Estadísticas --}}
    <div class="flex-shrink-0 px-6 pt-5 pb-8">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-cinzel text-cwhite-500">Materiales</h1>
            <button onclick="openAddMaterialModal()" class="bg-[#006C55] hover:bg-[#005544] text-white font-medium py-2 px-4 rounded-md text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Añadir Material
            </button>
        </div>

        {{-- Cards de Estadísticas --}}
        <div class="grid grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4">
                    <div class="text-[13px] font-cinzel text-gray-500">Total de materiales</div>
                    <div class="text-lg font-bold">{{ $items }}</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4">
                    <div class="text-[13px] font-cinzel text-gray-500">Materiales con stock</div>
                    <div class="text-lg font-bold">{{ $actives }}</div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4">
                    <div class="text-[13px] font-cinzel text-gray-500">Materiales sin stock</div>
                    <div class="text-lg font-bold">{{ $items - $actives }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de Materiales --}}
    <div class="flex-1 px-6 pb-6 min-h-0">
        <div class="flex flex-col h-full bg-[#E0E0E0] shadow-sm">
            <div class="flex-1 overflow-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Material
                            </th>
                            <th class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción
                            </th>
                            <th class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio por Unidad
                            </th>
                            <th class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Unidad
                            </th>
                            <th class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider flex gap-1">
                                Acciones
                                <div class="group relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="hidden group-hover:block absolute z-10 text-center w-48 p-2 mt-1 text-sm text-gray-500 bg-white rounded-lg shadow-lg border border-gray-200 -left-40">
                                        Haz clic en la acción correspondiente para <strong class="text-[#006C55]">Editar</strong> el material.
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($materials as $material)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $material->name }}</td>
                            <td class="px-6 py-4">{{ $material->description }}</td>
                            <td class="px-6 py-4">${{ number_format($material->price_per_unit, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-4 py-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $material->quantity_in_stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $material->quantity_in_stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $material->unit }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-6 items-center justify-center">
                                    <button onclick="openEditMaterial({{ $material->id }})" class="text-[#006C55] hover:text-[#005544] font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                            <path d="M15.2141 5.98239L16.6158 4.58063C17.39 3.80646 18.6452 3.80646 19.4194 4.58063C20.1935 5.3548 20.1935 6.60998 19.4194 7.38415L18.0176 8.78591M15.2141 5.98239L6.98023 14.2163C5.93493 15.2616 5.41226 15.7842 5.05637 16.4211C4.70047 17.058 4.3424 18.5619 4 20C5.43809 19.6576 6.94199 19.2995 7.57889 18.9436C8.21579 18.5877 8.73844 18.0651 9.78375 17.0198L18.0176 8.78591M15.2141 5.98239L18.0176 8.78591" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M11 20H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Paginación --}}
            <div class="flex-shrink-0 px-6 py-4 border-t border-gray-200 bg-white">
                {{ $materials->links() }}
            </div>
        </div>
    </div>
</div>

{{-- Modal de Añadir Material --}}
<div id="addMaterialModal" class="fixed font-montserrat inset-0 text-cblack-500 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 999;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-cinzel font-medium text-gray-900">Añadir Nuevo Material</h3>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Cerrar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="{{ route('admin.materials.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" required class="mt-1 border border-[#CED4E0] px-2 py-3 block w-full rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border border-[#CED4E0] px-2 py-3 shadow-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Precio por Unidad</label>
                <input type="number" name="price_per_unit" required min="0" step="0.01" class="mt-1 block w-full rounded-md border border-[#CED4E0] px-2 py-3 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="quantity_in_stock" required min="0" step="0.01" class="mt-1 block w-full rounded-md border border-[#CED4E0] px-2 py-3 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Unidad</label>
                <input type="text" name="unit" required class="mt-1 block w-full rounded-md border border-[#CED4E0] px-2 py-3 shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-[#006C55] hover:bg-[#005544] text-white font-medium py-2 px-4 rounded-md text-sm">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal de Editar Material --}}
<div id="editMaterialModal" class="fixed text-cblack-500 font-montserrat inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full" style="z-index: 999;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-cinzel font-medium text-gray-900">Editar Material</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Cerrar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="editMaterialForm" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="edit_name" required class="mt-1 border border-[#CED4E0] px-2 py-3 block w-full rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="edit_description" rows="3" class="mt-1 border border-[#CED4E0] px-2 py-3 block w-full rounded-md shadow-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Precio por Unidad</label>
                <input type="number" name="price_per_unit" id="edit_price_per_unit" required min="0" step="0.01" class="mt-1 border border-[#CED4E0] px-2 py-3 block w-full rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="quantity_in_stock" id="edit_quantity_in_stock" required min="0" step="0.01" class="mt-1 block w-full rounded-md border border-[#CED4E0] px-2 py-3 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Unidad</label>
                <input type="text" name="unit" id="edit_unit" required class="mt-1 block w-full rounded-md border border-[#CED4E0] px-2 py-3 shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-[#006C55] hover:bg-[#005544] text-white font-medium py-2 px-4 rounded-md text-sm">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Funciones para el modal de añadir
    function openAddMaterialModal() {
        document.getElementById('addMaterialModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addMaterialModal').classList.add('hidden');
    }

    // Funciones para el modal de editar
    async function openEditMaterial(id) {
        try {
            const response = await fetch(`/dashboard/materials/${id}/edit`);
            const material = await response.json();
            
            document.getElementById('edit_name').value = material.name;
            document.getElementById('edit_description').value = material.description;
            document.getElementById('edit_price_per_unit').value = material.price_per_unit;
            document.getElementById('edit_quantity_in_stock').value = material.quantity_in_stock;
            document.getElementById('edit_unit').value = material.unit;
            
            document.getElementById('editMaterialForm').action = `/dashboard/materials/${id}`;
            document.getElementById('editMaterialModal').classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function closeEditModal() {
        document.getElementById('editMaterialModal').classList.add('hidden');
    }

    // Auto-ocultar alertas
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                setTimeout(() => {
                    successAlert.remove();
                }, 500);
            }, 3000);
        }
    });
</script>
@endsection