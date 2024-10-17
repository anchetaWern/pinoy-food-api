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
        Schema::rename('reni_energy_intake', 'pdri_energy_intake');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('pdri_energy_intake', 'reni_energy_intake');
    }
};