<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\Products\Product;

class AdminController
{
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
