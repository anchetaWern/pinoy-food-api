<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PDRIEnergyIntakeController;
use App\Http\Controllers\PDRIMacronutrientDistributionController;
use App\Http\Controllers\PDRIMacronutrientIntakeController;
use App\Http\Controllers\PDRIVitaminIntakeController;
use App\Http\Controllers\PDRIMineralIntakeController;
use App\Http\Controllers\PDRIAverageRequirementsController;
use App\Http\Controllers\PDRIUpperLimitsController;
use App\Http\Controllers\ConsolidatedRecommendedDailyNutrientIntakeController;

use App\Http\Controllers\FoodLabelUploadController;
use App\Http\Controllers\FdaDailyValuesForNutrientsController;
use App\Http\Controllers\FoodTypesController;
use App\Http\Controllers\FoodIngredientsController;
use App\Http\Controllers\NutriscoreController;
use App\Http\Controllers\BulkUploadController;
use App\Http\Controllers\AdditivesController;
use App\Http\Controllers\AdditiveFunctionsController;

use App\Http\Controllers\ReniVitaminIntakeController;
use App\Http\Controllers\ReniMineralIntakeController;

use App\Http\Controllers\CustomServingsController;
use App\Http\Controllers\FAONutrientContentClaimsController;
use App\Http\Controllers\FirebaseAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/firebase-auth/sync', [FirebaseAuthController::class, 'sync']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['throttle:30,1', 'optional.verify_key'])->group(function () {
    // Routes that should have a rate limit of 5 requests per minute

    Route::resource('foods', FoodController::class);
    Route::get('pdri-recommended-energy-intake', PDRIEnergyIntakeController::class);
    Route::get('pdri-macro-intake-distribution', PDRIMacronutrientDistributionController::class);
    Route::get('pdri-recommended-macro-intake', PDRIMacronutrientIntakeController::class);
    Route::get('pdri-recommended-vitamin-intake', PDRIVitaminIntakeController::class);
    Route::get('pdri-recommended-mineral-intake', PDRIMineralIntakeController::class);
    Route::get('pdri-avg-requirements', PDRIAverageRequirementsController::class);
    Route::get('pdri-upper-limits', PDRIUpperLimitsController::class);

    Route::get('consolidated-recommended-daily-nutrient-intake', ConsolidatedRecommendedDailyNutrientIntakeController::class);
    Route::get('fda-daily-nutrient-values', FdaDailyValuesForNutrientsController::class);

    Route::get('food-types', FoodTypesController::class);

    Route::get('food-ingredients/{food}', FoodIngredientsController::class);

    Route::get('nutriscore/{food}', NutriscoreController::class);

    Route::resource('additives', AdditivesController::class);
    Route::resource('additive-function', AdditiveFunctionsController::class);

    Route::get('reni-vitamin-intake', ReniVitaminIntakeController::class);
    Route::get('reni-mineral-intake', ReniMineralIntakeController::class);

    Route::get('custom-servings/{custom_serving_category}', CustomServingsController::class);

    Route::get('fao-nutrient-content-claims', FAONutrientContentClaimsController::class);
});

Route::middleware('required.verify_key')->group(function () {
    Route::post('food-labels', FoodLabelUploadController::class);
    Route::post('bulk-upload', BulkUploadController::class);
});
