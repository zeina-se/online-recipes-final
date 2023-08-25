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
        Schema::create('cuisines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cuisine_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
            $table->foreign('cuisine_id')->references('id')->on('cuisines')->onDelete('cascade');   
        });

       
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');   
        });
       
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');   
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');  
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->double('quantity');
            $table->double('units');
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe');
    }
};
