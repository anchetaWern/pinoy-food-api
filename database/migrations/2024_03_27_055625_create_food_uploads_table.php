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
        Schema::create('food_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('title_image');
            $table->string('title');

            $table->string('barcode_image')->nullable();
            $table->string('barcode')->nullable();

            $table->string('nutrition_label_image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_uploads');
    }
};
