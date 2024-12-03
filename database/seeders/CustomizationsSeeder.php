<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizations\Customization;
use Carbon\Carbon;

class CustomizationsSeeder extends Seeder
{
    public function run(): void
    {
        Customization::create([
            'name' => 'Material Base',
            'category' => json_encode(['all']),
            'requires_option' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Largo de cadena',
            'category' => json_encode(['Collares', 'Brazaletes']),
            'requires_option' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Incrustación',
            'category' => json_encode(['all']),
            'requires_option' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Talla de anillo',
            'category' => json_encode(['Anillos']),
            'requires_option' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Bañado',
            'category' => json_encode(['all']),
            'requires_option' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
