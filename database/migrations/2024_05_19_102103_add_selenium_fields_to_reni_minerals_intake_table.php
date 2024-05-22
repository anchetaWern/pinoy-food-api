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
        Schema::table('reni_minerals_intake', function (Blueprint $table) {
            $table->float('female_selenium')->after('female_zinc');
            $table->float('male_selenium')->after('female_zinc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reni_minerals_intake', function (Blueprint $table) {
            $table->dropColumn('male_selenium');
            $table->dropColumn('female_selenium');
        });
    }
};
