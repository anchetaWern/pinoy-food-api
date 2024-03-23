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
        Schema::create('reni_energy_intake', function (Blueprint $table) {
            $table->id();
            $table->integer('age_from');
            $table->integer('age_to')->nullable();
            $table->float('male_weight');
            $table->float('female_weight');
            $table->integer('male_energy_req_in_kcal');
            $table->integer('female_energy_req_in_kcal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reni_energy_intake');
    }
};
