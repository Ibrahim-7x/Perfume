<?php

use App\Http\Controllers\Admin\PerfumeController as AdminPerfumeController;
use App\Http\Controllers\Frontend\PerfumeController as FrontendPerfumeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public API Routes - Frontend
Route::prefix('perfumes')->group(function () {
    Route::get('/', [FrontendPerfumeController::class, 'index']);
    Route::get('/featured', [FrontendPerfumeController::class, 'featured']);
    Route::get('/bestsellers', [FrontendPerfumeController::class, 'bestsellers']);
    Route::get('/by-temperature', [FrontendPerfumeController::class, 'byTemperature']);
    Route::get('/{id}', [FrontendPerfumeController::class, 'show']);
});

// Protected API Routes - Admin (require authentication and admin role)
Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin|super_admin'])->group(function () {
    Route::apiResource('perfumes', AdminPerfumeController::class);
    Route::patch('perfumes/{perfume}/toggle-featured', [AdminPerfumeController::class, 'toggleFeatured']);
    Route::patch('perfumes/{perfume}/toggle-bestseller', [AdminPerfumeController::class, 'toggleBestseller']);
    Route::patch('perfumes/{perfume}/toggle-active', [AdminPerfumeController::class, 'toggleActive']);
    Route::delete('perfumes/images/{image}', [AdminPerfumeController::class, 'deleteImage']);
    Route::patch('perfumes/images/{image}/primary', [AdminPerfumeController::class, 'setPrimaryImage']);
});
