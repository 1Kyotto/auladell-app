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
            'option_name' => '4',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '5',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '6',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '7',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '8',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '9',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '10',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '11',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '12',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '13',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '14',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '15',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '16',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '17',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '18',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '19',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '20',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '21',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '22',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '23',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '24',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '25',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '26',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '27',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '28',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '29',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '30',
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '31',
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
