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
        Schema::create('reni_macronutrient_intake', function (Blueprint $table) {
            $table->id();
            $table->integer('age_from');
            $table->integer('age_to')->nullable();

            $table->integer('male_protein_in_grams');
            $table->integer('female_protein_in_grams');

            $table->float('linolenic_acid');
            $table->float('linoleic_acid');

            $table->integer('fiber_from_in_grams')->nullable();
            $table->integer('fiber_to_in_grams')->nullable();

            $table->integer('male_water_in_ml');
            $table->integer('female_water_in_ml');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reni_macronutrient_intake');
    }
};
