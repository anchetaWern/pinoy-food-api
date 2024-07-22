<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class NutriScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nutri-Score Categories
        $categories = [
            ['name' => 'Energy', 'is_positive' => false],
            ['name' => 'Simple Sugars', 'is_positive' => false],
            ['name' => 'Saturated Fats', 'is_positive' => false],
            ['name' => 'Sodium', 'is_positive' => false],
            ['name' => 'Fruits & Vegetables', 'is_positive' => true],
            ['name' => 'Fiber', 'is_positive' => true],
            ['name' => 'Protein', 'is_positive' => true],
        ];

        DB::table('nutriscore_categories')->insert($categories);

        // Fetch category IDs
        $categoryIds = DB::table('nutriscore_categories')->pluck('id', 'name');

        // Nutri-Score Points
        $points = [
            // Energy (kcal per 100g for non-beverages)
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 0, 'max_value' => 80, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 80, 'max_value' => 160, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 160, 'max_value' => 240, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 240, 'max_value' => 320, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 320, 'max_value' => 400, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 400, 'max_value' => 480, 'points' => 5],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 480, 'max_value' => 560, 'points' => 6],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 560, 'max_value' => 640, 'points' => 7],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 640, 'max_value' => 720, 'points' => 8],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 720, 'max_value' => 800, 'points' => 9],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'unspecified', 'min_value' => 800, 'max_value' => null, 'points' => 10],

            // Energy (kcal per 100ml for beverages)
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 0, 'max_value' => 7.2, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 0, 'max_value' => 7.2, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 7.2, 'max_value' => 14.3, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 14.3, 'max_value' => 21.5, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 21.5, 'max_value' => 28.5, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 28.6, 'max_value' => 35.9, 'points' => 5],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 35.9, 'max_value' => 43, 'points' => 6],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 43, 'max_value' => 50.2, 'points' => 7],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 50.2, 'max_value' => 57.4, 'points' => 8],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 57.4, 'max_value' => 64.5, 'points' => 9],
            ['nutriscore_category_id' => $categoryIds['Energy'], 'food_type' => 'beverage', 'min_value' => 64.5, 'max_value' => null, 'points' => 10],

            // Simple Sugars (g per 100g for non-beverages)
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 0, 'max_value' => 4.5, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 4.5, 'max_value' => 9, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 9, 'max_value' => 13.5, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 13.5, 'max_value' => 18, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 18, 'max_value' => 22.5, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 22.5, 'max_value' => 27, 'points' => 5],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 27, 'max_value' => 31, 'points' => 6],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 31, 'max_value' => 36, 'points' => 7],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 36, 'max_value' => 40, 'points' => 8],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 40, 'max_value' => 45, 'points' => 9],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'unspecified', 'min_value' => 45, 'max_value' => null, 'points' => 10],

            // Simple Sugars (g per 100ml for beverages)
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 0, 'max_value' => 0, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 0, 'max_value' => 1.5, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 1.5, 'max_value' => 3, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 3, 'max_value' => 4.5, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 4.5, 'max_value' => 6, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 6, 'max_value' => 7.5, 'points' => 5],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 7.5, 'max_value' => 9, 'points' => 6],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 9, 'max_value' => 10.5, 'points' => 7],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 10.5, 'max_value' => 12, 'points' => 8],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 12, 'max_value' => 13.5, 'points' => 9],
            ['nutriscore_category_id' => $categoryIds['Simple Sugars'], 'food_type' => 'beverage', 'min_value' => 13.5, 'max_value' => null, 'points' => 10],

            // Fruits, Vegetables, and Nuts (% by weight)
            ['nutriscore_category_id' => $categoryIds['Fruits & Vegetables'], 'food_type' => 'unspecified', 'min_value' => 0, 'max_value' => 40, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Fruits & Vegetables'], 'food_type' => 'unspecified', 'min_value' => 40, 'max_value' => 60, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Fruits & Vegetables'], 'food_type' => 'unspecified', 'min_value' => 60, 'max_value' => 80, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Fruits & Vegetables'], 'food_type' => 'unspecified', 'min_value' => 80, 'max_value' => null, 'points' => 5],

            // Saturated Fats (g per 100g for non-cooking fats)
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 0, 'max_value' => 1, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 1, 'max_value' => 2, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 2, 'max_value' => 3, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 3, 'max_value' => 4, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 4, 'max_value' => 5, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 5, 'max_value' => 6, 'points' => 5],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 6, 'max_value' => 7, 'points' => 6],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 7, 'max_value' => 8, 'points' => 7],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 8, 'max_value' => 9, 'points' => 8],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 9, 'max_value' => 10, 'points' => 9],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'unspecified', 'min_value' => 10, 'max_value' => null, 'points' => 10],

            // Saturated Fats (g per 100g for cooking fats)
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 0, 'max_value' => 10, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 10, 'max_value' => 16, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 16, 'max_value' => 22, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 22, 'max_value' => 28, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 28, 'max_value' => 34, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 34, 'max_value' => 40, 'points' => 5],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 40, 'max_value' => 46, 'points' => 6],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 46, 'max_value' => 52, 'points' => 7],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 52, 'max_value' => 58, 'points' => 8],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 58, 'max_value' => 64, 'points' => 9],
            ['nutriscore_category_id' => $categoryIds['Saturated Fats'], 'food_type' => 'cooking_fat', 'min_value' => 64, 'max_value' => null, 'points' => 10],

            // Sodium (mg per 100g or 100ml)
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 0, 'max_value' => 90, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 90, 'max_value' => 180, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 180, 'max_value' => 270, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 270, 'max_value' => 360, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 360, 'max_value' => 450, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 450, 'max_value' => 540, 'points' => 5],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 540, 'max_value' => 630, 'points' => 6],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 630, 'max_value' => 720, 'points' => 7],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 720, 'max_value' => 810, 'points' => 8],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 810, 'max_value' => 900, 'points' => 9],
            ['nutriscore_category_id' => $categoryIds['Sodium'], 'food_type' => 'unspecified', 'min_value' => 900, 'max_value' => null, 'points' => 10],

            // Fiber (g per 100g or 100ml)
            ['nutriscore_category_id' => $categoryIds['Fiber'], 'food_type' => 'unspecified', 'min_value' => 0, 'max_value' => 0.7, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Fiber'], 'food_type' => 'unspecified', 'min_value' => 0.7, 'max_value' => 1.4, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Fiber'], 'food_type' => 'unspecified', 'min_value' => 1.4, 'max_value' => 2.1, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Fiber'], 'food_type' => 'unspecified', 'min_value' => 2.1, 'max_value' => 2.8, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Fiber'], 'food_type' => 'unspecified', 'min_value' => 2.8, 'max_value' => 3.5, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Fiber'], 'food_type' => 'unspecified', 'min_value' => 3.5, 'max_value' => null, 'points' => 5],

            // Protein (g per 100g or 100ml)
            ['nutriscore_category_id' => $categoryIds['Protein'], 'food_type' => 'unspecified', 'min_value' => 0, 'max_value' => 1.6, 'points' => 0],
            ['nutriscore_category_id' => $categoryIds['Protein'], 'food_type' => 'unspecified', 'min_value' => 1.6, 'max_value' => 3.2, 'points' => 1],
            ['nutriscore_category_id' => $categoryIds['Protein'], 'food_type' => 'unspecified', 'min_value' => 3.2, 'max_value' => 4.8, 'points' => 2],
            ['nutriscore_category_id' => $categoryIds['Protein'], 'food_type' => 'unspecified', 'min_value' => 4.8, 'max_value' => 6.4, 'points' => 3],
            ['nutriscore_category_id' => $categoryIds['Protein'], 'food_type' => 'unspecified', 'min_value' => 6.4, 'max_value' => 8, 'points' => 4],
            ['nutriscore_category_id' => $categoryIds['Protein'], 'food_type' => 'unspecified', 'min_value' => 8, 'max_value' => null, 'points' => 5],
        ];

        DB::table('nutriscore_points')->insert($points);
    }
}
