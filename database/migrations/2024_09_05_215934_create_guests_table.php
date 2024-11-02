<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('email', 30)->unique();
            $table->string('phone',9);
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
