<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;

class UserProdController
{
    public function index($type = null)
    {
        $type = strtolower(trim($type));

        switch ($type) {
            case 'brazalete':
            case 'brazaletes':
                return view('categories.bracelets');
            case 'collar':
            case 'collares':
                return view('categories.necklaces');
            case 'aro':
            case 'aros':
                return view('categories.earrings');
            case 'anillo':
            case 'anillos':
                return view('categories.rings');
            default:
                return view('categories.index');
        }
    }

    public function show($id) {}
}
