<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products\Product;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*Aros*/
        Product::create([
            'name' => 'Northern Star Stud Earrings',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 3,
            'labor_cost_per_hour' => 10000,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Teardrop Dangle Earrings',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 5,
            'labor_cost_per_hour' => 10000,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Aros*/

        /*Anillos*/
        Product::create([
            'name' => 'Sloane Ring',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 3,
            'labor_cost_per_hour' => 10000,
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Laney Ring',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 5,
            'labor_cost_per_hour' => 10000,
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Anillos*/

        /*Brazaletes*/
        Product::create([
            'name' => 'Ivy Name Paperclip Chain Bracelet',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 4,
            'labor_cost_per_hour' => 10000,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'The Showstopper Link',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 6,
            'labor_cost_per_hour' => 10000,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Brazaletes*/

        /*Collares*/
        Product::create([
            'name' => 'Engraved Northern Star Necklace',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 6,
            'labor_cost_per_hour' => 10000,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Aria Mirror Chain Necklace',
            'raw_price' => 0,
            'final_price' => 0,
            'labor_hours' => 8,
            'labor_cost_per_hour' => 10000,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Collares*/
    }
}
