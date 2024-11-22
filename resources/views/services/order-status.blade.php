@extends('template.master')

@section('content')
<div class="col-span-6 grid grid-cols-8 grid-rows-1 h-screen bg-gradient-to-bl from-sec-900 via-sec-700 to-sec-900">
    <div class="col-start-3 col-end-7 bg-slate-100 shadow-right-only">
        <div class="text-3xl pt-10 text-center">Formulario estado de la orden</div>
        <hr class="mx-auto max-w-sm border-black">
        <br>
        <div class="mx-auto max-w-sm pb-12 text-center">Puedes colocar tus datos para ver el estado de tu pedido! </div>
        <div class="py-4 max-w-sm mx-auto">
            <input type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Telefono (opcional)" />
        </div>
        <div class="py-1 max-w-sm mx-auto">
            <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tu email" required />
        </div>
        <div class="pt-6 pb-8 text-center">
            <a type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full 
            text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ver estado del pedido</a>
        </div>
        <div class="mx-auto max-w-sm pb-12 text-center">Sigue los pasos de tu pedido para saber en que parte del proceso se encuentra!</div>
    </div>
    
</div>
@endsection