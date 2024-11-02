<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->text('description');
            $table->decimal('additional_cost', 8, 2);
            $table->string('category')->nullable();
            $table->string('customization_type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customizations');
    }
};
