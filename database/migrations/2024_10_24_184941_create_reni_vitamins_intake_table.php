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
        Schema::create('reni_vitamins_intake', function (Blueprint $table) {
            $table->id();
            
            $table->integer('age_from');
            $table->integer('age_to')->nullable();

            $table->enum('age_type', ['month', 'year']);

            $table->integer('male_energy_req_in_kcal');
            $table->integer('female_energy_req_in_kcal');

            $table->float('male_weight_in_kg');
            $table->float('female_weight_in_kg');
            
            $table->float('male_protein_in_g');
            $table->float('female_protein_in_g');

            $table->float('male_vitamin_a');
            $table->float('female_vitamin_a');

            $table->float('male_vitamin_c');
            $table->float('female_vitamin_c');

            $table->float('male_vitamin_b1');
            $table->float('female_vitamin_b1');

            $table->float('male_vitamin_b2');
            $table->float('female_vitamin_b2');

            $table->float('male_vitamin_b3');
            $table->float('female_vitamin_b3');

            $table->float('male_vitamin_b6');
            $table->float('female_vitamin_b6');
          
            $table->float('male_vitamin_b9');
            $table->float('female_vitamin_b9');

            $table->float('male_vitamin_b12');
            $table->float('female_vitamin_b12');

            $table->float('male_vitamin_d');
            $table->float('female_vitamin_d');

            $table->float('male_vitamin_e');
            $table->float('female_vitamin_e');
            
            $table->float('male_vitamin_k');
            $table->float('female_vitamin_k');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reni_vitamins_intake');
    }
};
