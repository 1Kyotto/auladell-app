@extends('template.master')

@section('content')
{{--MAIN--}}
<div class="h-[80dvh] w-full px-4 text-cwhite-500 flex flex-col justify-center font-montserrat text-xl bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 md:px-20 xl:px-28">
    <div class="flex flex-col">
        <h1 class="font-cinzel text-4xl max-w-[80%] mb-4 sm:text-5xl lg:text-6xl">¡Diseña tu joya única hoy!</h1>
        <h2 class="mb-8 font-cinzel text-2xl max-w-[80%] sm:text-3xl lg:text-4xl ">Personaliza cada detalle y brilla con estilo propio.</h2>
        <p class="max-w-[80%] text-base sm:text-xl md:text-2xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum omnis expedita animi nihil tempora ratione aliquid officia? Nemo libero ipsa, nisi saepe esse eaque id qui, beatae natus consectetur fugit.</p>
    </div>
    <div class="w-full mt-14 flex items-center justify-center xl:justify-start">
        <a href="" class="text-xl md:text-2xl">
            Personalizar
            <svg class="w-[120px] h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
            </svg>
        </a>
    </div>
</div>
{{--MAIN--}}

{{--NUESTROS PRODUCTOS--}}
<div class="h-[75dvh] w-full flex flex-col pt-5 items-center px-4 font-montserrat md:px-20 xl:px-28">
    <h2 class="font-cinzel sm:text-xl md:text-2xl xl:text-3xl">Nuestros productos</h2>
    <div class="w-full h-[70%] grid grid-cols-2 gap-2 xl:grid-cols-4 items-center">
        @foreach ($products as $product)
            <a href="{{ route('jewelry.show', ['id' => $product->id]) }}" class="w-full h-full col-span-1 grid grid-cols-1 grid-rows-1 xl:h-[70%] relative group overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover col-start-1 row-start-1 transition-transform duration-500 ease-in-out group-hover:blur-[3px] z-10">
                <div class="col-start-1 row-start-1 flex items-center justify-center w-full h-full bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20">
                    <p class="text-cwhite-500 px-6 font-bold">{{ $product->name }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <a href="{{ route('jewelry.index', ['type' => 'all-products']) }}" class="sm:text-lg md:text-xl pt-3">
        Ver todo
        <svg class="w-[90px] h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
            <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
            <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
        </svg>
    </a>
</div>
{{--NUESTROS PRODUCTOS--}}

{{--CALL TO ACTION--}}
<div class="h-[80dvh] w-full px-4 text-cwhite-500 flex flex-col justify-center font-montserrat text-xl bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 md:px-20 xl:px-28">
    <div class="flex flex-col">
        <h1 class="font-cinzel text-4xl max-w-[80%] mb-4 sm:text-5xl lg:text-6xl">¡Diseña tu joya única hoy!</h1>
        <h2 class="mb-8 font-cinzel text-2xl max-w-[80%] sm:text-3xl lg:text-4xl ">Personaliza cada detalle y brilla con estilo propio.</h2>
        <p class="max-w-[80%] text-base sm:text-xl md:text-2xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum omnis expedita animi nihil tempora ratione aliquid officia? Nemo libero ipsa, nisi saepe esse eaque id qui, beatae natus consectetur fugit.</p>
    </div>
    <div class="w-full mt-14 flex items-center justify-center xl:justify-start">
        <a href="" class="text-xl md:text-2xl">
            Personalizar
            <svg class="w-[120px] h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 10" preserveAspectRatio="none">
                <line x1="0" y1="5" x2="101" y2="5" stroke="currentColor" stroke-width="2" />
                <polyline points="97,0 102,5 97,10" fill="none" stroke="currentColor" stroke-width="2" />
            </svg>
        </a>
    </div>
</div>
{{--CALL TO ACTION--}}
@endsection