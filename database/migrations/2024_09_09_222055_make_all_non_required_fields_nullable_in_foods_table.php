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
        Schema::table('foods', function (Blueprint $table) {
            $table->integer('calories')->nullable()->change();
            $table->char('calories_unit')->nullable()->change();
            $table->char('target_age_group')->nullable()->change();
            $table->char('origin_country')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->integer('calories')->nullable(false)->change();
            $table->char('calories_unit')->nullable(false)->change();
            $table->char('target_age_group')->nullable(false)->change();
            $table->char('origin_country')->nullable(false)->change();
        });
    }
};
