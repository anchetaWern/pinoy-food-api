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
        Schema::create('reni_upper_limits', function (Blueprint $table) {
            $table->id();

            $table->integer('age_from');
            $table->integer('age_to')->nullable();

            $table->integer('vitamin_a')->nullable();
            $table->integer('vitamin_d')->nullable();
            $table->integer('vitamin_e')->nullable();
            $table->integer('vitamin_niacin')->nullable();
            $table->integer('vitamin_pyridoxine')->nullable();
            $table->integer('folate')->nullable();
            $table->integer('vitamin_c')->nullable();
            $table->integer('iron')->nullable();
            $table->integer('zinc')->nullable();
            $table->integer('selenium')->nullable();
            $table->integer('iodine')->nullable();
            $table->integer('calcium')->nullable();
            $table->integer('magnesium')->nullable();
            $table->integer('phosphorus')->nullable();
            $table->float('fluoride')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reni_upper_limits');
    }
};
