<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Materials\Material;
use App\Models\Products\Product;

class AdminProdController
{
    public function create()
    {
        $materials = Material::all();
        return view('products.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.max' => 'El nombre del producto no puede tener más de 100 caracteres.',
            'description.required' => 'La descripción del producto es obligatoria.',
            'category.required' => 'La categoría del producto es obligatoria.',
            'category.in' => 'La categoría seleccionada no es válida.',
            'hours_worked.required' => 'Las horas de trabajo son obligatorias.',
            'hours_worked.numeric' => 'Las horas de trabajo deben ser un valor numérico.',
            'hours_worked.min' => 'Las horas de trabajo deben ser al menos 0.',
            'hourly_rate.required' => 'La tarifa por hora es obligatoria.',
            'hourly_rate.numeric' => 'La tarifa por hora debe ser un valor numérico.',
            'hourly_rate.min' => 'La tarifa por hora debe ser al menos 0.',
            'product_image.image' => 'El archivo debe ser una imagen.',
            'product_image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
            'product_image.max' => 'La imagen no debe superar los 2MB.',
            'materials.required' => 'Debes seleccionar al menos un material.',
            'materials.array' => 'Los materiales deben ser un array válido.',
            'materials.*.quantity.required' => 'La cantidad de cada material es obligatoria.',
            'materials.*.quantity.numeric' => 'La cantidad de cada material debe ser un número.',
            'materials.*.quantity.min' => 'La cantidad de cada material debe ser al menos 1.',
        ];

        // Validaciones
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'category' => 'required|string|in:Aros,Anillos,Brazaletes,Collares',
            'is_active' => 'sometimes|boolean',
            'hours_worked' => 'required|numeric|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'materials' => 'required|array',
            'materials.*.quantity' => 'required|numeric|min:1'
        ], $messages);

        // Procesamiento de costos
        $hours_worked = $request->input('hours_worked');
        $hourly_rate = $request->input('hourly_rate');
        $cost_base = $hours_worked * $hourly_rate;

        $materials = $request->input('materials');
        $cost_materials = 0;

        if (!empty($materials)) {
            foreach ($materials as $material_id => $material_data) {
                $material = Material::find($material_id);
                $quantity = $material_data['quantity'] ?? 0;

                $cost_materials += $material->price_per_unit * $quantity;
            }
        }

        $base_price = $cost_base + $cost_materials;

        // Verificar y almacenar la imagen si se ha subido
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
        } else {
            $imagePath = 'products/No-Image-Placeholder.png';
        }

        // Crear el producto
        Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'base_price' => $base_price,
            'category' => $validatedData['category'],
            'is_active' => $request->has('is_active') ? $request->input('is_active') : true,
            'image' => $imagePath  // Se guarda la ruta de la imagen
        ]);

        return redirect()->route('admin.product')->with('success', 'El producto creado correctamente.');
    }

    public function show($id) {}

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $materials = Material::all();

        return view('products.edit', compact('id', 'product', 'materials'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.max' => 'El nombre del producto no puede tener más de 100 caracteres.',
            'description.required' => 'La descripción del producto es obligatoria.',
            'category.required' => 'La categoría del producto es obligatoria.',
            'category.in' => 'La categoría seleccionada no es válida.',
            'hours_worked.required' => 'Las horas de trabajo son obligatorias.',
            'hours_worked.numeric' => 'Las horas de trabajo deben ser un valor numérico.',
            'hours_worked.min' => 'Las horas de trabajo deben ser al menos 0.',
            'hourly_rate.required' => 'La tarifa por hora es obligatoria.',
            'hourly_rate.numeric' => 'La tarifa por hora debe ser un valor numérico.',
            'hourly_rate.min' => 'La tarifa por hora debe ser al menos 0.',
            'product_image.image' => 'El archivo debe ser una imagen.',
            'product_image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
            'product_image.max' => 'La imagen no debe superar los 2MB.',
            'materials.required' => 'Debes seleccionar al menos un material.',
            'materials.array' => 'Los materiales deben ser un array válido.',
            'materials.*.quantity.required' => 'La cantidad de cada material es obligatoria.',
            'materials.*.quantity.numeric' => 'La cantidad de cada material debe ser un número.',
            'materials.*.quantity.min' => 'La cantidad de cada material debe ser al menos 1.',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'category' => 'required|string|in:Aros,Anillos,Brazaletes,Collares',
            'is_active' => 'sometimes|boolean',
            'hours_worked' => 'required|numeric|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'materials' => 'required|array',
            'materials.*.quantity' => 'required|numeric|min:1',
        ], $messages);

        // Cálculo del costo base por horas trabajadas y tarifa
        $hours_worked = $request->input('hours_worked');
        $hourly_rate = $request->input('hourly_rate');
        $cost_base = $hours_worked * $hourly_rate;

        // Cálculo del costo de los materiales
        $materials = $request->input('materials');
        $cost_materials = 0;

        if (!empty($materials)) {
            foreach ($materials as $material_id => $material_data) {
                $material = Material::find($material_id);
                $quantity = $material_data['quantity'] ?? 0;

                $cost_materials += $material->price_per_unit * $quantity;
            }
        }

        $base_price = $cost_base + $cost_materials;

        // Actualizar el producto
        $product = Product::findOrFail($id);

        // Manejo de la imagen
        if ($request->hasFile('product_image')) {
            // Eliminar la imagen anterior si no es la predeterminada
            if ($product->image !== 'products/No-Image-Placeholder.png') {
                Storage::disk('public')->delete($product->image);
            }

            // Guardar la nueva imagen
            $imagePath = $request->file('product_image')->store('products', 'public');
        } else {
            // Mantener la imagen actual si no se sube una nueva
            $imagePath = $product->image;
        }

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'base_price' => $base_price,
            'category' => $validatedData['category'],
            'is_active' => $request->has('is_active') ? $request->input('is_active') : true,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.product')->with('success', 'El producto se ha modificado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'El producto se ha eliminado correctamente.');
    }

    public function toggleStatus(Request $request, $id)
    {
        // Buscar el producto por su ID
        $product = Product::findOrFail($id);

        // Actualizar el estado 'is_active' basado en si el checkbox está marcado o no
        $product->is_active = $request->has('is_active');
        $product->save();

        // Redirigir de nuevo a la página de productos o donde prefieras
        return redirect()->route('admin.product')->with('success', 'El estado del producto ha sido actualizado.');
    }
}
