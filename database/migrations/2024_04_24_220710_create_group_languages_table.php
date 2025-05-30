<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_languages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_id'); 
            $table->unsignedBigInteger('language_id'); 
            $table->unsignedBigInteger('school_list')->nullable();
            
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade'); 
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');  
            
            $table->foreign('school_list')->references('id')->on('files')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_languages');
    }
};
