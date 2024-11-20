<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;

class ServicesController
{
    public function contactUs()
    {
        return view('services.contact-us');
    }
}
