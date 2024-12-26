<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archived_customization_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customization_option_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity_needed', 8, 2);
            $table->decimal('price_adjustment', 10, 2);
            $table->boolean('is_base')->default(false);
            $table->timestamp('archived_at');
            
            $table->foreign('product_id')->references('id')->on('archived_products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archived_customization_material');
    }
};