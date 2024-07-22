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
        Schema::create('nutriscore_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nutriscore_category_id')->constrained('nutriscore_categories')->onDelete('cascade');
            $table->string('food_type'); // 'beverage', 'cooking_fat', 'irrelevant'
            $table->float('min_value');
            $table->float('max_value')->nullable();
            $table->integer('points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutriscore_points');
    }
};
