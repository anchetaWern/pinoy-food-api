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
        Schema::rename('reni_upper_limits', 'pdri_upper_limits');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('pdri_upper_limits', 'reni_upper_limits');
    }
};
