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
            $table->unsignedBigInteger('customization_option_id');
            $table->unsignedBigInteger('material_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity_needed', 8, 2);
            $table->decimal('price_adjustment', 10, 2);
            $table->boolean('is_base')->default(false);

            $table->foreign('customization_option_id')->references('id')->on('customization_option');
            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customization_material');
    }
};
