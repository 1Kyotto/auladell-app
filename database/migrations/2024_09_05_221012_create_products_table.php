<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->decimal('base_price', 10, 2);
            $table->decimal('price', 12, 2);
            $table->enum('category', ['Aros', 'Anillos', 'Brazaletes', 'Collares',]);
            $table->boolean('is_active')->default(true);
            $table->string('image')->nullable();
            $table->boolean('inlay')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
