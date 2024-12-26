<?php

namespace App\Http\Controllers;

use App\Models\Products\Product;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->get()
            ->groupBy('category')
            ->map(function ($group) {
                return $group->random();
            });
        return view('home.index', ['products' => $products]);
    }
}
