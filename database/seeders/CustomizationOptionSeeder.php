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
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 1,
            'option_name' => 'Acero Inoxidable',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 1,
            'option_name' => 'Cobre',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 1,
            'option_name' => 'Bronce',
            'requires_material' => true,
        ]);
        //Cambio de material base

        //Largo de cadena
        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '15cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '16cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '17cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '18cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '19cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '20cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '40cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '45cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '50cm',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 2,
            'option_name' => '55cm',
            'requires_material' => false,
        ]);
        //Largo de cadena

        //Incrustación de Piedra
        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Sin Incrustación',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Esmeralda',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Zafiro',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Rubí',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Amatista',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Diamante',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Jade',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 3,
            'option_name' => 'Ambar',
            'requires_material' => true,
        ]);
        //Incrustación de Piedra

        //Tallas de anillos
        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '4',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '5',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '6',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '7',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '8',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '9',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '10',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '11',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '12',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '13',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '14',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '15',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '16',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '17',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '18',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '19',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '20',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '21',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '22',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '23',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '24',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '25',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '26',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '27',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '28',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '29',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '30',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 4,
            'option_name' => '31',
            'requires_material' => false,
        ]);
        //Tallas de anillos

        //Bañado en material
        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Sin Bañado',
            'requires_material' => false,
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Oro',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Platino',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Rodio',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Titanio',
            'requires_material' => true,
        ]);

        CustomizationOption::create([
            'customization_id' => 5,
            'option_name' => 'Paladio',
            'requires_material' => true,
        ]);
        //Bañado en material
    }
}
