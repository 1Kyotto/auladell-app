<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customization_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customization_hierarchy_id');
            $table->string('category'); // Asume que es un valor de texto que representa la categoría
            
            $table->foreign('customization_hierarchy_id')->references('id')->on('customization_hierarchy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customization_categories');
    }
};
