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
        Schema::create('reni_minerals_intake', function (Blueprint $table) {
            $table->id();
            
            $table->integer('age_from');
            $table->integer('age_to')->nullable();

            $table->enum('age_type', ['month', 'year']);

            $table->float('male_weight_in_kg');
            $table->float('female_weight_in_kg');

            $table->float('male_calcium');
            $table->float('female_calcium');

            $table->float('male_iron');
            $table->float('female_iron');

            $table->float('male_iodine');
            $table->float('female_iodine');

            $table->float('male_magnesium');
            $table->float('female_magnesium');

            $table->float('male_phosphorus');
            $table->float('female_phosphorus');

            $table->float('male_zinc');
            $table->float('female_zinc');

            $table->float('male_selenium');
            $table->float('female_selenium');

            $table->float('male_fluoride');
            $table->float('female_fluoride');

            $table->float('male_manganese');
            $table->float('female_manganese');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reni_minerals_intake');
    }
};
