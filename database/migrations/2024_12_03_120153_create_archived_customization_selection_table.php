<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('archived_customization_selection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_product_id');
            $table->unsignedBigInteger('customization_option_id');
            $table->timestamp('archived_at');
            
            $table->foreign('customization_option_id')
                  ->references('id')
                  ->on('customization_option')
                  ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('archived_customization_selection');
    }
};