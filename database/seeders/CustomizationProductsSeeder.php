<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products\Product;
use App\Models\Customizations\Customization;
use Illuminate\Support\Facades\DB;
use App\Models\Customizations\CustomizationHierarchy;

class CustomizationProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customization_product')->insert([
            'product_id' => 1,
            'customization_id' => 1,
        ]);
        DB::table('customization_product')->insert([
            'product_id' => 2,
            'customization_id' => 1,
        ]);
        DB::table('customization_product')->insert([
            'product_id' => 3,
            'customization_id' => 1,
        ]);
        DB::table('customization_product')->insert([
            'product_id' => 4,
            'customization_id' => 1,
        ]);
        DB::table('customization_product')->insert([
            'product_id' => 5,
            'customization_id' => 1,
        ]);
        DB::table('customization_product')->insert([
            'product_id' => 6,
            'customization_id' => 1,
        ]);
        DB::table('customization_product')->insert([
            'product_id' => 7,
            'customization_id' => 1,
        ]);
        DB::table('customization_product')->insert([
            'product_id' => 8,
            'customization_id' => 1,
        ]);
    }
}
