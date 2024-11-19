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
            'name' => 'Northern Star Stud Earrings with 0.3 ct Diamond - Gold Vermeil',
            'base_price' => 0,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Northern Star Stud Earrings',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Product::create([
            'name' => 'Northern Star Stud Earrings with 0.3 ct Green Emerald Gemstone - Gold Vermeil',
            'base_price' => 0,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Northern Star Stud Earrings',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Northern Star Stud Earrings with 0.3 ct Diamond - Silver',
            'base_price' => 0,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Northern Star Stud Earrings',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Northern Star Stud Earrings with 0.3 ct Green Emerald Gemstone - Silver',
            'base_price' => 0,
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Northern Star Stud Earrings',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Aros*/

        /*Anillos*/
        Product::create([
            'name' => 'Laney Ring - Silver',
            'base_price' => 0,
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Laney Ring',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Product::create([
            'name' => 'Laney Ring - Gold Vermeil',
            'base_price' => 0,
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Laney Ring',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Anillos*/

        /*Brazaletes*/
        Product::create([
            'name' => 'Ivy Name Paperclip Chain Bracelet - Gold Vermeil',
            'base_price' => 0,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Ivy Name Paperclip Chain Bracelet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Ivy Name Paperclip Chain Bracelet with Diamonds - Gold Vermeil',
            'base_price' => 0,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Ivy Name Paperclip Chain Bracelet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Ivy Name Paperclip Chain Bracelet - Silver',
            'base_price' => 0,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Ivy Name Paperclip Chain Bracelet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Ivy Name Paperclip Chain Bracelet with Diamonds - Silver',
            'base_price' => 0,
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Ivy Name Paperclip Chain Bracelet',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Brazaletes*/

        /*Collares*/
        Product::create([
            'name' => 'Engraved Northern Star Necklace with 0.3ct Diamond - Silver',
            'base_price' => 0,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Engraved Northern Star Necklace',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Engraved Northern Star Necklace with 0.3ct Green Emerald Gemstone - Silver',
            'base_price' => 0,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Engraved Northern Star Necklace',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Engraved Northern Star Necklace with 0.3ct Diamond - Gold Vermeil',
            'base_price' => 0,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Engraved Northern Star Necklace',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Product::create([
            'name' => 'Engraved Northern Star Necklace with 0.3ct Green Emerald Gemstone - Gold Vermeil',
            'base_price' => 0,
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'variation' => 'Engraved Northern Star Necklace',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        /*Collares*/
    }
}
