<?php

namespace App\Http\Controllers\Products;

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
        $selectedMaterial = $materials->whereBetween('id', [1, 10]);
        $selectedGemstone = $materials->whereBetween('id', [11, 20]);

        switch ($type) {
            case 'brazalete':
            case 'bracelet':
            case 'brazaletes':
            case 'bracelets':
                $products = Product::with('materials')->where('category', 'Brazaletes')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);
                    return $product;
                });
                return view('user-products.bracelets', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'collar':
            case 'necklace':
            case 'collares':
            case 'necklaces':
                $products = Product::with('materials')->where('category', 'Collares')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);
                    return $product;
                });
                return view('user-products.necklaces', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'aro':
            case 'earring':
            case 'aros':
            case 'earrings':
                $products = Product::with('materials')->where('category', 'Aros')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);
                    return $product;
                });
                return view('user-products.earrings', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'anillo':
            case 'ring':
            case 'anillos':
            case 'rings':
                $products = Product::with('materials')->where('category', 'Anillos')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);
                    return $product;
                });
                return view('user-products.rings', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'todo':
            case 'todos':
            case 'all-products':
                $products = Product::with('materials')->get()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);
                    return $product;
                });
                return view('user-products.index', compact('products', 'selectedMaterial', 'selectedGemstone'));
        }
    }

    public function show($id)
    {
        $product = Product::with('materials', 'customizations', 'customizationMaterials')->findOrFail($id);
        return view('user-products.show', compact('product'));
    }

    public function customization(){
        return view('user-products.personalization');
    }
}
