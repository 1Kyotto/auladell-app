<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archived_material_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('quantity', 8, 2);
            $table->timestamp('archived_at');
            
            $table->foreign('product_id')->references('id')->on('archived_products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archived_material_product');
    }
};