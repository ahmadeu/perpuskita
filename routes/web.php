<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AksesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', [AksesController::class, 'guest'])->name('dashboard');
// Halaman landing page

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AksesController::class, 'index'])->name('admin')->middleware('role:admin');
    Route::get('/user', [AksesController::class, 'user'])->middleware('role:user');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Admin Routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', UserController::class);
        Route::resource('books', BookController::class);
    });
});