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
        Schema::create('reni_average_requirements', function (Blueprint $table) {
            $table->id();
            
            $table->integer('age_from');
            $table->integer('age_to')->nullable();

            $table->integer('male_protein');
            $table->integer('female_protein');

            $table->integer('male_vitamin_a')->nullable();
            $table->integer('femaale_vitamin_a')->nullable();

            $table->float('male_thiamin')->nullable();
            $table->float('female_thiamin')->nullable();

            $table->float('male_riboflavin')->nullable();
            $table->float('female_riboflavin')->nullable();

            $table->integer('male_niacin')->nullable();
            $table->integer('female_niacin')->nullable();

            $table->float('male_pyridoxine')->nullable();
            $table->float('female_pyridoxine')->nullable();

            $table->float('male_cobalamin')->nullable();
            $table->float('female_cobalamin')->nullable();

            $table->integer('male_folate')->nullable();
            $table->integer('female_folate')->nullable();

            $table->integer('male_vitamin_c')->nullable();
            $table->integer('female_vitamin_c')->nullable();

            $table->float('male_iron')->nullable();
            $table->float('female_iron')->nullable();

            $table->float('male_zinc')->nullable();
            $table->float('female_zinc')->nullable();

            $table->float('male_selenium')->nullable();
            $table->float('female_selenium')->nullable();

            $table->integer('male_iodine')->nullable();
            $table->integer('female_iodine')->nullable();

            $table->integer('male_calcium')->nullable();
            $table->integer('female_calcium')->nullable();

            $table->integer('male_phosphorus')->nullable();
            $table->integer('female_phosphorus')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reni_average_requirements');
    }
};
