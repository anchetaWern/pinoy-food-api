<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ReniEnergyIntakeController;
use App\Http\Controllers\ReniMacronutrientDistributionController;
use App\Http\Controllers\ReniMacronutrientIntakeController;
use App\Http\Controllers\ReniVitaminIntakeController;
use App\Http\Controllers\ReniMineralIntakeController;
use App\Http\Controllers\ReniAverageRequirementsController;
use App\Http\Controllers\ReniUpperLimitsController;
use App\Http\Controllers\FoodLabelUploadController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('throttle:30,1')->group(function () {
    // Routes that should have a rate limit of 5 requests per minute

    Route::resource('foods', FoodController::class);
    Route::get('reni-energy-intake', ReniEnergyIntakeController::class);
    Route::get('reni-macro-intake-distribution', ReniMacronutrientDistributionController::class);
    Route::get('reni-recommended-macro-intake', ReniMacronutrientIntakeController::class);
    Route::get('reni-recommended-vitamin-intake', ReniVitaminIntakeController::class);
    Route::get('reni-recommended-mineral-intake', ReniMineralIntakeController::class);
    Route::get('reni-avg-requirements', ReniAverageRequirementsController::class);
    Route::get('reni-upper-limits', ReniUpperLimitsController::class);
});

Route::post('food-labels', FoodLabelUploadController::class);