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
        Schema::table('serving_units', function (Blueprint $table) {
            $table->float('volume_in_ml')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('serving_units', function (Blueprint $table) {
            $table->dropColumn('volume_in_ml');
        });
    }
};
