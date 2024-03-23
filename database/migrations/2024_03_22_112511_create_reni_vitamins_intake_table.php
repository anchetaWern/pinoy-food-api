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

            $table->float('male_vitamin_a');
            $table->float('female_vitamin_a');

            $table->float('male_vitamin_d');
            $table->float('female_vitamin_d');

            $table->float('male_vitamin_e');
            $table->float('female_vitamin_e');

            $table->float('male_vitamin_k');
            $table->float('female_vitamin_k');

            $table->float('male_thiamin');
            $table->float('female_thiamin');

            $table->float('male_riboflavin');
            $table->float('female_riboflavin');

            $table->float('male_niacin');
            $table->float('female_niacin');

            $table->float('male_pyridoxine'); // b6
            $table->float('female_pyridoxine');

            $table->float('male_cobalamin'); // b12
            $table->float('female_cobalamin');

            $table->float('male_folate'); // b9
            $table->float('female_folate');

            $table->float('male_vitamin_c');
            $table->float('female_vitamin_c');

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
