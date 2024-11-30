@extends('template.dashboard')

@section('content')
<div class="text-cwhite-500 w-full h-full font-montserrat grid grid-rows-[auto,auto,1fr]">
    <div class="px-16 pt-12 w-full flex justify-between items-center">
        <span class="font-cinzel">PRODUCTOS</span>

        <button class="bg-[#006C55] text-sm py-2 px-4 rounded-lg">AÑADIR PRODUCTO</button>
    </div>
    <div class="px-16 pt-10 w-full">
        <div class="bg-[#E0E0E0] w-full font-cinzel rounded-md flex items-center justify-between text-[13px] text-cblack-500 py-4 px-6">
            <div class="flex flex-col items-start">
                <span>Total de productos</span>
                <span class="font-bold font-montserrat text-sm">{{ $items }}</span>
            </div>

            <div class="flex flex-col items-start">
                <span>Aros</span>
                <span class="font-bold font-montserrat text-sm">{{ $aros }}</span>
            </div>
            <div class="flex flex-col items-start">
                <span>Anillos</span>
                <span class="font-bold font-montserrat text-sm">{{ $anillos }}</span>
            </div>
            <div class="flex flex-col items-start">
                <span>Brazaletes</span>
                <span class="font-bold font-montserrat text-sm">{{ $brazaletes }}</span>
            </div>
            <div class="flex flex-col items-start">
                <span>Collares</span>
                <span class="font-bold font-montserrat text-sm">{{ $collares }}</span>
            </div>

            <div class="flex flex-col items-start">
                <span>Productos Activos</span>
                <span class="font-bold font-montserrat text-sm">{{ $actives }}</span>
            </div>
        </div>
    </div>

    <div class="px-16 pt-8 pb-10 w-full">
        <div class="w-full h-full bg-[#E0E0E0] rounded-md">

        </div>
    </div>
</div>
@endsection