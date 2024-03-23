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
        Schema::table('reni_energy_intake', function (Blueprint $table) {
            $table->renameColumn('male_weight', 'male_weight_in_kg');
            $table->renameColumn('female_weight', 'female_weight_in_kg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reni_energy_intake', function (Blueprint $table) {
            $table->renameColumn('male_weight_in_kg', 'male_weight');
            $table->renameColumn('female_weight_in_kg', 'female_weight');
        });
    }
};
