<?php

namespace App\Http\Controllers;

use App\Models\Products\Product;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $products = Product::all()->groupBy('category')->map(function ($group) {
            return $group->random();
        });
        return view('home.index', ['products' => $products]);
    }
}
