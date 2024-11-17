<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customizations\Customization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MaterialsSeeder::class,
            ProductsSeeder::class,
            CustomizationsSeeder::class,
            //CustomizationProductsSeeder::class
            CustomizationHierarchySeeder::class,
        ]);
    }
}
