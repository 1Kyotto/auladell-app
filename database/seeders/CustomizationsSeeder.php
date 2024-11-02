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
        //Personalizaciones para Aros
        Customization::create([
            'name' => 'Acabado Mate',
            'description' => 'Aros con un acabado mate que le da un aspecto moderno.',
            'additional_cost' => 20000, // en CLP
            'category' => 'Aros',
            'customization_type' => 'materiales',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
