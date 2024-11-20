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

        $products = Product::all();
        $mano_obra = 2800;
        $horas = [3, 5, 3, 5, 4, 6, 6, 8];
        foreach ($products as $product) {
            $costo_mano_obra = $mano_obra * $horas[$product->id - 1];

            $total = MaterialProduct::where('product_id', $product->id)
                ->join('materials', 'material_product.material_id', '=', 'materials.id')
                ->sum(DB::raw('materials.price_per_unit * material_product.quantity_needed'));

            $product->update(['base_price' => ($total + $costo_mano_obra)]);
            $product->update(['price' => $product->base_price * 1.19]);
        }
    }
}
