<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customization_selection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_product_id');
            $table->unsignedBigInteger('customization_id');
            $table->integer('quantity');

            $table->foreign('order_product_id')->references('id')->on('order_product');
            $table->foreign('customization_id')->references('id')->on('customizations');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customization_selection');
    }
};
