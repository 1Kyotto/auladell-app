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
            $table->decimal('quantity_needed', 8, 2);

            $table->foreign('customization_id')->references('id')->on('customizations');
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customization_material');
    }
};
