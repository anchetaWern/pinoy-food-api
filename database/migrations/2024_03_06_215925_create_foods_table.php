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
        /*
        - id 
        - description
        - calories
        - calories_unit
        - serving_size
        - serving_size_unit
        - servings_per_container
        - nutrients (json)
         */
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('calories');
            $table->char('calories_unit');
            $table->integer('serving_size')->nullable();
            $table->char('serving_size_unit')->nullable();
            $table->integer('servings_per_container')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
