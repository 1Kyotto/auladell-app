<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->unsignedBigInteger('shipping_address_id');
            $table->decimal('total');
            $table->enum('status', ['Waiting', 'Production', 'Packaging', 'Shipped', 'Fulfilled', 'Cancelled'])->default('Waiting');
            $table->string('order_num')->default('');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('guest_id')->references('id')->on('guests');
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
