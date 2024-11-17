@extends('template.master')

@section('content')
@foreach ($products as $product)
    <div>{{ $product->name }}</div>
@endforeach

<div class="">
    {{ $products->links() }}
</div>
    
@endsection