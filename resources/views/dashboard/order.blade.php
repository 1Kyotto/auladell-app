@extends('template.dashboard')

@section('content')
<div class="flex flex-col h-full text-cblack-500 font-montserrat">
    {{-- Header --}}
    <div class="flex-shrink-0 px-6 pt-5 pb-8">
        {{-- Header --}}
        <h2 class="text-xl font-cinzel text-cwhite-500">Gestión de Pedidos</h2>
    </div>

    {{-- Tabla de ordenes --}}
    <div class="flex-1 px-6 pb-6 min-h-0">
        <div class="flex flex-col h-full bg-[#E0E0E0] shadow-sm">
            {{-- Contenedor de la tabla con scroll --}}
            <div class="flex-1 overflow-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                N° Orden
                            </th>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cliente
                            </th>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col" class="font-cinzel px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                            </th>
                            <th scope="col" class="flex gap-1 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                                <div class="group relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="hidden group-hover:block absolute z-10 text-center w-48 p-2 mt-1 text-sm text-gray-500 bg-white rounded-lg shadow-lg border border-gray-200 -left-40">
                                        Haz clic en la acción correspondiente para <strong class="text-[#006C55]">Ver Detalles</strong> o <strong class="text-[#006C55]">Actualizar Estado</strong>.
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $order->order_num }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $order->user ? $order->user->name : 'Cliente Invitado' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($order->total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 rounded-full text-sm 
                                    @switch($order->status)
                                        @case('Waiting')
                                            bg-yellow-100 text-yellow-800
                                            @break
                                        @case('Production')
                                            bg-blue-100 text-blue-800
                                            @break
                                        @case('Packaging')
                                            bg-purple-100 text-purple-800
                                            @break
                                        @case('Shipped')
                                            bg-indigo-100 text-indigo-800
                                            @break
                                        @case('Fulfilled')
                                            bg-green-100 text-green-800
                                            @break
                                        @case('Cancelled')
                                            bg-red-100 text-red-800
                                            @break
                                    @endswitch
                                ">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-6">
                                    <button onclick="viewOrder({{ $order->id }})" class="text-[#006C55] hover:text-[#005544] font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                            <path d="M21.544 11.045C21.848 11.4713 22 11.6845 22 12C22 12.3155 21.848 12.5287 21.544 12.955C20.1779 14.8706 16.6892 19 12 19C7.31078 19 3.8221 14.8706 2.45604 12.955C2.15201 12.5287 2 12.3155 2 12C2 11.6845 2.15201 11.4713 2.45604 11.045C3.8221 9.12944 7.31078 5 12 5C16.6892 5 20.1779 9.12944 21.544 11.045Z" stroke="currentColor" stroke-width="2" />
                                            <path d="M15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12Z" stroke="currentColor" stroke-width="2" />
                                        </svg>
                                    </button>
                                    <button onclick="updateStatus({{ $order->id }})" class="text-[#006C55] hover:text-[#005544] font-medium">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500">
                                No hay pedidos registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Paginación --}}
            <div class="flex-shrink-0 px-6 py-4 border-t border-gray-200 bg-white">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver detalles del pedido -->
<div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full text-cblack-500">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">Detalles del Pedido</h3>
            <button onclick="closeOrderModal()" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Cerrar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="orderDetails" class="space-y-4">
            <!-- Los detalles del pedido se cargarán aquí -->
        </div>
    </div>
</div>

<!-- Modal para actualizar estado -->
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full text-cblack-500">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium">Actualizar Estado</h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-500">
                <span class="sr-only">Cerrar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="updateStatusForm" class="space-y-4" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 pb-1 border-b border-[#CED4E0]">Estado</label>
                <select name="status" class="mt-4 block w-full rounded-md border border-[#CED4E0] px-2 py-3 shadow-sm">
                    <option value="Waiting">Esperando</option>
                    <option value="Production">En Producción</option>
                    <option value="Packaging">Empaquetando</option>
                    <option value="Shipped">Enviado</option>
                    <option value="Fulfilled">Completado</option>
                    <option value="Cancelled">Cancelado</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="py-2 px-4 bg-[#006C55] hover:bg-[#005544] text-white font-medium rounded-md text-sm">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Función para ver detalles del pedido
    async function viewOrder(orderId) {
        try {
            const response = await fetch(`/dashboard/order/${orderId}`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            
            const detailsHtml = `
                <div class="border-b pb-4">
                    <p class="font-medium">N° Orden: ${data.order_num}</p>
                    <p>Cliente: ${data.user ? data.user.name : 'Cliente Invitado'}</p>
                    <p>Fecha: ${new Date(data.created_at).toLocaleString()}</p>
                    <p>Estado: ${data.status}</p>
                </div>
                <div class="space-y-4">
                    <h4 class="font-medium">Productos:</h4>
                    ${data.products.map(product => `
                        <div class="border-b pb-2">
                            <p class="font-medium">${product.name}</p>
                            <p>Cantidad: ${product.pivot.quantity}</p>
                            <p>Precio unitario: $${Number(product.pivot.unit_price).toLocaleString('es-CL', { maximumFractionDigits: 0 })}</p>
                            ${product.customization_selections && product.customization_selections.length > 0 ? `
                                <div class="ml-4 mt-2">
                                    <p class="text-sm font-medium">Personalizaciones:</p>
                                    ${product.customization_selections.map(selection => `
                                        <div class="ml-2 text-sm">
                                            <p>• ${selection.customization_option.option_name}${
                                                selection.customization_option.requires_material && 
                                                selection.customization_option.customization_materials && 
                                                selection.customization_option.customization_materials.length > 0
                                                ? ` - ${[...new Set(selection.customization_option.customization_materials
                                                    .filter(cm => cm && cm.material)
                                                    .map(cm => cm.material.name))]
                                                    .join(', ')}`
                                                : ''
                                            } - ${selection.quantity} unidad(es)</p>
                                        </div>
                                    `).join('')}
                                </div>
                            ` : ''}
                            <p>Total: $${Number(product.pivot.total_price).toLocaleString('es-CL', { maximumFractionDigits: 0 })}</p>
                        </div>
                    `).join('')}
                    <div class="mt-4 text-right">
                        <p class="font-medium">Total del pedido: $${Number(data.total).toLocaleString('es-CL', { maximumFractionDigits: 0 })}</p>
                    </div>
                </div>
            `;
            
            document.getElementById('orderDetails').innerHTML = detailsHtml;
            const modal = document.getElementById('orderModal');
            modal.style.display = 'block';
            modal.classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
            alert('Error al cargar los detalles del pedido');
        }
    }

    // Función para actualizar estado
    function updateStatus(orderId) {
        const form = document.getElementById('updateStatusForm');
        form.action = `/dashboard/order/${orderId}/status`;
        const modal = document.getElementById('statusModal');
        modal.style.display = 'block';
        modal.classList.remove('hidden');
    }

    // Funciones para cerrar modales
    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.style.display = 'none';
        modal.classList.add('hidden');
    }

    // Funciones para cerrar modales
    function closeOrderModal() {
        const modal = document.getElementById('orderModal');
        modal.style.display = 'none';
        modal.classList.add('hidden');
    }

    // Cerrar modales al hacer clic fuera de ellos
    window.onclick = function(event) {
        const statusModal = document.getElementById('statusModal');
        if (event.target === statusModal) {
            closeStatusModal();
        }
    }

    // Cerrar modales al hacer clic fuera de ellos
    window.onclick = function(event) {
        const orderModal = document.getElementById('orderModal');
        if (event.target === orderModal) {
            closeOrderModal();
        }
    }
</script>
@endsection