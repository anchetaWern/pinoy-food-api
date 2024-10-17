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
        Schema::rename('reni_minerals_intake', 'pdri_minerals_intake');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('pdri_minerals_intake', 'reni_minerals_intake');
    }
};
