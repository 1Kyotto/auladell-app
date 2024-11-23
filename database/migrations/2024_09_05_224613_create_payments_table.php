<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->enum('payment_method', ['Credit', 'Debit', 'Transfer']);
            $table->decimal('total_price');
            $table->decimal('net_price');
            $table->enum('payment_status', ['Confirmed', 'Cancelled', 'In Transaction', 'Failed']);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
