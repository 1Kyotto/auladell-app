<?php

namespace Database\Seeders;

use App\Helpers\PriceHelper;
use App\Models\Materials\MaterialProduct;
use App\Models\Products\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Producto 1
        MaterialProduct::create([
            'product_id' => 1,
            'material_id' => 2,
            'quantity_needed' => 15,
        ]);
        //Producto 1

        //Producto 2
        MaterialProduct::create([
            'product_id' => 2,
            'material_id' => 2,
            'quantity_needed' => 7,
        ]);
        //Producto 2

        //Producto 3
        MaterialProduct::create([
            'product_id' => 3,
            'material_id' => 2,
            'quantity_needed' => 8,
        ]);
        //Producto 3

        //Producto 4
        MaterialProduct::create([
            'product_id' => 4,
            'material_id' => 2,
            'quantity_needed' => 12,
        ]);
        //Producto 4

        //Producto 5
        MaterialProduct::create([
            'product_id' => 5,
            'material_id' => 2,
            'quantity_needed' => 15,
        ]);
        //Producto 5

        //Producto 6
        MaterialProduct::create([
            'product_id' => 6,
            'material_id' => 2,
            'quantity_needed' => 30,
        ]);
        //Producto 6

        //Producto 7
        MaterialProduct::create([
            'product_id' => 7,
            'material_id' => 2,
            'quantity_needed' => 15,
        ]);
        //Producto 7

        //Producto 8
        MaterialProduct::create([
            'product_id' => 8,
            'material_id' => 2,
            'quantity_needed' => 30,
        ]);
        //Producto 8

        // Actualizar los precios base de todos los productos
        $this->updateBaseProducts();
    }

    private function updateBaseProducts()
    {
        $margin = 0.20; // 20% de margen
        $iva = 0.19;    // 19% de IVA
        $products = Product::with('materials')->get();
    
        foreach ($products as $product) {
            $materialProduct = MaterialProduct::where('product_id', $product->id)->first();
            
            if ($materialProduct) {
                $material = $materialProduct->material;
                $quantityNeeded = $materialProduct->quantity_needed;
                
                // Calcular costo del material
                $materialCost = $material->price_per_unit * $quantityNeeded;
                
                // Calcular costo de mano de obra
                $laborCost = $product->labor_hours * $product->labor_cost_per_hour;
                
                // Precio raw (materiales + mano de obra)
                $rawPrice = round($materialCost + $laborCost);
                
                // Precio con margen
                $priceWithMargin = round($rawPrice * (1 + $margin));
                
                // Precio final con IVA
                $finalPrice = round($priceWithMargin * (1 + $iva));

                $finalPrice = PriceHelper::applyAttractiveRounding($finalPrice);
                
                $product->update([
                    'raw_price' => $rawPrice,
                    'final_price' => $finalPrice
                ]);
            }
        }
    }
}
