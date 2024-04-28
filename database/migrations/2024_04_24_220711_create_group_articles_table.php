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
        Schema::create('group_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id'); 
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade'); 
            $table->unsignedBigInteger('article_id'); 
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');  
            $table->integer('quantity')->default(1);      
            $table->timestamps();

            $table->unique(['group_id', 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_articles');
    }
};
