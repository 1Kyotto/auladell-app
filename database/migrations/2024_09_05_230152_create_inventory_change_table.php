<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_change', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('performed_by')->nullable();
            $table->decimal('quantity', 8, 2);
            $table->enum('transaction_type', ['Purchase', 'Production', 'Adjustment']);
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('performed_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_change');
    }
};
