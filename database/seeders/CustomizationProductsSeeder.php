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
        //Obtener todas las personalizaciones y sus categorías
        $customizations = CustomizationHierarchy::with('categories')->get();

        //Iterar sobre cada producto en la base de datos
        $products = Product::all();

        foreach ($products as $product) {
            foreach ($customizations as $customization) {
                //Verificar si la personalización tiene una categoría que coincide con la del producto
                foreach ($customization->categories as $category) {
                    if ($category->category === $product->category) {
                        //Insertar en la tabla pivot
                        DB::table('customization_product')->insert([
                            'product_id' => $product->id,
                            'customization_hierarchy_id' => $customization->id,
                        ]);
                    }
                }
            }
        }
    }
}
