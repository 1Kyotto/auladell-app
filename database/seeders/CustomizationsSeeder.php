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
            'name' => 'Materiales',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Piedras preciosas',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Grabado',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Acabado',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Estilo',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Montura',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Diseño',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Cierre',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Longitud',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Customization::create([
            'name' => 'Ancho',
            'description' => 'Personalizaciones de materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
