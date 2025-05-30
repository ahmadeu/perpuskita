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
Route::get('/guest/books/{book}', [AksesController::class, 'showGuestBook'])->name('guest.books.show');

Route::get('/guest', [AksesController::class, 'guest'])->name('dashboard');
// Halaman landing page

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('web');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('web');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // User routes
    Route::middleware('userAkses:user')->group(function () {
        Route::get('/user', [AksesController::class, 'user'])->name('user');
        Route::get('/user/books/{book}', [AksesController::class, 'showBook'])->name('user.book.detail');
        Route::get('/user/borrowings', [BorrowingController::class, 'indexUser'])->name('user.borrowings');
        Route::get('/user/borrowings/{borrowing}', [BorrowingController::class, 'show'])->name('user.borrowing.detail');
        Route::get('/user/books/{book}/borrow', [BorrowingController::class, 'create'])->name('user.borrowings.create');
        Route::post('/user/borrowings', [BorrowingController::class, 'store'])->name('user.borrowings.store');
    });

    // Admin routes
    Route::middleware('userAkses:admin')->group(function () {
        Route::get('/admin', [AksesController::class, 'index'])->name('admin');
        Route::resource('/admin/users', UserController::class);
        Route::resource('/admin/categories', CategoryController::class);
        Route::resource('/admin/books', BookController::class);
        Route::resource('/admin/borrowings', BorrowingController::class);
        Route::post('borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->name('borrowings.return');
    });
});

// Guest routes
