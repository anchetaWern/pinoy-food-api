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
        Schema::table('reni_macronutrient_distribution', function (Blueprint $table) {
            $table->enum('age_type', ['month', 'year'])->default('year')->after('age_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reni_macronutrient_distribution', function (Blueprint $table) {
            $table->dropColumn('age_type');
        });
    }
};
