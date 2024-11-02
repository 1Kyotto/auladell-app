@extends('template.master')

@section('content')
<div class="flex flex-col bg-red-800 w-full px-4 font-montserrat md:px-20 xl:px-28">
    <div class="w-full my-8">
        <h5 class="border-b-[1px] border-black pb-1 font-cinzel">Tu carrito</h5>
        <div class="w-full pt-3 flex">
            <div class="w-[40%] flex items-start gap-2">
                <input type="checkbox" id="product">
                <div class="w-full">
                    <img src="" alt="" class="w-[15dvh] h-[15dvh] object-cover">
                </div>
            </div>
            <div class="w-[60%] flex flex-col">
                <p class="w-full font-cinzel">Nombre Prod</p>
                <div class="w-full flex justify-between">
                    <div class="flex bg-[#C5E0DB] rounded-lg border-[1px] border-[#008769] w-20 justify-between px-3 font-bold">
                        <button>-</button>
                        <span>1</span>
                        <button>+</button>
                    </div>
                    <div class="font-bold">$$$</div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">
        <h5 class="border-b-[1px] border-black pb-1 font-cinzel">Resumen de la compra</h5>
    </div>
</div>
@endsection