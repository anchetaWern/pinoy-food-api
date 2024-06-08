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
        Schema::table('food_nutrients', function (Blueprint $table) {
            $table->float('amount')->nullable()->change();
            $table->char('unit')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_nutrients', function (Blueprint $table) {
            $table->float('amount')->nullable(false)->change();
            $table->char('unit')->nullable(false)->change();
        });
    }
};
