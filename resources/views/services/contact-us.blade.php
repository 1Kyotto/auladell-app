@extends('template.master')

@section('content')
<div class="col-span-6 text-center py-5 border-y border-black bg-sec-700 text-3xl text-white"> Contactanos! </div>
<div class="col-span-6 grid grid-cols-2 bg-gradient-to-bl from-slate-400 via-white to-slate-400">
    <div class="col-span-1 grid grid-rows-2 bg-transparent">
        <div class="row-span-1 px-10">
            <p class="text-2xl pb-7 pt-8">Ingrese sus datos y comentario para contactar!</p>
            <div class="grid grid-cols-2 gap-6 mb-6 pt-4">
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
                    <label for="company" class="block mb-2 text-md font-medium text-black">Ciudad</label>
                    <input type="text" id="company" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Viña del Mar" required />
                </div>  
                <div class="py-2">
                    <label for="phone" class="block mb-2 text-md font-medium text-black">Numero de telefono</label>
                    <input type="tel" id="phone" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+56 9 1234 5678" required />
                </div>
                <div class="col-span-2">
                    <label for="email" class="block mb-2 text-md font-medium text-black">Correo electrónico</label>
                    <input type="email" id="email" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="usuario1@gmail.com" required />
                </div> 
            </div>
        </div>
        <div class="row-span-1 px-10 pb-5">
            <div class="grid grid-rows-2">
                <div class="row-span-1 pb-5">
                    {{--Cuadro de texto para descripcion--}}
                    <label for="message" class="block mb-2 text-md font-medium text-black">Comentanos tus ideas!</label>
                    <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-black bg-gray-50 rounded-lg 
                    border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:white dark:border-gray-600 
                    dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>
                </div>
                <div class="row-span-1">
                    {{--Parte donde iran botones--}}
                    <a href="{{route('services.contact-us')}}" type="button" class="px-5 py-3 text-md font-medium text-white inline-flex items-center bg-blue-700 
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
                <span class="text-xl justify-center">
                    La información y comentarios enviados por el usuario pasaran a verificación por parte de la 
                    administracion de la página para aceptar o denegar su solicitud, muchas gracias de antemano!
                </span>
            </div>
        </div>
    </div>
    <div class="col-span-1 grid grid-rows-4">
        <div class=" row-span-1 grid justify-center items-center">
            <div class="text-center text-xl pt-5">Informacion para contactar la pagina...</div>
            <div class="text-center text-sm">Numero: +569XXXXXXXX</div>
            <div class="text-center text-xl">Los Pinos - QUILPUÉ</div>
        </div>
        <div class="row-span-3 pb-20 pt-2 pr-5">
            <div class=" bg-white border border-black rounded h-full">
                {{--<img class="rounded h-full w-full" src="{{asset('images/thomas-y-percy.jpg')}}" alt="" />--}}
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d18913.531056769534!2d-71.42455903500422!3d-33.07037765402203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2scl!4v1732314787336!5m2!1ses-419!2scl"
                 class="rounded" width="910" height="560" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>


</div>
@endsection