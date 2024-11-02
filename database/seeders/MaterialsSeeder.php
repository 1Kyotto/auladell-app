<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Materials\Material;
use Carbon\Carbon;

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
        /* $metals = [
            ['name' => 'Oro', 'description' => 'Oro de alta pureza', 'unit' => 'gr', 'symbol' => 'XAU'],
            ['name' => 'Plata', 'description' => 'Plata pura', 'unit' => 'gr', 'symbol' => 'XAG'],
            ['name' => 'Platino', 'description' => 'Platino puro', 'unit' => 'gr', 'symbol' => 'XPT'],
        ];

        foreach ($metals as $metal) {
            $price = $this->getPriceFromAPI($metal['symbol']);

            if (is_null($price)) {
                $price = 0;
            }

            Material::create([
                'name' => $metal['name'],
                'description' => $metal['description'],
                'unit' => $metal['unit'],
                'price_per_unit' => $price,
                'quantity_in_stock' => rand(100, 500),
            ]);
        } */
        
        Material::create([
            'name' => 'Oro',
            'description' => 'Metal precioso utilizado para joyería fina como anillos y collares.',
            'unit' => 'gramos',
            'price_per_unit' => 58000, // Estimación del precio en CLP por gramo de oro
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Plata Esterlina',
            'description' => 'Metal brillante y accesible utilizado para diversas joyas.',
            'unit' => 'gramos',
            'price_per_unit' => 700, // Estimación del precio en CLP por gramo de plata
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Platino',
            'description' => 'Metal precioso conocido por su durabilidad y uso en joyería de lujo.',
            'unit' => 'gramos',
            'price_per_unit' => 30000, // Estimación del precio en CLP por gramo de platino
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Rodio',
            'description' => 'Metal raro utilizado para chapar joyas de lujo.',
            'unit' => 'gramos',
            'price_per_unit' => 8987, // Estimación del precio en CLP por gramo de rodio
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Acero Inoxidable',
            'description' => 'Metal resistente y duradero usado en joyería moderna.',
            'unit' => 'gramos',
            'price_per_unit' => 100, // Estimación del precio en CLP por gramo de acero inoxidable
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Titanio',
            'description' => 'Metal ligero y resistente, utilizado en joyería moderna.',
            'unit' => 'gramos',
            'price_per_unit' => 4000, // Estimación del precio en CLP por gramo de titanio
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Cobre',
            'description' => 'Material asequible utilizado en joyería artesanal.',
            'unit' => 'gramos',
            'price_per_unit' => 200, // Estimación del precio en CLP por gramo de cobre
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Paladio',
            'description' => 'Metal raro y ligero, ideal para joyas de alta gama.',
            'unit' => 'gramos',
            'price_per_unit' => 25000, // Estimación del precio en CLP por gramo de paladio
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Bronce',
            'description' => 'Material accesible y duradero utilizado en joyería artesanal.',
            'unit' => 'gramos',
            'price_per_unit' => 300, // Estimación del precio en CLP por gramo de bronce
            'quantity_in_stock' => rand(100, 500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Material::create([
            'name' => 'Cuero',
            'description' => 'Material flexible utilizado en joyería informal y moderna.',
            'unit' => 'metros',
            'price_per_unit' => 3000, // Estimación del precio en CLP por metro de cuero
            'quantity_in_stock' => rand(50, 200),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
    }
}
