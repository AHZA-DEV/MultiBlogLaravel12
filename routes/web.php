<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/post/{slug}', [WelcomeController::class, 'show'])->name('post.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/posts', [DashboardController::class, 'posts'])->name('dashboard.posts');
    Route::get('/dashboard/tags', [DashboardController::class, 'tags'])->name('dashboard.tags');
    
    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users');
        Route::get('/dashboard/categories', [DashboardController::class, 'categories'])->name('dashboard.categories');
    });
});
