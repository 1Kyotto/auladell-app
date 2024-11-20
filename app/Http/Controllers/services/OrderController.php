<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;

class OrderController
{
    public function orderStatus()
    {
        return view('services.order-status');
    }
}
