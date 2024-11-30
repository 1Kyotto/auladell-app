<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\Products\Product;

class AdminController
{
    public function productManagment()
    {
        $products = Product::all();
        $items = count($products);
        $actives = $products->where('is_active', 1)->count();
        $aros = $products->where('category', 'Aros')->count();
        $anillos = $products->where('category', 'Anillos')->count();
        $brazaletes = $products->where('category', 'Brazaletes')->count();
        $collares = $products->where('category', 'Collares')->count();

        return view('dashboard.product', compact('products', 'items', 'aros', 'anillos', 'brazaletes', 'collares', 'actives'));
    }

    public function orders()
    {
        return view('dashboard.order');
    }

    public function reports()
    {
        return view('dashboard.report');
    }

    public function materials()
    {
        return view('dashboard.material');
    }
}
