@extends('template.master')

@section('content')

<div class="grid grid-cols-5">
    <div class="col-span-3 col-start-2 grid grid-cols-1 h-screen bg-slate-400 text-black">
        <div class="text-center col-span-1 flex justify-center items-end mb-6">
            <span class="text-2xl">Rellenar datos para revisar el pedido y ver su posible producción.</span>
        </div>
        <div class="text-center col-span-1 row-span-2">
            <hr class=" border-black pt-4">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div class="py-2">
                    <label for="first_name" class="block mb-2 text-md font-medium text-black">Nombre</label>
                    <input type="text" id="first_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Juan" required />
                </div>
                <div class="py-2">
                    <label for="last_name" class="block mb-2 text-md font-medium text-black">Apellido(s)</label>
                    <input type="text" id="last_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Perez" required />
                </div>
                <div class="py-2">
                    <label for="company" class="block mb-2 text-md font-medium text-black">Correo electrónico</label>
                    <input type="email" id="company" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="usuario1@gmail.com" required />
                </div>  
                <div class="py-2">
                    <label for="phone" class="block mb-2 text-md font-medium text-black">Numero de telefono</label>
                    <input type="tel" id="phone" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+56 9 1234 5678" required />
                </div>
                <div class="col-span-2">
                    <label for="message" class="block mb-2 text-md font-medium text-black">Escribe tu personalización que deseas para tener la idea exacta de tu producto.</label>
                    <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-black bg-gray-50 rounded-lg 
                    border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:white dark:border-gray-600 
                    dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>
                </div> 
            </div>
            <div class="">
                <a href="{{route('user-products.personalization')}}" type="submit" class="px-5 py-3 text-md font-medium text-white inline-flex items-center bg-blue-700 
                hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 
                dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-4 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                </svg>
                Enviar
                </a>
                <a href="{{route('home.index')}}" type="button" class=" px-5 py-3 text-md font-medium text-white inline-flex items-center bg-green-700 
                hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-green-300 rounded-lg text-center dark:bg-green-600 
                dark:hover:bg-green-700 dark:focus:ring-green-800">
                <svg class="w-5 h-4 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 15 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                    Volver al Menú
                </a>
            </div>
            
        </div>
    </div>
</div>


@endsection