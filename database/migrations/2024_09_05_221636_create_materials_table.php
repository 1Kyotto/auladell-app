<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->text('description');
            $table->string('unit',10); //Unidad de medida: gr, kg, kl...
            $table->decimal('price_per_unit',12,2); //Precio por cada unidad de medida
            $table->decimal('quantity_in_stock',5,2); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
