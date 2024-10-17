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
        Schema::table('pdri_average_requirements', function (Blueprint $table) {
            $table->renameColumn('femaale_vitamin_a', 'female_vitamin_a');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pdri_average_requirements', function (Blueprint $table) {
            $table->renameColumn('female_vitamin_a', 'femaale_vitamin_a');
        });
    }
};
