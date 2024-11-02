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
        </a>
    </div>
</div>
{{--MAIN--}}

{{--NUESTROS PRODUCTOS--}}
<div class="h-[60dvh] w-full flex flex-col justify-between py-6 items-center px-4 font-montserrat md:px-20 xl:px-28">
    <h2 class="font-cinzel sm:text-xl md:text-2xl xl:text-3xl">Nuestros productos</h2>
    <div class="w-full h-[70%] grid grid-cols-2 gap-2 xl:grid-cols-4 items-center">
        {{--REPETIR--}}
        <a href="" class="w-full h-full col-span-1 grid grid-cols-1 grid-rows-1 xl:h-[70%]">
            <img src="" alt="" class="w-full h-full object-cover col-start-1 row-start-1">
            <div class="col-start-1 row-start-1 flex items-center justify-center w-full h-full">
                <p  class="">Aros</p>
            </div>
        </a>
        {{--REPETIR--}}
        <a href="" class="w-full h-full col-span-1 grid grid-cols-1 grid-rows-1 xl:h-[70%]">
            <img src="" alt="" class="w-full h-full object-cover col-start-1 row-start-1">
            <div class="col-start-1 row-start-1 flex items-center justify-center w-full h-full">
                <p  class="">Anillos</p>
            </div>
        </a>
        <a href="" class="w-full h-full col-span-1 grid grid-cols-1 grid-rows-1 xl:h-[70%]">
            <img src="" alt="" class="w-full h-full object-cover col-start-1 row-start-1">
            <div class="col-start-1 row-start-1 flex items-center justify-center w-full h-full">
                <p  class="">Brazaletes</p>
            </div>
        </a>
        <a href="" class="w-full h-full col-span-1 grid grid-cols-1 grid-rows-1 xl:h-[70%]">
            <img src="" alt="" class="w-full h-full object-cover col-start-1 row-start-1">
            <div class="col-start-1 row-start-1 flex items-center justify-center w-full h-full">
                <p  class="">Collares</p>
            </div>
        </a>
    </div>
    <a href="" class="sm:text-lg md:text-xl">Ver todo</a>
</div>
{{--NUESTROS PRODUCTOS--}}

{{--NUEVOS PRODUCTOS--}}
<div class="font-montserrat bg-gradient-to-bl from-sec-900 via-sec-800 to-sec-900 text-cwhite-500 flex flex-col items-center justify-between px-4 md:px-20 xl:px-28">
    <div class="py-8 flex flex-col gap-3">
        <h3 class="font-cinzel sm:text-xl md:text-2xl xl:text-3xl">Nuevos Productos</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non unde laudantium nisi molestiae in, voluptatem veritatis natus, dolorem eaque totam libero. Optio praesentium error animi rem molestiae laboriosam aut dolor.</p>
    </div>
    <div class="pb-6 xl:flex xl:gap-5">
        {{--<h4 class="">Nombre prod 1</h4>--}}
        <img src="" alt="" class="w-full h-[20dvh] rounded-[5rem] xl:order-1">
        <p class="mt-3 xl:order-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita velit ullam, eius aperiam deserunt accusamus animi aliquid alias asperiores dolor minus sapiente, officiis ipsa modi aut aspernatur eum? Eligendi, quos.</p>
    </div>
    <div class="pb-6 xl:flex xl:gap-5">
        {{--<h4 class="">Nombre prod 2</h4>--}}
        <img src="" alt="" class="w-full h-[20dvh] rounded-[5rem] xl:order-2">
        <p class="mt-3 xl:order-1">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus distinctio in tempora obcaecati cumque sed voluptatibus provident, iste quaerat culpa tempore est! Quidem numquam quod veritatis quo labore quisquam reiciendis?</p>
    </div>
    <div class="pb-6 xl:flex xl:gap-5">
        {{--<h4 class="">Nombre prod 3</h4>--}}
        <img src="" alt="" class="w-full h-[20dvh] rounded-[5rem] xl:order-1">
        <p class="mt-3 xl:order-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti animi mollitia, quis placeat tenetur recusandae porro necessitatibus nisi, iure sed quas earum nulla quo cupiditate perspiciatis error aspernatur voluptatem. Voluptate.</p>
    </div>
    <div class="pb-6 xl:flex xl:gap-5">
        {{--<h4 class="">Nombre prod 4</h4>--}}
        <img src="" alt="" class="w-full h-[20dvh] rounded-[5rem] xl:order-2">
        <p class="mt-3 xl:order-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur eveniet officiis doloribus, enim autem dicta hic architecto, eaque cupiditate non et ea labore corrupti corporis. Ipsa vero quidem veniam. Sunt!</p>
    </div>
</div>
{{--NUEVOS PRODUCTOS--}}

{{--MÁS VENDIDOS--}}
<div class="w-full flex flex-col justify-between py-6 items-center px-4 font-montserrat md:px-20 xl:px-28">
    <h2 class="font-cinzel  sm:text-xl md:text-2xl xl:text-3xl">Productos más vendidos</h2>
    <div class="w-full grid grid-cols-2 gap-2 items-center py-8 xl:grid-cols-4">
        {{--REPETIR--}}
        <div class="col-span-1 h-[30vh] mb-4 xl:h-[40vh]">
            <a href="" class="w-full col-span-1 xl:h-[70%]">
                <img src="" alt="" class="w-full h-[20vh] object-cover sm:h-[25vh] xl:h-[30vh]">
            </a>
            <div class="pt-3">
                <h4>Nom Prod</h4>
                <h4>$$$</h4>
                <a href="">Comprar</a>
            </div>
        </div>
        {{--REPETIR--}}

        <div class="col-span-1 h-[30vh] mb-4 xl:h-[40vh]">
            <a href="" class="w-full col-span-1 xl:h-[70%]">
                <img src="" alt="" class="w-full h-[20vh] object-cover sm:h-[25vh] xl:h-[30vh]">
            </a>
            <div class="pt-3">
                <h4>Nom Prod</h4>
                <h4>$$$</h4>
                <a href="">Comprar</a>
            </div>
        </div>

        <div class="col-span-1 h-[30vh] mb-4 xl:h-[40vh]">
            <a href="" class="w-full col-span-1 xl:h-[70%]">
                <img src="" alt="" class="w-full h-[20vh] object-cover sm:h-[25vh] xl:h-[30vh]">
            </a>
            <div class="pt-3">
                <h4>Nom Prod</h4>
                <h4>$$$</h4>
                <a href="">Comprar</a>
            </div>
        </div>

        <div class="col-span-1 h-[30vh] mb-4 xl:h-[40vh]">
            <a href="" class="w-full col-span-1 xl:h-[70%]">
                <img src="" alt="" class="w-full h-[20vh] object-cover sm:h-[25vh] xl:h-[30vh]">
            </a>
            <div class="pt-3">
                <h4>Nom Prod</h4>
                <h4>$$$</h4>
                <a href="">Comprar</a>
            </div>
        </div>
    </div>
    <a href="" class="sm:text-lg md:text-xl">Ver todo</a>
</div>
{{--MÁS VENDIDOS--}}

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
        </a>
    </div>
</div>
{{--CALL TO ACTION--}}

{{--IDEAS DE REGALOS--}}
<div class="w-full flex flex-col gap-6 py-12 px-4 font-montserrat md:px-20 xl:px-28 xl:grid xl:grid-cols-4 xl:gap-2">
    <div class="w-full flex flex-col items-start gap-3 xl:col-span-1">
        <img src="" alt="" class="w-[60vw] h-[10vh] object-cover xl:w-full xl:h-[25vh]">
        <div class="flex w-full items-center justify-center">
            <p class="">Para...</p>
        </div>
    </div>
    <div class="w-full flex flex-col items-end gap-3 xl:col-span-2">
        <img src="" alt="" class="w-[60vw] h-[10vh] object-cover xl:w-full xl:h-[25vh]">
        <div class="flex w-full items-center justify-center">
            <p class="">Para...</p>
        </div>
    </div>
    <div class="w-full flex flex-col items-start gap-3 xl:col-span-1">
        <img src="" alt="" class="w-[60vw] h-[10vh] object-cover xl:w-full xl:h-[25vh]">
        <div class="flex w-full items-center justify-center">
            <p class="">Para...</p>
        </div>
    </div>
    <div class="w-full flex flex-col items-end gap-3 xl:col-span-2">
        <img src="" alt="" class="w-[60vw] h-[10vh] object-cover xl:w-full xl:h-[25vh]">
        <div class="flex w-full items-center justify-center">
            <p class="">Para...</p>
        </div>
    </div>
    <div class="w-full flex flex-col items-start gap-3 xl:col-span-2">
        <img src="" alt="" class="w-[60vw] h-[10vh] object-cover xl:w-full xl:h-[25vh]">
        <div class="flex w-full items-center justify-center">
            <p class="">Para...</p>
        </div>
    </div>
</div>
{{--IDEAS DE REGALOS--}}
@endsection