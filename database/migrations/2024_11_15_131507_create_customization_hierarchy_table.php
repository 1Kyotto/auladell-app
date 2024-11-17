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
        Schema::create('customization_hierarchy', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('customization_hierarchy')->onDelete('set null');
            $table->unsignedBigInteger('customization_id');
            $table->decimal('additional_cost', 10, 2)->default(0);

            $table->foreign('customization_id')->references('id')->on('customizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customization_hierarchy');
    }
};
