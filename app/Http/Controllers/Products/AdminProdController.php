<?php

namespace App\Http\Controllers\Products;

use App\Models\Customizations\Customization;
use App\Models\Customizations\CustomizationOption;
use App\Models\Materials\CustomizationMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Materials\Material;
use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminProdController
{
    public function index()
    {
        $allProducts = Product::all();
        $products = Product::orderBy('created_at', 'desc')->paginate(7);
        
        $items = $allProducts->count();
        $actives = $allProducts->where('is_active', 1)->count();
        $aros = $allProducts->where('category', 'Aros')->count();
        $anillos = $allProducts->where('category', 'Anillos')->count();
        $collares = $allProducts->where('category', 'Collares')->count();
        $brazaletes = $allProducts->where('category', 'Brazaletes')->count();

        // Obtener todas las personalizaciones y materiales para el modal
        $customizations = Customization::all();
        $materials = Material::all();

        return view('dashboard.product', compact(
            'products', 'items', 'actives', 'aros', 'anillos', 
            'collares', 'brazaletes', 'customizations', 'materials'
        ));
    }

    public function getCustomizations($productId)
    {
        try {
            Log::info('Buscando personalizaciones para el producto: ' . $productId);
            
            $customizations = DB::table('customization_product as cp')
                ->join('customizations as c', 'cp.customization_id', '=', 'c.id')
                ->join('customization_option as co', 'c.id', '=', 'co.customization_id')
                ->join('customization_material as cm', function($join) use ($productId) {
                    $join->on('cm.product_id', '=', DB::raw($productId))
                         ->on('cm.customization_option_id', '=', 'co.id');
                })
                ->leftJoin('materials as m', 'cm.material_id', '=', 'm.id')
                ->where('cp.product_id', $productId)
                ->select(
                    'cm.id',
                    'c.name as customization_name',
                    'co.option_name',
                    'm.name as material_name',
                    'cm.quantity_needed',
                    'cm.price_adjustment'
                )
                ->get();

            Log::info('Personalizaciones encontradas: ' . $customizations->count());
            
            return response()->json([
                'success' => true,
                'data' => $customizations->toArray()
            ]);

        } catch (\Exception $e) {
            Log::error('Error al obtener personalizaciones: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener las personalizaciones',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeStep1(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validar los datos recibidos del formulario
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'category' => 'required|in:Aros,Anillos,Brazaletes,Collares',
                'image' => 'required|image|max:2048', // Máximo 2MB
                'labor_hours' => 'required|numeric|min:0',
                'labor_cost_per_hour' => 'required|numeric|min:0',
                'raw_price' => 'required|numeric|min:0',
                'price_with_margin' => 'required|numeric|min:0',
                'final_price' => 'required|numeric|min:0',
                'materials' => 'required|array|min:1',
                'materials.*' => 'required|exists:materials,id',
                'quantities' => 'required|array|min:1',
                'quantities.*' => 'required|numeric|min:0',
                'base_material' => 'required|exists:materials,id',
            ],[
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser un texto.',
                'mame.max' => 'El nombre no puede tener más de :max caracteres.',
    
                'category.required' => 'La categoria es obligatoria.',
                'category.in' => 'Debe escogerse una categoria válida.',
    
                'image.required' => 'La imagen es obligatoria.',
                'image.image' => 'El archivo debe ser de tipo imagen: jpg, png, etc.',
                'image.max' => 'El tamaño de la imagen no puede pesar mas de :max megabytes.',

                'labor_hours.required' => 'Las horas de trabajo son obligatorias.',
                'labor_hours.numeric' => 'Las horas de trabajo deben ser un valor numérico.',
                'labor_hours.min' => 'Las horas de trabajo no pueden tener valor 0 o que no tenga algún valor.',

                'labor_cost_per_hour.required' => 'El costo por hora de trabajo es obligatorio.',
                'labor_cost_per_hour.string' => 'El costo por hora de trabajo debe ser un valor numérico.',
                'labor_cost_per_hour.min' => 'El costo por hora de trabajo no puede tener valor 0 o que no tenga algún valor.',
                
                //El precio base, con margen y final son automatizados, por ende las validaciones solo se dirigen a las horas de trabajo

                'materials.required' => 'Debe seleccionar al menos un material.',
                'materials.array' => 'La selección de materiales debe ser un arreglo.',
                'materials.min' => 'Debe seleccionar al menos :min material(es).',

                'materials.*.required' => 'El material seleccionado es obligatorio.',
                'materials.*.exists' => 'El material seleccionado no existe en la base de datos.',

                'quantities.required' => 'Debe especificar al menos una cantidad.',
                'quantities.array' => 'Las cantidades deben ser enviadas como un arreglo.',
                'quantities.min' => 'Debe especificar al menos :min cantidad(es).',

                'quantities.*.required' => 'La cantidad es obligatoria.',
                'quantities.*.numeric' => 'Cada cantidad debe ser un valor numérico.',
                'quantities.*.min' => 'Cada cantidad debe ser un valor mayor a 0.',

                'base_material.required' => 'El nombre es obligatorio.',
                'base_material.exists' => 'El material base debe existir en la lista.',
            ]);

            // Procesar y guardar la imagen
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
            } else {
                throw new \Exception('No se ha proporcionado una imagen válida.');
            }

            // Crear el nuevo producto con los datos validados
            $product = Product::create([
                'name' => $validated['name'],
                'raw_price' => $validated['raw_price'],
                'final_price' => $validated['final_price'],
                'labor_hours' => $validated['labor_hours'],
                'labor_cost_per_hour' => $validated['labor_cost_per_hour'],
                'category' => $validated['category'],
                'is_active' => true,
                'image' => $imagePath,
            ]);

            // Asociar los materiales con sus cantidades en material_product
            $baseMaterialQuantity = 1;
            foreach ($validated['materials'] as $index => $materialId) {
                if (isset($validated['quantities'][$index])) {
                    $product->materials()->attach($materialId, [
                        'quantity_needed' => $validated['quantities'][$index],
                    ]);

                    if ($materialId == $validated['base_material']) {
                        $baseMaterialQuantity = $validated['quantities'][$index];
                    }
                }
            }

            DB::table('customization_material')->insert([
                'customization_option_id' => 1,
                'material_id' => $validated['base_material'],
                'product_id' => $product->id,
                'quantity_needed' => $baseMaterialQuantity,
                'price_adjustment' => 0,
                'is_base' => true
            ]);

            DB::commit();
            return redirect()->route('admin.product')->with('success', 'Producto creado exitosamente');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el producto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validar los datos recibidos
            $validated = $request->validate([
                'product_id' => 'required|exists:products,id',
                'customization_id' => 'required|exists:customizations,id',
                'customization_options' => 'required|array',
                'customization_options.*' => 'exists:customization_option,id',
                'materials' => 'array',
                'materials.*' => 'array',
                'materials.*.*' => 'exists:materials,id',
                'quantities' => 'array',
                'quantities.*' => 'array',
                'quantities.*.*' => 'numeric|min:0'
            ]);

            // Obtener el producto y su material base
            $product = Product::findOrFail($validated['product_id']);
            $baseMaterial = $product->materials()->first();

            if (!$baseMaterial) {
                throw new \Exception("El producto no tiene un material base definido");
            }

            // Obtener las opciones con su atributo requires_material
            $options = CustomizationOption::whereIn('id', $validated['customization_options'])
                ->select('id', 'requires_material')
                ->get()
                ->keyBy('id');

            Log::debug('Options retrieved:', $options->toArray());

            // Verificar si ya existe la relación producto-personalización
            $existingRelation = DB::table('customization_product')
                ->where('product_id', $validated['product_id'])
                ->where('customization_id', $validated['customization_id'])
                ->first();

            if (!$existingRelation) {
                DB::table('customization_product')->insert([
                    'product_id' => $validated['product_id'],
                    'customization_id' => $validated['customization_id']
                ]);
            }

            // Guardar los materiales originales antes de eliminarlos
            $originalMaterials = DB::table('customization_material')
                ->join('materials', 'materials.id', '=', 'customization_material.material_id')
                ->whereIn('customization_option_id', $validated['customization_options'])
                ->where('product_id', $validated['product_id'])
                ->get()
                ->keyBy('customization_option_id');

            // Procesar cada opción seleccionada
            foreach ($validated['customization_options'] as $optionId) {
                // Eliminar registros existentes para esta opción
                DB::table('customization_material')
                    ->where('product_id', $validated['product_id'])
                    ->where('customization_option_id', $optionId)
                    ->delete();

                $option = $options[$optionId];

                // Si la opción no requiere materiales, crear un registro con valores en 0
                if (!$option->requires_material) {
                    DB::table('customization_material')->insert([
                        'customization_option_id' => $optionId,
                        'material_id' => $baseMaterial->id,
                        'product_id' => $validated['product_id'],
                        'quantity_needed' => 0,
                        'price_adjustment' => 0
                    ]);
                    continue;
                }

                // Para opciones que requieren materiales, verificar y procesar los materiales
                if (!isset($validated['materials'][$optionId]) || !isset($validated['quantities'][$optionId])) {
                    throw new \Exception("No se encontraron materiales para la opción {$optionId} que los requiere");
                }

                $optionMaterials = $validated['materials'][$optionId];
                $optionQuantities = $validated['quantities'][$optionId];

                // Procesar cada material para esta opción
                foreach ($optionMaterials as $index => $materialId) {
                    $quantity = $optionQuantities[$index];
                    $material = Material::find($materialId);

                    if (!$material) continue;

                    $baseCost = $baseMaterial->price_per_unit * $quantity;
                    $newCost = $material->price_per_unit * $quantity;
                    
                    // Si existía un material original para esta opción, usar su costo
                    if (isset($originalMaterials[$optionId])) {
                        $originalMaterial = $originalMaterials[$optionId];
                        $baseCost = $originalMaterial->price_per_unit * $quantity;
                    }

                    $priceAdjustment = $newCost - $baseCost;

                    // Crear el registro en customization_material
                    DB::table('customization_material')->insert([
                        'customization_option_id' => $optionId,
                        'material_id' => $materialId,
                        'product_id' => $validated['product_id'],
                        'quantity_needed' => $quantity,
                        'price_adjustment' => $priceAdjustment
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.product')->with('success', 'Personalizaciones guardadas exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product')->with('error', 'Error al guardar las personalizaciones', $e->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $product->load('materials');
        // Asegurarse de que la URL de la imagen sea relativa al storage
        $product->image = str_replace('storage/', '', $product->image);
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
    
            // Validar los datos recibidos del formulario
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'category' => 'required|in:Aros,Anillos,Brazaletes,Collares',
                'image' => 'nullable|image|max:2048', // Opcional para actualización
                'labor_hours' => 'required|numeric|min:0',
                'labor_cost_per_hour' => 'required|numeric|min:0',
                'raw_price' => 'required|numeric|min:0',
                'price_with_margin' => 'required|numeric|min:0',
                'final_price' => 'required|numeric|min:0',
                'materials' => 'required|array|min:1',
                'materials.*' => 'required|exists:materials,id',
                'quantities' => 'required|array|min:1',
                'quantities.*' => 'required|numeric|min:0',
                'base_material' => 'required|exists:materials,id',
            ],[
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser un texto.',
                'mame.max' => 'El nombre no puede tener más de :max caracteres.',
    
                'category.required' => 'La categoria es obligatoria.',
                'category.in' => 'Debe escogerse una categoria válida.',
    
                'image.nullable' => 'La imagen es opcional (solo es un aviso).',
                'image.image' => 'El archivo debe ser de tipo imagen: jpg, png, etc.',
                'image.max' => 'El tamaño de la imagen no puede pesar mas de :max megabytes.',

                'labor_hours.required' => 'Las horas de trabajo son obligatorias.',
                'labor_hours.numeric' => 'Las horas de trabajo deben ser un valor numérico.',
                'labor_hours.min' => 'Las horas de trabajo no pueden tener valor 0 o que no tenga algún valor.',

                'labor_cost_per_hour.required' => 'El costo por hora de trabajo es obligatorio.',
                'labor_cost_per_hour.string' => 'El costo por hora de trabajo debe ser un valor numérico.',
                'labor_cost_per_hour.min' => 'El costo por hora de trabajo no puede tener valor 0 o que no tenga algún valor.',
                
                //El precio base, con margen y final son automatizados, por ende las validaciones solo se dirigen a las horas de trabajo

                'materials.required' => 'Debe seleccionar al menos un material.',
                'materials.array' => 'La selección de materiales debe ser un arreglo.',
                'materials.min' => 'Debe seleccionar al menos :min material(es).',

                'materials.*.required' => 'El material seleccionado es obligatorio.',
                'materials.*.exists' => 'El material seleccionado no existe en la base de datos.',

                'quantities.required' => 'Debe especificar al menos una cantidad.',
                'quantities.array' => 'Las cantidades deben ser enviadas como un arreglo.',
                'quantities.min' => 'Debe especificar al menos :min cantidad(es).',

                'quantities.*.required' => 'La cantidad es obligatoria.',
                'quantities.*.numeric' => 'Cada cantidad debe ser un valor numérico.',
                'quantities.*.min' => 'Cada cantidad debe ser un valor mayor a 0.',

                'base_material.required' => 'El nombre es obligatorio.',
                'base_material.exists' => 'El material base debe existir en la lista.',
            ]);
    
            // Actualizar la imagen si se proporciona una nueva
            if ($request->hasFile('image')) {
                // Eliminar la imagen anterior
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $imagePath = $request->file('image')->store('products', 'public');
            }
    
            // Actualizar el producto con los datos validados
            $product->update([
                'name' => $validated['name'],
                'raw_price' => $validated['raw_price'],
                'final_price' => $validated['final_price'],
                'labor_hours' => $validated['labor_hours'],
                'labor_cost_per_hour' => $validated['labor_cost_per_hour'],
                'category' => $validated['category'],
                'image' => $request->hasFile('image') ? $imagePath : $product->image,
            ]);
    
            // Eliminar las relaciones existentes
            $product->materials()->detach();
            DB::table('customization_material')
                ->where('product_id', $product->id)
                ->where('customization_option_id', 1)
                ->delete();
    
            // Asociar los nuevos materiales con sus cantidades
            $baseMaterialQuantity = 1;
            foreach ($validated['materials'] as $index => $materialId) {
                if (isset($validated['quantities'][$index])) {
                    $product->materials()->attach($materialId, [
                        'quantity_needed' => $validated['quantities'][$index],
                    ]);
    
                    if ($materialId == $validated['base_material']) {
                        $baseMaterialQuantity = $validated['quantities'][$index];
                    }
                }
            }
    
            // Insertar nuevo material base en customization_material
            DB::table('customization_material')->insert([
                'customization_option_id' => 1,
                'material_id' => $validated['base_material'],
                'product_id' => $product->id,
                'quantity_needed' => $baseMaterialQuantity,
                'price_adjustment' => 0,
                'is_base' => true
            ]);
    
            DB::commit();
            return redirect()->route('admin.product')->with('success', 'Producto actualizado exitosamente');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el producto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCustomizationOptions($customizationId)
    {
        try {
            $options = DB::table('customization_option')
                ->where('customization_id', $customizationId)
                ->select('id', 'option_name', 'requires_material')
                ->get();

            return response()->json([
                'success' => true,
                'options' => $options
            ]);

        } catch (\Exception $e) {
            Log::error('Error al obtener opciones de personalización: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las opciones de personalización'
            ], 500);
        }
    }

    public function deleteCustomization($id)
    {
        try {
            // Obtener la personalización que se va a eliminar
            $customizationMaterial = DB::table('customization_material as cm')
                ->join('customization_option as co', 'cm.customization_option_id', '=', 'co.id')
                ->join('customizations as c', 'co.customization_id', '=', 'c.id')
                ->where('cm.id', $id)
                ->select('cm.*', 'co.customization_id', 'c.name as customization_name', 
                        'c.requires_option')
                ->first();
            
            if (!$customizationMaterial) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró la personalización'
                ], 404);
            }

            // Verificar si es el material base original del producto
            if ($customizationMaterial->is_base) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar el material base original del producto'
                ], 400);
            }

            if ($customizationMaterial->requires_option) {
                // Contar cuántas opciones quedan para este tipo de personalización en este producto
                $remainingOptions = DB::table('customization_material as cm')
                    ->join('customization_option as co', 'cm.customization_option_id', '=', 'co.id')
                    ->where('cm.product_id', $customizationMaterial->product_id)
                    ->where('co.customization_id', $customizationMaterial->customization_id)
                    ->count();
                
                if ($remainingOptions <= 1) {
                    return response()->json([
                        'success' => false,
                        'message' => "El producto debe tener al menos una opción de {$customizationMaterial->customization_name}"
                    ], 400);
                }
            }

            DB::table('customization_material')->where('id', $id)->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Personalización eliminada correctamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar personalización: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'error' => 'Error al eliminar la personalización',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Product $product)
    {
        try {
            Log::info('Intentando cambiar estado del producto', [
                'product_id' => $product->id,
                'old_status' => $product->is_active,
                'new_status' => !$product->is_active
            ]);

            $product->is_active = !$product->is_active;
            $product->save();

            Log::info('Estado del producto actualizado exitosamente', [
                'product_id' => $product->id,
                'is_active' => $product->is_active
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado exitosamente',
                'is_active' => $product->is_active,
                'text' => $product->is_active ? 'Activo' : 'Inactivo',
                'classes' => $product->is_active 
                    ? 'bg-[#E0EFEC] text-[#006C55] hover:bg-[#006C55] hover:text-white'
                    : 'bg-[#FFEAE5] text-[#56170D] hover:bg-[#F8B7AA]'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al actualizar estado del producto', [
                'product_id' => $product->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado'
            ], 500);
        }
    }
}
