<?php

namespace App\Http\Controllers\Products;

use App\Models\Customizations\CustomizationOption;
use App\Models\Materials\CustomizationMaterial;
use Illuminate\Http\Request;
use App\Models\Products\Product;
use App\Models\Materials\Material;

class UserProdController
{
    public function index($type = null)
    {
        $type = strtolower(trim($type));

        // Obtener materiales con el filtro deseado
        $materials = Material::whereBetween('id', [1, 20])->get();
        $selectedMaterial = $materials->whereBetween('id', [1, 9]);
        $selectedGemstone = $materials->whereBetween('id', [11, 20]);

        switch ($type) {
            case 'brazalete':
            case 'bracelet':
            case 'brazaletes':
            case 'bracelets':
                $products = Product::with(['materials', 'customizationMaterials.material'])->where('category', 'Brazaletes')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);

                    // Cálculo del precio con margen e IVA
                    $margin = 0.20;
                    $iva = 0.19;
                    $basePrice = $product->base_price;
                    $finalPrice = round((($basePrice * (1 + $margin)) * (1 + $iva)));
                    $product->formatted_price = number_format($finalPrice, 0);
                    $product->calculated_price = $finalPrice;

                    // Obtener los nombres de los materiales que pueden usarse como incrustaciones
                    $product->gemstones = $product->customizationMaterials->pluck('material.name');

                    return $product;
                });
                return view('user-products.bracelets', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'collar':
            case 'necklace':
            case 'collares':
            case 'necklaces':
                $products = Product::with(['materials', 'customizationMaterials.material'])->where('category', 'Collares')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);

                    // Cálculo del precio con margen e IVA
                    $margin = 0.20;
                    $iva = 0.19;
                    $basePrice = $product->base_price;
                    $finalPrice = round((($basePrice * (1 + $margin)) * (1 + $iva)));
                    $product->formatted_price = number_format($finalPrice, 0);
                    $product->calculated_price = $finalPrice;

                    // Obtener los nombres de los materiales que pueden usarse como incrustaciones
                    $product->gemstones = $product->customizationMaterials->pluck('material.name');

                    return $product;
                });
                return view('user-products.necklaces', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'aro':
            case 'earring':
            case 'aros':
            case 'earrings':
                $products = Product::with(['materials', 'customizationMaterials.material'])->where('category', 'Aros')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);

                    // Cálculo del precio con margen e IVA
                    $margin = 0.20;
                    $iva = 0.19;
                    $basePrice = $product->base_price;
                    $finalPrice = round((($basePrice * (1 + $margin)) * (1 + $iva)));
                    $product->formatted_price = number_format($finalPrice, 0);
                    $product->calculated_price = $finalPrice;

                    // Obtener los nombres de los materiales que pueden usarse como incrustaciones
                    $product->gemstones = $product->customizationMaterials->pluck('material.name');

                    return $product;
                });
                return view('user-products.earrings', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'anillo':
            case 'ring':
            case 'anillos':
            case 'rings':
                $products = Product::with(['materials', 'customizationMaterials.material'])->where('category', 'Anillos')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);

                    // Cálculo del precio con margen e IVA
                    $margin = 0.20;
                    $iva = 0.19;
                    $basePrice = $product->base_price;
                    $finalPrice = round((($basePrice * (1 + $margin)) * (1 + $iva)));
                    $product->formatted_price = number_format($finalPrice, 0);
                    $product->calculated_price = $finalPrice;

                    // Obtener los nombres de los materiales que pueden usarse como incrustaciones
                    $product->gemstones = $product->customizationMaterials->pluck('material.name');

                    return $product;
                });
                return view('user-products.rings', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'todo':
            case 'todos':
            case 'all-products':
                $products = Product::with(['materials', 'customizationMaterials.material'])->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);

                    // Cálculo del precio con margen e IVA
                    $margin = 0.20;
                    $iva = 0.19;
                    $basePrice = $product->base_price;
                    $finalPrice = round((($basePrice * (1 + $margin)) * (1 + $iva)));
                    $product->formatted_price = number_format($finalPrice, 0);
                    $product->calculated_price = $finalPrice;

                    // Obtener los nombres de los materiales que pueden usarse como incrustaciones
                    $product->gemstones = $product->customizationMaterials->pluck('material.name');

                    return $product;
                });
                return view('user-products.index', compact('products', 'selectedMaterial', 'selectedGemstone'));
        }
    }

    public function show($id)
    {
        $margin = 0.20;
        $product = Product::findOrFail($id);

        $totalPrice = ($product->base_price * (1 + $margin)) * 1.19;

        // Material original del producto
        $originalMaterialId = $product->materials->pluck('id')->first();

        // Obtener las opciones de personalización relacionadas con "Cambio de material base"
        $customizationId = 1; // ID de la personalización "Cambio de material base"
        $materialOptions = CustomizationOption::where('customization_id', $customizationId)->get();

        // Obtener los materiales relacionados con cada opción de personalización
        $alternativeMaterials = CustomizationMaterial::whereIn('customization_option_id', $materialOptions->pluck('id'))
            ->where('product_id', $id)
            ->with('material')
            ->get()
            ->map(function ($material) use ($product, $margin, $originalMaterialId) {
                // Si es el material original, no calcular el ajuste
                if ($material->material_id == $originalMaterialId) {
                    $material->final_price = $product->base_price; // Solo el precio base
                    $material->is_default = true;
                } else {
                    // Calcular el precio ajustado
                    $adjustedPrice = $product->base_price + $material->price_adjustment;
                    $material->final_price = $adjustedPrice;
                    $material->is_default = false;
                }
                return $material;
            });
        $defaultMaterial = $alternativeMaterials->firstWhere('is_default', true);

        // Verificar si el producto tiene la personalización "Largo de cadena"
        $customizationId = 2; // ID de la personalización "Largo de cadena"
        $chainOptionsQuery = CustomizationOption::where('customization_id', $customizationId);

        // Filtrar opciones según la categoría del producto
        if ($product->category == 'Brazaletes') {
            $chainOptions = $chainOptionsQuery->take(3)->get(); // Primeras 3 opciones
        } elseif ($product->category == 'Collares') {
            $totalOptions = $chainOptionsQuery->count();
            $chainOptions = $chainOptionsQuery->skip($totalOptions - 3)->take(3)->get(); // Últimas 3 opciones
        } else {
            $chainOptions = collect(); // Sin opciones
        }


        // Verificar si el producto tiene la personalización "Incrustación"
        $customizationId = 3; // ID de la personalización "Incrustación"
        // Obtener opciones con los ajustes de precio
        $inlayOptions = CustomizationOption::where('customization_id', $customizationId)
            ->with(['customizationMaterials' => function ($query) use ($product) {
                $query->where('product_id', $product->id); // Relacionado al producto actual
            }])
            ->get();


        // Verificar si el producto tiene la personalización "Talla del anillo"
        $customizationId = 4; // ID de la personalización "Talla del anillo"
        $sizeOptions = CustomizationOption::where('customization_id', $customizationId)
            ->with(['customizationMaterials' => function ($query) use ($product) {
                $query->where('product_id', $product->id); // Relacionado al producto actual
            }])
            ->get();

        $customizationId = 5; // ID de la personalización "Bañado en material"
        $platedOptions = CustomizationOption::where('customization_id', $customizationId)
            ->with(['customizationMaterials' => function ($query) use ($product) {
                $query->where('product_id', $product->id); // Relacionado al producto actual
            }])
            ->get();

        return view('user-products.show', compact(
            'product',
            'materialOptions',
            'alternativeMaterials',
            'chainOptions',
            'inlayOptions',
            'sizeOptions',
            'platedOptions',
            'totalPrice',
            'defaultMaterial'
        ));
    }

    public function customization(){
        return view('user-products.personalization');
    }
}
