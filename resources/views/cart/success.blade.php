@extends('template.master')

@section('content')
<div class="w-full h-[70dvh] flex flex-col items-center justify-center font-montserrat">
    <div class="flex flex-col items-center justify-center gap-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-accents-900" viewBox="0 0 24 24" fill="none">
            <path d="M3.87289 17.0194L2.66933 9.83981C2.48735 8.75428 2.39637 8.21152 2.68773 7.85576C2.9791 7.5 3.51461 7.5 4.58564 7.5H19.4144C20.4854 7.5 21.0209 7.5 21.3123 7.85576C21.6036 8.21152 21.5126 8.75428 21.3307 9.83981L20.1271 17.0194C19.7282 19.3991 19.5287 20.5889 18.7143 21.2945C17.9 22 16.726 22 14.3782 22H9.62182C7.27396 22 6.10003 22 5.28565 21.2945C4.47127 20.5889 4.27181 19.3991 3.87289 17.0194Z" stroke="currentColor" stroke-width="1.5" />
            <path d="M17.5 7.5C17.5 4.46243 15.0376 2 12 2C8.96243 2 6.5 4.46243 6.5 7.5" stroke="currentColor" stroke-width="1.5" />
        </svg>
        <p class="text-3xl font-cinzel font-bold">ORDEN DE COMPRA</p>
        <a href="/jewelry/all-products" class="uppercase flex justify-center font-bold bg-[#008769] w-full rounded-md py-2 text-cwhite-500">seguir comprando</a>
    </div>
</div>
@endsection