<?php

namespace App\Http\Controllers\Products;

use App\Models\Customizations\CustomizationOption;
use App\Models\Materials\CustomizationMaterial;
use Illuminate\Http\Request;
use App\Models\Products\Product;
use App\Models\Materials\Material;

class UserProdController
{
    private function getProductsForCategory($category = null)
    {
        $query = Product::with(['materials', 'customizationMaterials.material'])
            ->where('is_active', true);
        
        if ($category && $category !== 'todos' && $category !== 'todo' && $category !== 'all-products') {
            $categoryMap = [
                'brazalete' => 'Brazaletes',
                'bracelet' => 'Brazaletes',
                'brazaletes' => 'Brazaletes',
                'bracelets' => 'Brazaletes',
                'collar' => 'Collares',
                'necklace' => 'Collares',
                'collares' => 'Collares',
                'necklaces' => 'Collares',
                'aro' => 'Aros',
                'earring' => 'Aros',
                'aros' => 'Aros',
                'earrings' => 'Aros',
                'anillo' => 'Anillos',
                'ring' => 'Anillos',
                'anillos' => 'Anillos',
                'rings' => 'Anillos'
            ];
            
            $mappedCategory = $categoryMap[strtolower($category)] ?? 'Aros';
            $query->where('category', $mappedCategory);
        }

        return $query->get()->map(function ($product) {
            $product->image_url = asset('storage/' . $product->image);
            $product->formatted_price = number_format($product->final_price, 0, ',', '.');
            $product->raw_price_formatted = number_format($product->raw_price, 0, ',', '.');
            $product->calculated_price = $product->final_price;
            $product->gemstones = $product->customizationMaterials->pluck('material.name');
            return $product;
        });
    }

    public function index($type = null)
    {
        // Obtener materiales con el filtro deseado
        $materials = Material::whereBetween('id', [1, 20])->get();
        $selectedMaterial = $materials->whereBetween('id', [1, 9]);
        $selectedGemstone = $materials->whereBetween('id', [11, 20]);

        $products = $this->getProductsForCategory($type);
        
        $categories = [
            'Todos' => 'all-products',
            'Brazaletes' => 'Brazaletes',
            'Collares' => 'Collares',
            'Aros' => 'Aros',
            'Anillos' => 'Anillos'
        ];

        // Determinar la categoría actual
        $currentCategory = $type ?? 'all-products';

        // Siempre usar la vista index
        return view('user-products.index', compact('products', 'selectedMaterial', 'selectedGemstone', 'categories', 'currentCategory'));
    }

    public function show($id)
    {
        // Obtener el producto con sus relaciones
        $product = Product::with([
            'materials',
            'customizations.customizationOptions' => function($query) use ($id) {
                $query->whereHas('customizationMaterials', function($q) use ($id) {
                    $q->where('product_id', $id);
                });
            },
            'customizationMaterials.material',
        ])->findOrFail($id);

        // Obtener el material base del producto (primer material)
        $baseMaterial = $product->materials->first();

        // Obtener las personalizaciones disponibles para el producto
        $customizations = $product->customizations->map(function ($customization) use ($product, $baseMaterial) {
            // Decodificar las categorías permitidas
            $categories = json_decode($customization->category);
            
            if (in_array('all', $categories) || in_array($product->category, $categories)) {
                $options = $customization->customizationOptions->map(function ($option) use ($product, $customization, $baseMaterial) {
                    $customizationMaterial = $product->customizationMaterials
                        ->where('customization_option_id', $option->id)
                        ->first();

                    // Determinar si esta opción es la predeterminada
                    $isDefault = false;
                    
                    // Lista de personalizaciones que siempre deben tener primera opción por defecto
                    $defaultFirstOptionTypes = [
                        'Talla de anillo',
                        'Largo de cadena'
                    ];

                    // Caso 1: Material Base
                    if ($customization->name === 'Material Base' && $customizationMaterial?->material_id === $baseMaterial?->id) {
                        $isDefault = true;
                    }
                    // Caso 2: Opciones "Sin"
                    elseif (
                        $option->option_name === 'Sin ' . $customization->name ||
                        ($customization->name === 'Incrustación' && $option->option_name === 'Sin Incrustación') ||
                        ($customization->name === 'Bañado' && $option->option_name === 'Sin Bañado')
                    ) {
                        $isDefault = true;
                    }
                    // Caso 3: Personalizaciones que siempre deben tener primera opción por defecto
                    elseif (
                        in_array($customization->name, $defaultFirstOptionTypes) &&
                        $option === $customization->customizationOptions->first()
                    ) {
                        $isDefault = true;
                    }

                    return [
                        'id' => $option->id,
                        'name' => $option->option_name,
                        'material_id' => $customizationMaterial ? $customizationMaterial->material_id : null,
                        'quantity_needed' => $customizationMaterial ? $customizationMaterial->quantity_needed : 0,
                        'price_adjustment' => $customizationMaterial ? $customizationMaterial->price_adjustment : 0,
                        'is_default' => $isDefault
                    ];
                });

                return [
                    'id' => $customization->id,
                    'name' => $customization->name,
                    'options' => $options
                ];
            }
            return null;
        })->filter();

        // Formatear precios
        $product->formatted_price = number_format($product->final_price, 0, ',', '.');
        $product->raw_price_formatted = number_format($product->raw_price, 0, ',', '.');

        return view('user-products.show', compact('product', 'customizations'));
    }

    public function filterProducts(Request $request)
    {
        $query = Product::with(['materials', 'customizationMaterials.material']);

        // Aplicar filtro de categoría
        if ($request->has('category') && $request->category !== 'all-products') {
            $query->where('category', $request->category);
        }

        // Aplicar filtros de material
        if ($request->has('materials') && !empty($request->materials)) {
            $query->whereHas('materials', function ($q) use ($request) {
                $q->whereIn('materials.id', $request->materials);
            });
        }

        // Aplicar filtros de incrustaciones
        if ($request->has('gemstones') && !empty($request->gemstones)) {
            $query->whereHas('customizationMaterials', function ($q) use ($request) {
                $q->whereIn('material_id', $request->gemstones);
            });
        }

        // Obtener productos
        $products = $query->get();

        // Mapear los productos para incluir las URLs y precios formateados
        $products = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image_url' => $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg'),
                'raw_price' => $product->raw_price,
                'final_price' => $product->final_price,
                'category' => $product->category,
                'gemstones' => $product->customizationMaterials->pluck('material.name')
            ];
        });

        return response()->json(['products' => $products]);
    }

    public function customization(){
        return view('user-products.personalization');
    }
}
