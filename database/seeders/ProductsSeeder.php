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
            'base_price' => 0,
            'price' => 0,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Teardrop Dangle Earrings',
            'base_price' => 0,
            'price' => 0,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Aros*/

        /*Anillos*/
        Product::create([
            'name' => 'Sloane Ring',
            'base_price' => 0,
            'price' => 0,
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Laney Ring',
            'base_price' => 0,
            'price' => 0,
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Anillos*/

        /*Brazaletes*/
        Product::create([
            'name' => 'Ivy Name Paperclip Chain Bracelet',
            'base_price' => 0,
            'price' => 0,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'The Showstopper Link',
            'base_price' => 0,
            'price' => 0,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Brazaletes*/

        /*Collares*/
        Product::create([
            'name' => 'Engraved Northern Star Necklace',
            'base_price' => 0,
            'price' => 0,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Aria Mirror Chain Necklace',
            'base_price' => 0,
            'price' => 0,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'inlay' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Collares*/
    }
}
