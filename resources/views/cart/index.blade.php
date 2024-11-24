@extends('template.master')

@section('content')
@if($products->isEmpty())
    <div class="w-full h-[70dvh] flex flex-col items-center justify-center font-montserrat">
        <div class="flex flex-col items-center justify-center gap-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-accents-900" viewBox="0 0 24 24" fill="none">
                <path d="M3.87289 17.0194L2.66933 9.83981C2.48735 8.75428 2.39637 8.21152 2.68773 7.85576C2.9791 7.5 3.51461 7.5 4.58564 7.5H19.4144C20.4854 7.5 21.0209 7.5 21.3123 7.85576C21.6036 8.21152 21.5126 8.75428 21.3307 9.83981L20.1271 17.0194C19.7282 19.3991 19.5287 20.5889 18.7143 21.2945C17.9 22 16.726 22 14.3782 22H9.62182C7.27396 22 6.10003 22 5.28565 21.2945C4.47127 20.5889 4.27181 19.3991 3.87289 17.0194Z" stroke="currentColor" stroke-width="1.5" />
                <path d="M17.5 7.5C17.5 4.46243 15.0376 2 12 2C8.96243 2 6.5 4.46243 6.5 7.5" stroke="currentColor" stroke-width="1.5" />
            </svg>
            <p class="text-3xl font-cinzel font-bold">Tu bolsa de compras está vacía</p>
            <a href="/jewelry/all-products" class="uppercase flex justify-center font-bold bg-[#008769] w-full rounded-md py-2 text-cwhite-500">seguir comprando</a>
        </div>
    </div>
@else
    <div class="w-full px-28 flex justify-between font-montserrat">
    <div class="w-[55%] mt-20 flex flex-col">
        <div class="flex items-center justify-between border-b-2 border-black">
            <h3 class="text-2xl font-cinzel font-bold">Carrito ({{ $items }})</h3>
            <div class="text-sm font-semibold px-16">Nombre</div>
            <div class="text-sm font-semibold px-16">Precio</div>
        </div>
        @foreach ($products as $product)
            {{--PROD--}}
            <div class="w-full mt-6 pb-3 flex justify-between">
                {{--IMAGEN DEL PROD--}}
                <img src="{{ asset('storage/' . $product->product->image) }}" class="h-32 w-32 object-cover" alt="{{ $product->name }}">
                {{--IMAGEN DEL PROD--}}

                {{--NOMBRE DEL PROD--}}
                <div class="text-sm px-14 flex flex-col gap-3">
                    <p>{{ $product->product->name }}</p>
                </div>
                {{--NOMBRE DEL PROD--}}

                {{--PRECIO DEL PROD UNITARIAMENTE--}}
                <span class="text-sm flex gap-4 font-bold px-14">CL$ {{ number_format($product->price, 0) }}</span>
                {{--PRECIO DEL PROD UNITARIAMENTE--}}

            </div>
            {{--ELIMINAR UN PRODUCTO--}}
            <form id="removeFromCartForm" method="POST" action="{{ route('cart.remove') }}" class=" pb-3 flex items-start justify-end border-b border-[#CED4E0] mb-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->product_id }}"> {{-- Agrega este campo --}}
                <button type="submit" id="removeFromCartButton">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-black h-5 w-5" viewBox="0 0 24 24" fill="none">
                        <path d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </button>
            </form>
            {{--ELIMINAR UN PRODUCTO--}}
            {{--PROD--}}
        @endforeach
    </div>
    <div class="w-[35%] min-h-[70dvh] mt-16 pt-4 flex flex-col h-full sticky top-0 z-50">
        <div class="border-b-2 border-black">
            <h3 class="text-2xl font-cinzel font-bold">Resumen del Pedido</h3>
        </div>
        <div class="w-full">
            <div class="w-full flex items-center justify-between mt-8 text-sm">
                <span>Subtotal:</span>
                <span>$$$$$$$$</span>
            </div>
            <div class="w-full flex items-center justify-between mt-3 text-sm">
                <span>Envío:</span>
                <span>$$$$$$$$</span>
            </div>
            <div class="w-full flex items-center justify-between mt-4 border-t border-[#CED4E0] mb-6">
                <span class="pt-3 font-bold">TOTAL:</span>
                <span class="pt-3 font-bold">$$$$$$$$</span>
            </div>
        </div>
        <form action="" class="">
            <button type="submit" id="" class="w-full bg-[#008769] font-montserrat rounded-lg py-2 font-bold text-cwhite-500 flex items-center justify-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cwhite-500" viewBox="0 0 24 24" fill="none">
                    <path d="M12 16V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M5 15C5 11.134 8.13401 8 12 8C15.866 8 19 11.134 19 15C19 18.866 15.866 22 12 22C8.13401 22 5 18.866 5 15Z" stroke="currentColor" stroke-width="1.5" />
                    <path d="M16.5 9.5V6.5C16.5 4.01472 14.4853 2 12 2C9.51472 2 7.5 4.01472 7.5 6.5V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                IR AL PAGO
            </button>
        </form>
    </div>
    </div>
@endif
@endsection