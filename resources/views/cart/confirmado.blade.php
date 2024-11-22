@extends('template.master')

@section('content')

<div class="col-span-6 grid grid-cols-8 grid-rows-4 bg-gradient-to-bl from-sec-900 via-sec-700 to-sec-900 h-screen">
	<div class="col-start-3 col-end-7 bg-gradient-to-bl from-white via-slate-400 to-white"></div>
    <div class="col-start-3 col-end-7 bg-gradient-to-bl from-slate-400 via-white to-slate-400">
        <div class="text-3xl text-center">Compra realizada con éxito!</div>
        <hr class="mx-auto max-w-sm border-black">
        <br>
        <br>
        <div class="mx-auto max-w-sm text-2xl text-center">Ya puedes ir de vuelta al menú, disfruta de tu compra! </div>
    </div>
    <div class="col-start-3 col-end-7 bg-gradient-to-bl from-white via-slate-400 to-white">
        <div class="py-2"></div>
        <div class="my-2 text-center">
            <a href="{{route('home.index')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full 
            text-lg w-full sm:w-auto px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Volver al menú</a>
        </div>
    </div>
    <div class="col-start-3 col-end-7 bg-gradient-to-bl from-slate-400 via-white to-slate-400"></div>
</div>


@endsection