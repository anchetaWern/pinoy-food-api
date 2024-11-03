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
        Schema::create('serving_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('long_name')->nullable();
            $table->float('weight')->nullable();
            $table->char('weight_unit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serving_units');
    }
};
