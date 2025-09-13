<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/post/{slug}', [WelcomeController::class, 'show'])->name('post.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Posts - accessible by both admin and users
    Route::resource('dashboard/posts', PostController::class)->names([
        'index' => 'dashboard.posts',
        'create' => 'dashboard.posts.create',
        'store' => 'dashboard.posts.store',
        'edit' => 'dashboard.posts.edit',
        'update' => 'dashboard.posts.update',
        'destroy' => 'dashboard.posts.destroy',
    ]);
    
    // Tags - accessible by both admin and users
    Route::resource('dashboard/tags', TagController::class)->names([
        'index' => 'dashboard.tags',
        'create' => 'dashboard.tags.create',
        'store' => 'dashboard.tags.store',
        'edit' => 'dashboard.tags.edit',
        'update' => 'dashboard.tags.update',
        'destroy' => 'dashboard.tags.destroy',
    ]);
    
    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        // Users management
        Route::resource('dashboard/users', UserController::class)->names([
            'index' => 'dashboard.users',
            'create' => 'dashboard.users.create',
            'store' => 'dashboard.users.store',
            'edit' => 'dashboard.users.edit',
            'update' => 'dashboard.users.update',
            'destroy' => 'dashboard.users.destroy',
        ]);
        
        // Categories management
        Route::resource('dashboard/categories', CategoryController::class)->names([
            'index' => 'dashboard.categories',
            'create' => 'dashboard.categories.create',
            'store' => 'dashboard.categories.store',
            'edit' => 'dashboard.categories.edit',
            'update' => 'dashboard.categories.update',
            'destroy' => 'dashboard.categories.destroy',
        ]);
    });
});
