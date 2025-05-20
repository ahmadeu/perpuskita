<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AksesController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // User routes
    Route::middleware('userAkses:user')->group(function () {
        Route::get('/user', [AksesController::class, 'user'])->name('user');
        Route::get('/user/books/{book}', [AksesController::class, 'showBook'])->name('user.books.show');
        Route::post('/user/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    });

    // Admin routes
    Route::middleware('userAkses:admin')->group(function () {
        Route::get('/admin', [AksesController::class, 'index'])->name('admin');
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('books', BookController::class);
        Route::resource('borrowings', BorrowingController::class);
        Route::post('borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->name('borrowings.return');
    });
});