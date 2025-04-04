<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products\Product;
use App\Models\Customizations\CustomizationHierarchy;
use App\Models\Materials\CustomizationMaterial;
use App\Models\Materials\Material;
use App\Models\Materials\MaterialProduct;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CustomizationMaterialSeeder extends Seeder
{
    public function run(): void
    {
        //Obtener todos los materiales para evitar consultas repetitivas
        $materials = Material::all()->keyBy('id');

        $customizationMaterialData = [
            // Cambio de material - Material ID 2
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 1, 'quantity_needed' => 15, 'is_base' => true],
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 2, 'quantity_needed' => 7, 'is_base' => true],
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 3, 'quantity_needed' => 8, 'is_base' => true],
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 4, 'quantity_needed' => 12, 'is_base' => true],
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 5, 'quantity_needed' => 15, 'is_base' => true],
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 6, 'quantity_needed' => 30, 'is_base' => true],
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 7, 'quantity_needed' => 15, 'is_base' => true],
            ['customization_option_id' => 1, 'material_id' => 2, 'product_id' => 8, 'quantity_needed' => 30, 'is_base' => true],

            // Cambio de material - Material ID 5
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 1, 'quantity_needed' => 15],
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 2, 'quantity_needed' => 7],
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 3, 'quantity_needed' => 8],
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 4, 'quantity_needed' => 12],
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 5, 'quantity_needed' => 15],
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 6, 'quantity_needed' => 30],
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 7, 'quantity_needed' => 15],
            ['customization_option_id' => 2, 'material_id' => 5, 'product_id' => 8, 'quantity_needed' => 30],

            // Cambio de material - Material ID 7
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 1, 'quantity_needed' => 15],
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 2, 'quantity_needed' => 7],
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 3, 'quantity_needed' => 8],
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 4, 'quantity_needed' => 12],
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 5, 'quantity_needed' => 15],
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 6, 'quantity_needed' => 30],
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 7, 'quantity_needed' => 15],
            ['customization_option_id' => 3, 'material_id' => 7, 'product_id' => 8, 'quantity_needed' => 30],

            // Cambio de material - Material ID 9
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 1, 'quantity_needed' => 15],
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 2, 'quantity_needed' => 7],
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 3, 'quantity_needed' => 8],
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 4, 'quantity_needed' => 12],
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 5, 'quantity_needed' => 15],
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 6, 'quantity_needed' => 30],
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 7, 'quantity_needed' => 15],
            ['customization_option_id' => 4, 'material_id' => 9, 'product_id' => 8, 'quantity_needed' => 30],

            // Cambio de longitud de cadena
            ['customization_option_id' => 5, 'material_id' => null, 'product_id' => 5, 'quantity_needed' => 0],
            ['customization_option_id' => 5, 'material_id' => null, 'product_id' => 6, 'quantity_needed' => 0],
            ['customization_option_id' => 6, 'material_id' => null, 'product_id' => 5, 'quantity_needed' => 0],
            ['customization_option_id' => 6, 'material_id' => null, 'product_id' => 6, 'quantity_needed' => 0],
            ['customization_option_id' => 7, 'material_id' => null, 'product_id' => 5, 'quantity_needed' => 0],
            ['customization_option_id' => 7, 'material_id' => null, 'product_id' => 6, 'quantity_needed' => 0],
            ['customization_option_id' => 8, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0],
            ['customization_option_id' => 8, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0],
            ['customization_option_id' => 9, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0],
            ['customization_option_id' => 9, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0],
            ['customization_option_id' => 10, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0],
            ['customization_option_id' => 10, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0],
            ['customization_option_id' => 11, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0],
            ['customization_option_id' => 11, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0],
            ['customization_option_id' => 12, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0],
            ['customization_option_id' => 12, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0],
            ['customization_option_id' => 13, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0],
            ['customization_option_id' => 13, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0],
            ['customization_option_id' => 14, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0],
            ['customization_option_id' => 14, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0],

            // Sin Incrustación (asumiendo que el ID es 11)
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 1, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 2, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 5, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 6, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 15, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0, 'price_adjustment' => 0],

            // Incrustación - Material ID 12
            ['customization_option_id' => 16, 'material_id' => 11, 'product_id' => 1, 'quantity_needed' => 0.08],
            ['customization_option_id' => 16, 'material_id' => 11, 'product_id' => 3, 'quantity_needed' => 0.08],
            ['customization_option_id' => 16, 'material_id' => 11, 'product_id' => 5, 'quantity_needed' => 0.08],
            ['customization_option_id' => 16, 'material_id' => 11, 'product_id' => 7, 'quantity_needed' => 0.08],

            // Incrustación - Material ID 13
            ['customization_option_id' => 17, 'material_id' => 12, 'product_id' => 1, 'quantity_needed' => 0.08],
            ['customization_option_id' => 17, 'material_id' => 12, 'product_id' => 3, 'quantity_needed' => 0.08],
            ['customization_option_id' => 17, 'material_id' => 12, 'product_id' => 5, 'quantity_needed' => 0.08],
            ['customization_option_id' => 17, 'material_id' => 12, 'product_id' => 7, 'quantity_needed' => 0.08],

            // Cambio de material - Material ID 14
            ['customization_option_id' => 18, 'material_id' => 13, 'product_id' => 1, 'quantity_needed' => 0.08],
            ['customization_option_id' => 18, 'material_id' => 13, 'product_id' => 3, 'quantity_needed' => 0.08],
            ['customization_option_id' => 18, 'material_id' => 13, 'product_id' => 5, 'quantity_needed' => 0.08],
            ['customization_option_id' => 18, 'material_id' => 13, 'product_id' => 7, 'quantity_needed' => 0.08],

            // Cambio de material - Material ID 15
            ['customization_option_id' => 19, 'material_id' => 14, 'product_id' => 1, 'quantity_needed' => 1],
            ['customization_option_id' => 19, 'material_id' => 14, 'product_id' => 3, 'quantity_needed' => 1],
            ['customization_option_id' => 19, 'material_id' => 14, 'product_id' => 5, 'quantity_needed' => 1],
            ['customization_option_id' => 19, 'material_id' => 14, 'product_id' => 7, 'quantity_needed' => 1],

            // Cambio de material - Material ID 16
            ['customization_option_id' => 20, 'material_id' => 15, 'product_id' => 1, 'quantity_needed' => 0.08],
            ['customization_option_id' => 20, 'material_id' => 15, 'product_id' => 3, 'quantity_needed' => 0.08],
            ['customization_option_id' => 20, 'material_id' => 15, 'product_id' => 5, 'quantity_needed' => 0.08],
            ['customization_option_id' => 20, 'material_id' => 15, 'product_id' => 7, 'quantity_needed' => 0.08],

            // Cambio de material - Material ID 17
            ['customization_option_id' => 21, 'material_id' => 16, 'product_id' => 1, 'quantity_needed' => 1],
            ['customization_option_id' => 21, 'material_id' => 16, 'product_id' => 3, 'quantity_needed' => 1],
            ['customization_option_id' => 21, 'material_id' => 16, 'product_id' => 5, 'quantity_needed' => 1],
            ['customization_option_id' => 21, 'material_id' => 16, 'product_id' => 7, 'quantity_needed' => 1],

            // Cambio de material - Material ID 18
            ['customization_option_id' => 22, 'material_id' => 17, 'product_id' => 1, 'quantity_needed' => 1],
            ['customization_option_id' => 22, 'material_id' => 17, 'product_id' => 3, 'quantity_needed' => 1],
            ['customization_option_id' => 22, 'material_id' => 17, 'product_id' => 5, 'quantity_needed' => 1],
            ['customization_option_id' => 22, 'material_id' => 17, 'product_id' => 7, 'quantity_needed' => 1],

            // Cambio de talla de anillo
            ['customization_option_id' => 23, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 23, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 24, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 24, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 25, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 25, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 26, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 26, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 27, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 27, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 28, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 28, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 29, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 29, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 30, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 30, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 31, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 31, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 32, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 32, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 33, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 33, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 34, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 34, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 35, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 35, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 36, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 36, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 37, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 37, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 38, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 38, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 39, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 39, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 40, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 40, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 41, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 41, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 42, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 42, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 43, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 43, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 44, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 44, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 45, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 45, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 46, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 46, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 47, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 47, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 48, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 48, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 49, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 49, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],
            ['customization_option_id' => 50, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0],
            ['customization_option_id' => 50, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0],

            // Sin Bañado (asumiendo que el ID es 47)
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 1, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 2, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 3, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 4, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 5, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 6, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 7, 'quantity_needed' => 0, 'price_adjustment' => 0],
            ['customization_option_id' => 51, 'material_id' => null, 'product_id' => 8, 'quantity_needed' => 0, 'price_adjustment' => 0],

            // Bañado en material - ORO
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 1, 'quantity_needed' => 0.3],
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 2, 'quantity_needed' => 0.3],
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 3, 'quantity_needed' => 0.65],
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 4, 'quantity_needed' => 0.65],
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 5, 'quantity_needed' => 1.25],
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 6, 'quantity_needed' => 1.25],
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 7, 'quantity_needed' => 2.63],
            ['customization_option_id' => 52, 'material_id' => 1, 'product_id' => 8, 'quantity_needed' => 2.63],

            // Bañado en material - PLATINO
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 1, 'quantity_needed' => 0.85],
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 2, 'quantity_needed' => 0.85],
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 3, 'quantity_needed' => 1],
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 4, 'quantity_needed' => 1],
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 5, 'quantity_needed' => 3.25],
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 6, 'quantity_needed' => 3.25],
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 7, 'quantity_needed' => 3.25],
            ['customization_option_id' => 53, 'material_id' => 3, 'product_id' => 8, 'quantity_needed' => 3.25],

            // Bañado en material - RODIO
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 1, 'quantity_needed' => 0.24],
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 2, 'quantity_needed' => 0.24],
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 3, 'quantity_needed' => 0.29],
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 4, 'quantity_needed' => 0.29],
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 5, 'quantity_needed' => 0.55],
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 6, 'quantity_needed' => 0.55],
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 7, 'quantity_needed' => 1],
            ['customization_option_id' => 54, 'material_id' => 4, 'product_id' => 8, 'quantity_needed' => 1],

            // Bañado en material - TITANIO
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 1, 'quantity_needed' => 0.3],
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 2, 'quantity_needed' => 0.3],
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 3, 'quantity_needed' => 0.3],
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 4, 'quantity_needed' => 0.3],
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 5, 'quantity_needed' => 0.93],
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 6, 'quantity_needed' => 0.93],
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 7, 'quantity_needed' => 1.63],
            ['customization_option_id' => 55, 'material_id' => 6, 'product_id' => 8, 'quantity_needed' => 1.63],

            // Bañado en material - PALADIO
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 1, 'quantity_needed' => 0.55],
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 2, 'quantity_needed' => 0.55],
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 3, 'quantity_needed' => 0.7],
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 4, 'quantity_needed' => 0.7],
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 5, 'quantity_needed' => 1.63],
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 6, 'quantity_needed' => 1.63],
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 7, 'quantity_needed' => 1.63],
            ['customization_option_id' => 56, 'material_id' => 8, 'product_id' => 8, 'quantity_needed' => 1.63],
        ];

        foreach ($customizationMaterialData as $data) {
            if ($data['material_id']) {
                // Obtener el producto y su material base (primer material)
                $product = Product::find($data['product_id']);
                $originalMaterial = $product->materials->first();

                // Calcular el costo del material original
                $originalCost = $originalMaterial->price_per_unit * $data['quantity_needed'];
                
                // Calcular el costo del nuevo material usando la colección precargada
                $newCost = $materials[$data['material_id']]->price_per_unit * $data['quantity_needed'];
                
                // La diferencia es el ajuste de precio
                $price_adjustment = $newCost - $originalCost;
            } else {
                // Para opciones sin material (como "Sin X"), usar el price_adjustment proporcionado o 0
                $price_adjustment = $data['price_adjustment'] ?? 0;
            }
            
            CustomizationMaterial::create([
                'customization_option_id' => $data['customization_option_id'],
                'material_id' => $data['material_id'],
                'product_id' => $data['product_id'],
                'quantity_needed' => $data['quantity_needed'],
                'price_adjustment' => $price_adjustment,
                'is_base' => $data['is_base'] ?? false
            ]);
        }
    }
}
