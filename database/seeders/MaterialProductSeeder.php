<?php

namespace Database\Seeders;

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
            'material_id' => 1,
            'quantity_needed' => 5,
        ]);

        MaterialProduct::create([
            'product_id' => 1,
            'material_id' => 15,
            'quantity_needed' => 0.3,
        ]);
        //Producto 1

        //Producto 2
        MaterialProduct::create([
            'product_id' => 2,
            'material_id' => 1,
            'quantity_needed' => 5,
        ]);

        MaterialProduct::create([
            'product_id' => 2,
            'material_id' => 11,
            'quantity_needed' => 0.3,
        ]);
        //Producto 2

        //Producto 3
        MaterialProduct::create([
            'product_id' => 3,
            'material_id' => 2,
            'quantity_needed' => 4,
        ]);

        MaterialProduct::create([
            'product_id' => 3,
            'material_id' => 15,
            'quantity_needed' => 0.3,
        ]);
        //Producto 3

        //Producto 4
        MaterialProduct::create([
            'product_id' => 4,
            'material_id' => 2,
            'quantity_needed' => 4,
        ]);

        MaterialProduct::create([
            'product_id' => 4,
            'material_id' => 11,
            'quantity_needed' => 0.3,
        ]);
        //Producto 4

        //Producto 5
        MaterialProduct::create([
            'product_id' => 5,
            'material_id' => 2,
            'quantity_needed' => 6,
        ]);
        //Producto 5

        //Producto 6
        MaterialProduct::create([
            'product_id' => 6,
            'material_id' => 1,
            'quantity_needed' => 5,
        ]);
        //Producto 6

        //Producto 7
        MaterialProduct::create([
            'product_id' => 7,
            'material_id' => 1,
            'quantity_needed' => 8,
        ]);
        //Producto 7

        //Producto 8
        MaterialProduct::create([
            'product_id' => 8,
            'material_id' => 1,
            'quantity_needed' => 8,
        ]);

        MaterialProduct::create([
            'product_id' => 8,
            'material_id' => 15,
            'quantity_needed' => 0.3,
        ]);
        //Producto 8

        //Producto 9
        MaterialProduct::create([
            'product_id' => 9,
            'material_id' => 2,
            'quantity_needed' => 8,
        ]);
        //Producto 9

        //Producto 10
        MaterialProduct::create([
            'product_id' => 10,
            'material_id' => 2,
            'quantity_needed' => 8,
        ]);
        MaterialProduct::create([
            'product_id' => 10,
            'material_id' => 15,
            'quantity_needed' => 0.3,
        ]);
        //Producto 10

        //Producto 11
        MaterialProduct::create([
            'product_id' => 11,
            'material_id' => 2,
            'quantity_needed' => 20,
        ]);
        MaterialProduct::create([
            'product_id' => 11,
            'material_id' => 15,
            'quantity_needed' => 0.3,
        ]);
        //Producto 11

        //Producto 12
        MaterialProduct::create([
            'product_id' => 12,
            'material_id' => 2,
            'quantity_needed' => 20,
        ]);
        MaterialProduct::create([
            'product_id' => 12,
            'material_id' => 11,
            'quantity_needed' => 0.3,
        ]);
        //Producto 12

        //Producto 13
        MaterialProduct::create([
            'product_id' => 13,
            'material_id' => 1,
            'quantity_needed' => 5,
        ]);
        MaterialProduct::create([
            'product_id' => 13,
            'material_id' => 15,
            'quantity_needed' => 0.3,
        ]);
        //Producto 13

        //Producto 14
        MaterialProduct::create([
            'product_id' => 14,
            'material_id' => 1,
            'quantity_needed' => 5,
        ]);
        MaterialProduct::create([
            'product_id' => 14,
            'material_id' => 11,
            'quantity_needed' => 0.3,
        ]);
        //Producto 14

        $products = Product::all();
        $mano_obra = 2800;
        $horas = [5, 6, 10, 12, 6, 6, 15, 25, 10, 20, 30, 35, 38, 40];
        foreach ($products as $product) {
            $costo_mano_obra = $mano_obra * $horas[$product->id - 1];

            $total = MaterialProduct::where('product_id', $product->id)
                ->join('materials', 'material_product.material_id', '=', 'materials.id')
                ->sum(DB::raw('materials.price_per_unit * material_product.quantity_needed'));

            $product->update(['base_price' => ($total + $costo_mano_obra) * 1.19]);
        }
    }
}
