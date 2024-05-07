<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('cv')->nullable();
            
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('cv')->references('id')->on('files')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('recruitments');
    }
};
