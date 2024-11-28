@extends('template.dashboard')

@section('contenido')
<div class="col-span-10 h-[100vh] flex items-center justify-center">
	{{--Container--}}
	<div class="w-[95%] h-[95%] border border-gray-200 rounded-lg flex flex-col items-center">
		<div class="w-[95%] h-[10%] flex items-center justify-between">
			<div class=""></div>
			<a href="{{ route('product.create') }}" class="rounded-full py-2 px-4 bg-color-aux hover:bg-color-secondary text-aux">Nuevo Producto</a>
		</div>

		{{--FILTROS--}}
		<div class="w-[95%] h-[10%] flex items-center justify-start">
			<div class="border bg-gray-200 rounded-lg">
				<a href="{{ route('admin.product') }}" class="hover:bg-white hover:rounded-xl px-5 py-1">Todo</a>
				<a href="{{ route('admin.product', ['category' => 'Aros']) }}" class="hover:bg-white hover:rounded-xl px-5 py-1">Aros</a>
				<a href="{{ route('admin.product', ['category' => 'Anillos']) }}" class="hover:bg-white hover:rounded-xl px-5 py-1">Anillos</a>
				<a href="{{ route('admin.product', ['category' => 'Brazaletes']) }}" class="hover:bg-white hover:rounded-xl px-5 py-1">Brazaletes</a>
				<a href="{{ route('admin.product', ['category' => 'Collares']) }}" class="hover:bg-white hover:rounded-xl px-5 py-1">Collares</a>
			</div>
		</div>
		{{--FILTROS--}}

		{{--LISTADO DE PRODUCTOS--}}
		<div class="w-[95%] h-[78%] flex flex-wrap justify-between overflow-hidden overflow-y-scroll">
			@foreach ($products as $product)
				{{--PRODUCTO--}}
				<div class="w-[30%] h-[80%] border border-gray-200 rounded-xl mb-8 flex flex-col items-center">
					<div class="w-[90%] h-[20%] flex">
						<div class="flex justify-end items-center w-full">
							{{--FORMULARIO TOGGLE SWITCH--}}
							<form action="{{ route('product.toggleStatus', $product->id) }}" method="POST">
								@csrf
								@method('PATCH') {{-- Usamos PATCH para indicar una actualización parcial --}}
								<label class="inline-flex items-center cursor-pointer">
									<input type="checkbox" class="sr-only peer" onchange="this.form.submit()" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} />
									<div class="relative w-9 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 dark:peer-focus:ring-0 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-5 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
								</label>
							</form>
							{{--FORMULARIO TOGGLE SWITCH--}}
						</div>
					</div>
					<img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-[90%] border h-[50%] mb-4">
					<div class="w-[90%] h-[35%] flex flex-col items-start justify-between mb-3">
						<h6>{{ $product->name }}</h6>
						<span>${{ number_format($product->base_price, 0) }}</span>
						<p>{{ $product->category }}</p>
					</div>
					<div class="flex items-center justify-around w-full pb-4">
						{{--BOTÓN EDITAR--}}
						<a href="{{ route('product.edit', $product->id) }}" class="border-2 max-w-64 min-w-32 rounded-lg py-1 px-2 bg-yellow-600 text-aux">Editar</a>
						{{--BOTÓN EDITAR--}}

						{{--FORMULARIO BORRAR--}}
						<form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
							@csrf
							@method('DELETE')
							<button type="submit" class="border-2 max-w-64 min-w-32 rounded-lg py-1 px-2 bg-red-600 text-aux">Borrar</button>
						</form>
						{{--FORMULARIO BORRAR--}}
					</div>
				</div>
				{{--PRODUCTO--}}
			@endforeach
		</div>
		{{--LISTADO DE PRODUCTOS--}}
	</div>
	{{--Container--}}
</div>
@endsection