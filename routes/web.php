<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodUploadsController;
use App\Http\Controllers\DelayFoodLabelProcessingController;
use App\Http\Controllers\TextRecognitionController;
use App\Http\Controllers\FnriController;
use App\Http\Controllers\FoodLabelUploadListController;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/food-uploads', [FoodLabelUploadListController::class, 'index']);
    Route::get('/food-uploads-data', [FoodLabelUploadListController::class, 'data']);

    Route::get('/foods/create', [FoodUploadsController::class, 'create']);

    Route::get('/read-text', TextRecognitionController::class);
    
    Route::get('/foods/{food}', [FoodUploadsController::class, 'edit']);
    Route::put('/foods/{food}', [FoodUploadsController::class, 'update']);

    Route::get('/foods', [FoodUploadsController::class, 'index']);
  
    Route::post('/foods', [FoodUploadsController::class, 'store']);

    Route::post('/food-labels/delay', [DelayFoodLabelProcessingController::class, 'store']);

    Route::get('/foods-data', [FoodUploadsController::class, 'data']);

});

require __DIR__.'/auth.php';
