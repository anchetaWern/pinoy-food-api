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
        Schema::table('food_uploads', function (Blueprint $table) {
            $table->text('ingredients_image')->nullable()->after('nutrition_label_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_uploads', function (Blueprint $table) {
            $table->dropColumn('ingredients_image');
        });
    }
};
