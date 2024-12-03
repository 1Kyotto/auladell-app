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
            $table->unsignedBigInteger('cart_product_id')->nullable();
            $table->unsignedBigInteger('order_product_id')->nullable();
            $table->unsignedBigInteger('customization_option_id');
            $table->integer('quantity')->default(1);
            $table->timestamps();
            
            $table->foreign('cart_product_id')->references('id')->on('cart_product');
            $table->foreign('order_product_id')->references('id')->on('order_product');
            $table->foreign('customization_option_id')->references('id')->on('customization_option');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customization_selection');
    }
};
