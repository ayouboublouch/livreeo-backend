<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('shipping_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2); 
            $table->unsignedInteger('delay'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_types');
    }
};
