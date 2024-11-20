<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customization_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customization_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('price_adjustment', 10, 2);

            $table->foreign('customization_id')->references('id')->on('customizations');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customization_material');
    }
};
