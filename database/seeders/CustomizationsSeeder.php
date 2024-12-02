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
            'name' => 'Cambio de Material Base',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Largo de la cadena',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Incrustación de piedra',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Talla del anillo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Bañado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
