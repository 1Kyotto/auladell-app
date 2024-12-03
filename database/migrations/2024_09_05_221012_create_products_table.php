<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('raw_price', 10, 0)->default(0);
            $table->decimal('final_price', 10, 0)->default(0);
            $table->decimal('labor_hours', 4, 2)->default(0);
            $table->decimal('labor_cost_per_hour', 10, 2)->default(0);
            $table->string('category');
            $table->boolean('is_active')->default(true);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
