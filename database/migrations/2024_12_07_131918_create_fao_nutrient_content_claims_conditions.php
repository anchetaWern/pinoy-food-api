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
        Schema::create('fao_nutrient_content_claims_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('component');
            $table->char('claim');
            $table->char('food_state');
            $table->string('condition');
            $table->enum('condition_type', ['amount', 'percent']); 
           
            $table->bigInteger('additional_condition_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fao_nutrient_content_claims_conditions');
    }
};
