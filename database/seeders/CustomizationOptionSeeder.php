<?php

namespace Database\Seeders;

use App\Models\Customizations\Customization;
use App\Models\Customizations\CustomizationOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomizationOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Cambio de material base
        CustomizationOption::create([
            'customization_id' => 1,
            'option_name' => 'Plata Esterlina',
        ]);

        CustomizationOption::create([
            'customization_id' => 1,
            'option_name' => 'Acero Inoxidable',
        ]);

        CustomizationOption::create([
            'customization_id' => 1,
            'option_name' => 'Cobre',
        ]);

        CustomizationOption::create([
            'customization_id' => 1,
            'option_name' => 'Bronce',
        ]);
        //Cambio de material base

        //Largo de cadena
        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '15cm',
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '20cm',
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '25cm',
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '35cm',
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '40cm',
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '45cm',
        ]);
        //Largo de cadena

        //Incrustación de Piedra
        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Esmeralda',
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Zafiro',
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Rubí',
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Amatista',
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Diamante',
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Jade',
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Ambar',
        ]);
        //Incrustación de Piedra

        //Tallas de anillos
        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '10mm',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '12mm',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '14mm',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '16mm',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '18mm',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '20mm',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '22mm',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '24mm',
        ]);
        //Tallas de anillos

        //Bañado en material
        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Oro',
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Platino',
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Rodio',
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Titanio',
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Paladio',
        ]);
        //Bañado en material
    }
}
