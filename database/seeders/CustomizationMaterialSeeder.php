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
        $margin = 0.15; // Margen de ganancia del 20%
        $mano_obra = 2800;
        $iva = 1.19;
        $horas = 0;

        $validMaterialIds = [1, 2, 3, 5, 6, 7, 9];
        $materials = Material::whereIn('id', $validMaterialIds)->get();
        $materialProducts = MaterialProduct::all();

        foreach ($materialProducts as $materialProduct) {
            $baseMaterial = $materials->find($materialProduct->material_id);
            $productId = $materialProduct->product_id; // Obtener el product_id del registro en material_product

            if ($baseMaterial) {
                foreach ($materials as $alternativeMaterial) {
                    if ($alternativeMaterial->id !== $baseMaterial->id) {
                        $cost_base = $alternativeMaterial->price_per_unit * $materialProduct->quantity_needed;
                        $price_adjustment = $cost_base * (1 + $margin);

                        // Insertar el registro en customization_material con product_id
                        CustomizationMaterial::create([
                            'product_id' => $productId,
                            'customization_id' => 1, // Cambiar esto si es necesario
                            'material_id' => $alternativeMaterial->id,
                            'price_adjustment' => $price_adjustment,
                        ]);
                    }
                }
            }
        }
    }
}
