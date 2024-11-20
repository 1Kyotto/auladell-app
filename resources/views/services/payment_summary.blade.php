@extends('template.master')

@section('content')

<div class="col-span-6 grid grid-cols-8 grid-rows-1 bg-red-600">
    <div class="col-start-3 col-end-7 bg-orange-400 pt-8">
        <p class="text-3xl">Pedido confirmado</p>
        <hr class="mx-auto max-w-sm border-black">
        <p class="mx-auto max-w-sm text-justify py-2">balablblalbalbalbalablablabllabllbalbalablablballbalablbalba! </p>
        <br>
        <p class="mx-auto max-w-sm text-xl py-2">Resumen del pedido</p>
        <hr class="mx-auto max-w-sm border-black">
        <div class="mx-auto max-w-sm py-2 overflow-y-auto h-16">

            <div class="bg-white border border-black ">
                <div class="grid grid-cols-3">
                    <div class="col-span-1">Producto</div>
                    <div class="col-span-1">. . . . . . . . . .</div>
                    <div class="col-span-1">datos</div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="col-span-1">Producto</div>
                    <div class="col-span-1">. . . . . . . . . .</div>
                    <div class="col-span-1">datos</div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="col-span-1">Producto</div>
                    <div class="col-span-1">. . . . . . . . . .</div>
                    <div class="col-span-1">datos</div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="col-span-1">Producto</div>
                    <div class="col-span-1">. . . . . . . . . .</div>
                    <div class="col-span-1">datos</div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="col-span-1">Producto</div>
                    <div class="col-span-1">. . . . . . . . . .</div>
                    <div class="col-span-1">datos</div>
                </div>
                <div class="grid grid-cols-3">
                    <div class="col-span-1">Producto</div>
                    <div class="col-span-1">. . . . . . . . . .</div>
                    <div class="col-span-1">datos</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-start-3 col-end-7 bg-orange-400 py-10">
        <div class="grid grid-cols-4">
            <div class="p-2 max-h-screen">
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-lg" src="{{asset('images/gato1.jpg')}}" alt="" />
                    <div class="text-center m-1 rounded-md bg-white">Producto 1</div>
                </div>
            </div>
            <div class="p-2">
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-lg" src="{{asset('images/gato1.jpg')}}" alt="" />
                    <div class="text-center m-1 rounded-md bg-white">Producto 2</div>
                </div>
            </div>
            <div class="p-2">
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-lg" src="{{asset('images/gato1.jpg')}}" alt="" />
                    <div class="text-center m-1 rounded-md bg-white">Producto 3</div>
                </div>
            </div>
            <div class="p-2">
                <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-lg" src="{{asset('images/gato1.jpg')}}" alt="" />
                    <div class="text-center m-1 rounded-md bg-white">Producto 4</div>
                </div>
            </div>
        </div>

        <div class="py-3">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full 
         text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
        </div>
    </div>
    
</div>

@endsection
