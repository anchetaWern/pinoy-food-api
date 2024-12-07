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
        Schema::create('fao_nutrient_conditions_reference_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('claim_id');
            $table->bigInteger('reference_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fao_nutrient_conditions_reference_values');
    }
};
