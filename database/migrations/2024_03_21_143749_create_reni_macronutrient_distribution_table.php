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
        Schema::create('reni_macronutrient_distribution', function (Blueprint $table) {
            $table->id();
            $table->integer('age_from');
            $table->integer('age_to')->nullable();
            $table->integer('protein_from');
            $table->integer('protein_to')->nullable();
            $table->integer('fat_from');
            $table->integer('fat_to')->nullable();
            $table->integer('carbs_from');
            $table->integer('carbs_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reni_macronutrient_distribution');
    }
};
