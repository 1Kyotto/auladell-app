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
        Schema::create('customization_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customization_id');
            $table->string('option_name');
            $table->boolean('requires_material')->default(true);

            $table->foreign('customization_id')->references('id')->on('customizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customization_option');
    }
};
