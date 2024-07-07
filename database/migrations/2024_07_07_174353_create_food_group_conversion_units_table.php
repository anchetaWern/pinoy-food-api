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
        Schema::create('food_group_conversion_units', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('food_group_id'); // from food_groups table
            $table->bigInteger('conversion_unit_id'); // from conversion_units table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_group_conversion_units');
    }
};
