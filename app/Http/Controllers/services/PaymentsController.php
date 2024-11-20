<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;

class PaymentsController
{
    public function index() 
    {
        return view('services.payment_summary');
    }
}
