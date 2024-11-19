<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Products\Product;
use App\Models\Customizations\CustomizationHierarchy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class CustomizationProductTest extends TestCase
{
    use RefreshDatabase;

    public function productHasCustomizations() {}
}
