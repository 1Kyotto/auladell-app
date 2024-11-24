@extends('template.master')

@section('content')

<div class="col-span-6 grid grid-cols-5 grid-rows-1 h-auto bg-transparent">
    <div class="col-span-3 grid grid-cols-5 grid-rows-3 bg-gradient-to-bl from-slate-400 via-white to-slate-400">
        <div class="col-span-5 row-span-3">

            <div class="p-5">
				<div class="flex-col items-center h-auto bg-white border border-gray-200 shadow 
                md:flex-row rounded-xl dark:border-gray-700 dark:bg-gray-400 w-full text-black">
				 	<div class="pt-5 grid grid-cols-3">
                        <div class="col-span-1 flex justify-end items-center">
                            <img src="{{asset('images/logo.png')}}" class="" width="120">
                        </div>
						<div class="col-span-2 flex justify-center items-center">
                            <img src="{{asset('images/tarjeta-credito-debito.png')}}" class="" width="350">
                        </div>
                        {{--<div class="grid-span-1 flex justify-center items-center"></div>--}}
					</div>
                    <div class="py-2 text-center">
                        <hr class="border-black">
                    </div>

                    <div class="grid grid-cols-6 my-5 gap-y-5">
                        <label for="card_name" class="flex justify-center items-center text-md font-medium col-span-3">Número de tarjeta</label>
                        <input type="text" id="first_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-48 p-2.5 dark:border-gray-600 dark:placeholder-gray-500 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500 justify-center items-center col-span-3" placeholder=" 1234 - 5678 - 2468 - 1357" required />
                        
                        <label for="cvv" class="flex justify-center items-center text-md font-medium col-span-3">CVV</label>
                        <input type="number" id="first_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-auto mr-64 p-2.5 dark:border-gray-600 dark:placeholder-gray-500 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500 col-span-3" min="0" placeholder="      123     " required />
                        
                        <label for="exp_date" class="flex justify-center items-center text-md font-medium col-span-3">Fecha Vencimiento</label>
                        <select id="month" name="month" class=" w-32 px-8 py-2 text-black border border-gray-600 rounded-lg 
                        focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 col-span-1">
                            <option value="" disabled selected>MM</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <span class="flex justify-center items-center font-bold text-3xl col-span-1 w-auto">/</span>
                        <select id="year" name="year" class="w-32 px-7 mr-24 py-2 text-black border border-gray-600 rounded-lg 
                        focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 col-span-1">
                            <option value="" disabled selected>YYYY</option>
                            @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>

                        <label for="card_psswd" class="flex justify-center items-center text-md font-medium col-span-3">Contraseña</label>
                        <input type="password" id="last_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-48 mr-52 p-2.5 dark:border-gray-600 dark:placeholder-gray-500 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500 col-span-3" required />
                    </div>
                    
                    
				</div>
			</div>

        </div>
    </div>

    <div class="col-span-2 grid grid-cols-1 grid-rows-3 bg-gradient-to-bl from-white via-slate-400 to-white">
        <div class="col-span-1 col-start-1 row-span-3">

            <div class="p-5">
				<div class="flex-col items-center h-auto bg-white border border-gray-200 shadow 
                md:flex-row rounded-xl dark:border-gray-700 dark:bg-gray-400 w-full text-black">
				 	<div class="pt-5">
						<div class="grid-span-2 flex justify-center items-center">
                            <img src="{{asset('images/joyas-varias.jpg')}}" class="rounded border-black border-y-2">
                        </div>
					</div>
                    <div class="py-2 text-center font-semibold">
                        Datos de la orden (aqui deben ir solo labels):
                    </div>
                    <hr class="border-black">
                    <div class="grid grid-cols-3 my-5 gap-y-5">
                        <label for="card_name" class="flex justify-center items-center text-md font-medium col-span-2">Cliente</label>
                        <input type="text" id="first_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-40 p-2.5 dark:border-gray-600 dark:placeholder-gray-500 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500 justify-center items-center col-span-1" placeholder=" Juan perez " required />
                        
                        <label for="cvv" class="flex justify-center items-center text-md font-medium col-span-2">Número de orden</label>
                        <input type="number" id="first_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-40 mr-64 p-2.5 dark:border-gray-600 dark:placeholder-gray-500 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500 col-span-1" placeholder=" 12345    " required />
                        
                        <label for="exp_date" class="flex justify-center items-center text-md font-medium col-span-2">Cantidad de productos</label>
                        <input type="number" id="first_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-40 mr-64 p-2.5 dark:border-gray-600 dark:placeholder-gray-500 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500 col-span-1" min="0" placeholder=" 5    " required />
                        
                        <label for="card_name" class="flex justify-center items-center text-md font-medium col-span-2">Subtotal</label>
                        <input type="text" id="first_name" class="bg-white border border-gray-300 text-black text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-40 p-2.5 dark:border-gray-600 dark:placeholder-gray-500 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500 justify-center items-center col-span-1" min="0" placeholder=" $120.000 " required />
                    </div>
                    
                    <div class="grid grid-cols-3">
                        <span class="col-span-2 text-center">Total a pagar = $142.000,00 (con IVA)</span>
                        <a href="{{route('cart.confirmado')}}" class="col-span-1 font-medium flex items-center justify-center text-md rounded-lg text-center w-40 py-1 mb-2 text-white bg-blue-700 hover:bg-blue-800 
                            focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Comprar
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-white pl-1" viewBox="0 0 24 24" width="24" height="24" fill="none">
                                <path d="M22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12Z" stroke="currentColor" stroke-width="1.5" />
                                <path d="M8 12.5L10.5 15L16 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
				</div>
			</div>

        </div>
    </div>
</div>

@endsection