@extends('template.master')

@section('content')
<div class="col-span-6 text-center py-5 border-y border-black bg-cyan-200 text-3xl"> Contactanos! </div>
<div class="col-span-6 grid grid-cols-2 bg-teal-600">
    <div class="col-span-1 grid grid-rows-2 bg-red-400">
        <div class="row-span-1 px-10">
            <p class="text-2xl pb-7 pt-8">Ingrese sus datos y comentario para contactar!</p>
            <div class="grid grid-cols-2 gap-6 mb-6 pt-4">
                <div class="py-2">
                    <label for="first_name" class="block mb-2 text-md font-medium text-black">Nombre</label>
                    <input type="text" id="first_name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Juan" required />
                </div>
                <div class="py-2">
                    <label for="last_name" class="block mb-2 text-md font-medium text-black">Apellido(s)</label>
                    <input type="text" id="last_name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Perez" required />
                </div>
                <div class="py-2">
                    <label for="company" class="block mb-2 text-md font-medium text-black">Ciudad</label>
                    <input type="text" id="company" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Viña del Mar" required />
                </div>  
                <div class="py-2">
                    <label for="phone" class="block mb-2 text-md font-medium text-black">Numero de telefono</label>
                    <input type="tel" id="phone" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400
                     dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+56 9 1234 5678" required />
                </div>
                <div class="col-span-2">
                    <label for="email" class="block mb-2 text-md font-medium text-black">Correo electrónico</label>
                    <input type="email" id="email" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="usuario1@gmail.com" required />
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
                    <button type="button" class="px-5 py-3 text-md font-medium text-white inline-flex items-center bg-blue-700 
                    hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 
                    dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-4 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                        </svg>
                        Enviar
                    </button>
                </div>
                <span class="text-2xl justify-center">
                    La información y comentarios enviados por el usuario pasaran a verificación por parte de la 
                    administracion de la página para aceptar o denegar su solicitud, muchas gracias de antemano!
                </span>
            </div>
        </div>
    </div>
    <div class="col-span-1 grid grid-rows-4">
        <div class=" row-span-1 grid justify-center items-center">
            <div class="text-xl pt-5">Informacion para contactar a la pagina...</div>
            <div class="text-sm">Numero: +56901234567</div>
            <div class="text-md">Zona: Los Pinos - Quilpué</div>
        </div>
        <div class=" row-span-3 pb-20 pt-2 px-5">
            <div class=" bg-white border border-black dark:bg-gray-800 rounded h-full">
                <img class="rounded h-full w-full" src="{{asset('images/thomas-y-percy.jpg')}}" alt="" />
            </div>
        </div>
    </div>


    {{--
    <div class="grid grid-cols-1">
        <div class="col-span-1"></div>
        <div class="col-span-1"></div>
        <div class="col-span-1">
            <h2 class="text-3xl">
                <br>Lorem ipsum sample text
            </h2>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-3 text-center">
        <p class="col-span-3">parrafo 1 de datos</p>
        <p class="col-span-3">parrafo 2 de datos</p>
        <p class="col-span-3">parrafo 3 de datos</p>
        <p class="col-span-3">parrafo para links</p>
    </div>
    
    
    <div class="grid grid-cols-3">
        <div class="col-span-1"></div>
        <div class="col-span-1">
            <form class="max-w-sm mx-auto">
                <div class="mb-2">
                    <input type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tu nombre">
                </div>
                <div class="mb-2">
                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tu email" required />
                </div>
                <div class="mb-2">
                    <input type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Telefono (opcional)" />
                </div>
                <div class="mb-2 flex items-start">
                    <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Dejanos un mensaje"></textarea>
                </div>
                <div class="mb-2">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
                    text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar</button>
                </div>
                
            </form>
        </div>
        <div class="col-span-1"></div>
    </div>
    --}}

</div>
@endsection