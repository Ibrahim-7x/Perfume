<?php

use App\Http\Controllers\Admin\PerfumeController as AdminPerfumeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Frontend\PerfumeController as FrontendPerfumeController;
use App\Http\Controllers\Frontend\ReviewController as FrontendReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Customer View Routes
Route::view('/customer', 'customer')->name('customer');
Route::view('/about', 'about')->name('about');
Route::view('/perfumes', 'all-perfumes')->name('perfumes.all');
Route::view('/admin-panel', 'admin')->name('admin');

// Frontend API Routes (public)
Route::prefix('api')->group(function () {
    Route::get('/perfumes', [FrontendPerfumeController::class, 'index']);
    Route::get('/perfumes/featured', [FrontendPerfumeController::class, 'featured']);
    Route::get('/perfumes/bestsellers', [FrontendPerfumeController::class, 'bestsellers']);
    Route::get('/perfumes/by-temperature', [FrontendPerfumeController::class, 'byTemperature']);
    Route::get('/perfumes/{id}', [FrontendPerfumeController::class, 'show']);
    Route::get('/reviews', [FrontendReviewController::class, 'index']);
});

// Admin Routes (requires authentication for page access)
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin.dashboard');
    
    // Admin Panel Page
    Route::get('/admin-panel', function () {
        return view('admin');
    })->name('admin');
});

// Admin API routes - no additional auth needed since page requires login
Route::post('/admin/perfumes', [AdminPerfumeController::class, 'apiStore']);
Route::put('/admin/perfumes/{perfume}', [AdminPerfumeController::class, 'apiUpdate']);
Route::delete('/admin/perfumes/{perfume}', [AdminPerfumeController::class, 'apiDestroy']);

// Home route
Route::get('/', function () {
    return view('customer');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes (requires authentication)
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
Route::post('/password/update', [AuthController::class, 'updatePassword'])->name('password.update')->middleware('auth');

// Check admin status API
Route::get('/api/check-admin', [AuthController::class, 'checkAdmin']);

// User authentication status API
Route::get('/api/user', function() {
    if (Auth::check()) {
        return response()->json([
            'authenticated' => true,
            'user' => [
                'id' => Auth::id(),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ]
        ]);
    }
    return response()->json(['authenticated' => false]);
});

// Admin Stats API
Route::get('/api/admin/stats', [DashboardController::class, 'stats']);
