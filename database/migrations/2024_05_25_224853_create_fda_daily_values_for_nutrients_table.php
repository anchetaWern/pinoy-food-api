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
        Schema::create('fda_daily_values_for_nutrients', function (Blueprint $table) {
            $table->id();
            $table->string('nutrient');
            $table->float('daily_value');
            $table->char('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fda_daily_values_for_nutrients');
    }
};
