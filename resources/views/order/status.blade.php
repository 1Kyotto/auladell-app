@extends('template.master')

@section('content')
<div class="w-full flex items-center justify-center font-montserrat">
    <div class="w-1/3 h-[500px] my-12 border border-[#CED4E0] rounded-lg p-4 flex flex-col">
        <h4 class="text-xl font-semibold font-cinzel">Orden #{{ $orderNumber }}</h4>

        <div class="mt-2 flex flex-col border-b border-[#CED4E0] pb-3">
            <div class="flex flex-col text-[12px]">
                <span class="font-semibold text-[#515255]">Servicio de entrega</span>
                <span>Starken. Empresas Transportes, Tecnología y Giros EGT Ltda</span>
            </div>
            <div class="mt-2 flex gap-28">
                <div class="flex flex-col text-[12px]">
                    <span class="font-semibold text-[#515255]">Ciudad</span>
                    <span class="text-md">{{ $city }}</span>
                </div>
                <div class="flex flex-col text-[12px]">
                    <span class="font-semibold text-[#515255]">Comuna</span>
                    <span class="text-md">{{ $locality }}</span>
                </div>
            </div>
            <div class="mt-2">
                <div class="flex flex-col text-[12px]">
                    <span class="font-semibold text-[#515255]">Dirección</span>
                    <span class="text-md">{{ $address }}</span>
                </div>
            </div>
        </div>

        <div class="mt-1">
            <div class="bg-white p-3">
                <ol class="relative border-l border-gray-300">
                    @foreach ($filteredStatuses as $step)
                        <li class="mb-10 ml-6">
                            <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-4 ring-white">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M16.707 7.293a1 1 0 00-1.414 0L9 13.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"></path>
                                </svg>
                            </span>
                            <h3 class="text-lg font-semibold text-gray-900">
                                @if ($step === 'Waiting')
                                    Pedido Realizado
                                @elseif ($step === 'Production')
                                    Pedido en Producción
                                @elseif ($step === 'Packaging')
                                    Embalaje del Pedido
                                @elseif ($step === 'Shipped')
                                    Producto en Servicio de Entrega
                                @endif
                            </h3>
                        </li>
                    @endforeach
                </ol>
            </div>              
        </div>
    </div>
</div>
@endsection
