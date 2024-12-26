<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Materials\Material;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MaterialsSeeder extends Seeder
{
    private function getPriceFromAPI($metal)
    {
        $apiKey = env('METALPRICE_API_KEY');
        $baseCurrency = 'CLP';

        $url = "https://api.metalpriceapi.com/v1/latest?api_key={$apiKey}&base={$baseCurrency}&currencies=XAU,XAG,XPT";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            $metalKey = "CLP{$metal}";
            $priceInTroyOunce = $data['rates'][$metalKey] ?? null;

            if ($priceInTroyOunce) {
                $priceInGrams = $priceInTroyOunce / 31.1035;
                return $priceInGrams;
            }
        }

        return null;
    }

    public function run(): void
    {
        $materials = [
            [
                'name' => 'Oro',
                'description' => 'Metal precioso utilizado para joyería fina como anillos y collares.',
                'unit' => 'gramos',
                'price_per_unit' => 58000,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Plata Esterlina',
                'description' => 'Metal brillante y accesible utilizado para diversas joyas.',
                'unit' => 'gramos',
                'price_per_unit' => 700,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Platino',
                'description' => 'Metal precioso conocido por su durabilidad y uso en joyería de lujo.',
                'unit' => 'gramos',
                'price_per_unit' => 30000,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Rodio',
                'description' => 'Metal raro utilizado para chapar joyas de lujo.',
                'unit' => 'gramos',
                'price_per_unit' => 8987,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Acero Inoxidable',
                'description' => 'Metal resistente y duradero usado en joyería moderna.',
                'unit' => 'gramos',
                'price_per_unit' => 100,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Titanio',
                'description' => 'Metal ligero y resistente, utilizado en joyería moderna.',
                'unit' => 'gramos',
                'price_per_unit' => 4000,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Cobre',
                'description' => 'Material asequible utilizado en joyería artesanal.',
                'unit' => 'gramos',
                'price_per_unit' => 200,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Paladio',
                'description' => 'Metal raro y ligero, ideal para joyas de alta gama.',
                'unit' => 'gramos',
                'price_per_unit' => 25000,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Bronce',
                'description' => 'Material accesible y duradero utilizado en joyería artesanal.',
                'unit' => 'gramos',
                'price_per_unit' => 300,
                'quantity_in_stock' => rand(100, 500),
            ],
            [
                'name' => 'Cuero',
                'description' => 'Material flexible utilizado en joyería informal y moderna.',
                'unit' => 'metros',
                'price_per_unit' => 3000,
                'quantity_in_stock' => rand(50, 200),
            ],
            [
                'name' => 'Green Emerald rounds',
                'description' => 'Piedra preciosa verde utilizada en joyería fina.',
                'unit' => 'quilates',
                'price_per_unit' => 260000,
                'quantity_in_stock' => rand(1, 4),
            ],
            [
                'name' => 'Blue Sapphires',
                'description' => 'Piedra preciosa azul valorada en joyería y relojería.',
                'unit' => 'quilates',
                'price_per_unit' => 97700,
                'quantity_in_stock' => rand(1, 6),
            ],
            [
                'name' => 'Rubí',
                'description' => 'Piedra preciosa roja, altamente valorada en joyería.',
                'unit' => 'quilates',
                'price_per_unit' => 230000,
                'quantity_in_stock' => rand(1, 4),
            ],
            [
                'name' => 'Amatista',
                'description' => 'Piedra semipreciosa púrpura, popular en joyería y decoración.',
                'unit' => 'quilates',
                'price_per_unit' => 15000,
                'quantity_in_stock' => rand(100, 200),
            ],
            [
                'name' => 'Natural Melee Blue Diamonds',
                'description' => 'Piedra preciosa extremadamente valiosa y resistente.',
                'unit' => 'quilates',
                'price_per_unit' => 253000,
                'quantity_in_stock' => rand(1, 4),
            ],
            [
                'name' => 'Jade',
                'description' => 'Piedra verde semipreciosa valorada por su durabilidad y belleza.',
                'unit' => 'quilates',
                'price_per_unit' => 12000,
                'quantity_in_stock' => rand(50, 150),
            ],
            [
                'name' => 'Ambar',
                'description' => 'Resina fosilizada semipreciosa, conocida por su color cálido y su ligereza.',
                'unit' => 'quilates',
                'price_per_unit' => 8000,
                'quantity_in_stock' => rand(50, 150),
            ],
        ];

        foreach ($materials as $materialData) {
            // Crear el material
            $material = Material::create([
                'name' => $materialData['name'],
                'description' => $materialData['description'],
                'unit' => $materialData['unit'],
                'price_per_unit' => $materialData['price_per_unit'],
                'quantity_in_stock' => $materialData['quantity_in_stock'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Registrar la compra inicial en inventory_change
            DB::table('inventory_change')->insert([
                'material_id' => $material->id,
                'performed_by' => 1, // ID del administrador
                'quantity' => $materialData['quantity_in_stock'],
                'transaction_type' => 'Purchase',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}