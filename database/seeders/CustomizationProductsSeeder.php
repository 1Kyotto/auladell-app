<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products\Product;
use App\Models\Customizations\Customization;
use Illuminate\Support\Facades\DB;

class CustomizationProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Definir las personalizaciones por categoría
        $categories = ['Aros', 'Anillos', 'Brazaletes', 'Collares'];

        // Recorrer cada categoría
        foreach ($categories as $category) {
            // Obtener los productos de la categoría actual
            $products = Product::where('category', $category)->pluck('id')->toArray();

            // Eliminar duplicados de los productos (si aún es necesario)
            $products = array_unique($products);

            // Obtener las personalizaciones para esta categoría
            $customizations = Customization::where('category', $category)->pluck('id')->toArray();

            // Asignar las personalizaciones a cada producto de la categoría
            foreach ($products as $productId) {
                foreach ($customizations as $customizationId) {
                    DB::table('customization_product')->insertOrIgnore([
                        'product_id' => $productId,
                        'customization_id' => $customizationId,
                    ]);
                }
            }
        }

        $this->command->info('Personalizaciones asignadas correctamente a los productos.');
    }
}