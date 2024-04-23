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
            $table->string('barcode_image')->nullable()->after('servings_per_container');
            $table->string('nutrition_label_image')->after('servings_per_container');
            $table->string('title_image')->after('servings_per_container');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn('barcode_image');
            $table->dropColumn('title_image');
            $table->dropColumn('nutrition_label_image');
        });
    }
};
