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
        $materials = Material::whereBetween('id', [1, 3])->orWhereIn('id', [5, 7])->orWhereBetween('id', [11, 20])->get();
        $selectedMaterial = $materials->whereIn('id', [1, 2, 3, 5, 7]);;
        $selectedGemstone = $materials->whereBetween('id', [11, 20]);

        switch ($type) {
            case 'brazalete':
            case 'bracelet':
            case 'brazaletes':
            case 'bracelets':
                $products = Product::where('category', 'Brazaletes');
                return view('user-products.bracelets', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'collar':
            case 'necklace':
            case 'collares':
            case 'necklaces':
                $products = Product::where('category', 'Collares');
                return view('user-products.necklaces', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'aro':
            case 'earring':
            case 'aros':
            case 'earrings':
                $products = Product::where('category', 'Aros');
                return view('user-products.earrings', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'anillo':
            case 'ring':
            case 'anillos':
            case 'rings':
                $products = Product::where('category', 'Anillos');
                return view('user-products.rings', compact('products', 'selectedMaterial', 'selectedGemstone'));
            case 'todo':
            case 'todos':
            case 'all-products':
                $products = Product::all()->map(function ($product) {
                    // Crear una propiedad 'image_url' con la URL completa de la imagen
                    $product->image_url = asset('storage/' . $product->image);  // Usar 'asset()' para obtener la URL completa
                    return $product;
                });
                return view('user-products.index', compact('products', 'selectedMaterial', 'selectedGemstone'));
        }
    }

    public function show($id) {}
}
