<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->string('color')->default('-');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->smallInteger('status')->default(1);
            $table->timestamps();

            // Make article_id and color fields unique
            $table->unique(['article_id', 'color']);

            // Define foreign key constraints
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('files')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('variants');
    }
};
