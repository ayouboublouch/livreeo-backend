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
        Schema::create('group_language_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id'); 
            $table->unsignedBigInteger('group_language_id');

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade'); 
            $table->foreign('group_language_id')->references('id')->on('group_languages')->onDelete('cascade');  
            $table->integer('quantity')->default(1);      
            $table->timestamps();

            $table->unique(['article_id', 'group_language_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_language_articles');
    }
};
