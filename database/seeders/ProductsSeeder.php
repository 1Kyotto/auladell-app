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
            'name' => 'Aros de Oro',
            'description' => 'Aros de oro de 18 quilates con acabado pulido.',
            'base_price' => 540000, // 9 gramos de oro (~58,000 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Plata',
            'description' => 'Aros sencillos de plata esterlina 925.',
            'base_price' => 63000, // 90 gramos de plata (~700 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Platino',
            'description' => 'Aros de platino con acabado de lujo.',
            'base_price' => 330000, // 11 gramos de platino (~30,000 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Acero Inoxidable',
            'description' => 'Aros duraderos de acero inoxidable con diseño moderno.',
            'base_price' => 6000, // 60 gramos de acero (~100 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Rodio',
            'description' => 'Aros bañados en rodio con acabado brillante.',
            'base_price' => 89870, // 10 gramos de rodio (~8,987 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Oro Blanco',
            'description' => 'Aros de oro blanco de 18 quilates.',
            'base_price' => 576000, // 9.5 gramos de oro blanco (~60,000 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Cobre',
            'description' => 'Aros artesanales de cobre.',
            'base_price' => 8000, // 40 gramos de cobre (~200 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Plata con Baño de Oro',
            'description' => 'Aros de plata esterlina con un baño de oro.',
            'base_price' => 120000, // 70 gramos de plata + oro (~1000 CLP/gramo en total)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Titanio',
            'description' => 'Aros livianos de titanio con diseño contemporáneo.',
            'base_price' => 36000, // 9 gramos de titanio (~4,000 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Aros de Bronce',
            'description' => 'Aros de bronce con acabado envejecido.',
            'base_price' => 12000, // 40 gramos de bronce (~300 CLP/gramo)
            'category' => 'Aros',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);        
        /*Aros*/

        /*Anillos*/
        Product::create([
            'name' => 'Anillo de Oro',
            'description' => 'Anillo de oro macizo, perfecto para uso diario o eventos.',
            'base_price' => 348000, // 6 gramos de oro (~58,000 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Plata',
            'description' => 'Anillo simple de plata esterlina.',
            'base_price' => 28000, // 40 gramos de plata (~700 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Platino',
            'description' => 'Anillo de platino pulido para eventos formales.',
            'base_price' => 270000, // 9 gramos de platino (~30,000 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Acero Inoxidable',
            'description' => 'Anillo de acero inoxidable con diseño moderno.',
            'base_price' => 8000, // 80 gramos de acero (~100 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Rodio',
            'description' => 'Anillo con baño de rodio, elegante y sofisticado.',
            'base_price' => 59870, // 6.5 gramos de rodio (~8,987 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Oro Blanco',
            'description' => 'Anillo de oro blanco con diseño minimalista.',
            'base_price' => 450000, // 7.5 gramos de oro blanco (~60,000 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Cobre',
            'description' => 'Anillo de cobre con acabado mate.',
            'base_price' => 4000, // 20 gramos de cobre (~200 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Plata con Baño de Oro',
            'description' => 'Anillo de plata esterlina con baño de oro.',
            'base_price' => 85000, // 65 gramos de plata + oro (~1,300 CLP/gramo en total)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Titanio',
            'description' => 'Anillo ligero de titanio, resistente a la corrosión.',
            'base_price' => 24000, // 6 gramos de titanio (~4,000 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Anillo de Bronce',
            'description' => 'Anillo de bronce artesanal, ideal para el uso diario.',
            'base_price' => 6000, // 20 gramos de bronce (~300 CLP/gramo)
            'category' => 'Anillos',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);        
        /*Anillos*/

        /*Brazaletes*/
        Product::create([
            'name' => 'Brazalete de Oro',
            'description' => 'Brazalete de oro con diseño clásico y elegante.',
            'base_price' => 870000, // 15 gramos de oro (~58,000 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Plata',
            'description' => 'Brazalete ancho de plata esterlina 925.',
            'base_price' => 105000, // 150 gramos de plata (~700 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Platino',
            'description' => 'Brazalete de platino resistente y elegante.',
            'base_price' => 600000, // 20 gramos de platino (~30,000 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Acero Inoxidable',
            'description' => 'Brazalete moderno de acero inoxidable pulido.',
            'base_price' => 15000, // 150 gramos de acero (~100 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Rodio',
            'description' => 'Brazalete chapado en rodio, con acabado brillante.',
            'base_price' => 179740, // 20 gramos de rodio (~8,987 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Oro Blanco',
            'description' => 'Brazalete de oro blanco, elegante y refinado.',
            'base_price' => 960000, // 16 gramos de oro blanco (~60,000 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Cobre',
            'description' => 'Brazalete artesanal de cobre con acabado brillante.',
            'base_price' => 12000, // 60 gramos de cobre (~200 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Plata con Baño de Oro',
            'description' => 'Brazalete de plata con un baño de oro fino.',
            'base_price' => 225000, // 150 gramos de plata + oro (~1500 CLP/gramo en total)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Titanio',
            'description' => 'Brazalete ligero de titanio, resistente y moderno.',
            'base_price' => 60000, // 15 gramos de titanio (~4,000 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Brazalete de Bronce',
            'description' => 'Brazalete de bronce con diseño rústico.',
            'base_price' => 15000, // 50 gramos de bronce (~300 CLP/gramo)
            'category' => 'Brazaletes',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);           
        /*Brazaletes*/

        /*Collares*/
        Product::create([
            'name' => 'Collar de Oro',
            'description' => 'Collar de oro de 18 quilates con un diseño elegante.',
            'base_price' => 1740000, // 30 gramos de oro (~58,000 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Plata',
            'description' => 'Collar sencillo de plata esterlina.',
            'base_price' => 175000, // 250 gramos de plata (~700 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Platino',
            'description' => 'Collar lujoso de platino con acabado pulido.',
            'base_price' => 1050000, // 35 gramos de platino (~30,000 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Acero Inoxidable',
            'description' => 'Collar moderno de acero inoxidable.',
            'base_price' => 20000, // 200 gramos de acero (~100 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Rodio',
            'description' => 'Collar chapado en rodio con un brillo excepcional.',
            'base_price' => 269610, // 30 gramos de rodio (~8,987 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Oro Blanco',
            'description' => 'Collar de oro blanco con un diseño moderno y minimalista.',
            'base_price' => 1920000, // 32 gramos de oro blanco (~60,000 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Cobre',
            'description' => 'Collar artesanal de cobre con estilo vintage.',
            'base_price' => 24000, // 120 gramos de cobre (~200 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Plata con Baño de Oro',
            'description' => 'Collar de plata esterlina con un baño de oro.',
            'base_price' => 330000, // 220 gramos de plata + oro (~1500 CLP/gramo en total)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Titanio',
            'description' => 'Collar ligero de titanio con un toque moderno.',
            'base_price' => 96000, // 24 gramos de titanio (~4,000 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Product::create([
            'name' => 'Collar de Bronce',
            'description' => 'Collar de bronce con diseño geométrico.',
            'base_price' => 30000, // 100 gramos de bronce (~300 CLP/gramo)
            'category' => 'Collares',
            'is_active' => true,
            'image' => 'products/product-image.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);        
        /*Collares*/
    }
}
