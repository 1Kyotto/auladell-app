<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products\Product;
use App\Models\Customizations\CustomizationHierarchy;
use App\Models\Materials\Material;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomizationMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $mano_obra = 2780;
        $hora = 5;
        $costo_base = $mano_obra * $hora;

        CustomizationHierarchy::where('id', 82)->update(['additional_cost' => $costo_base]);

        $hora = 5;
    }
}
