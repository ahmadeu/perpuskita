<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AuthController; // Tambahkan ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman landing page
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

// Halaman dashboard publik
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Katalog Buku (akses publik)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Autentikasi default Laravel (untuk user umum)
Auth::routes();

// Login Admin (form dan aksi login)
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

// Grup route khusus admin (butuh auth dan role admin)
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('members', MemberController::class);
    Route::resource('books', BookController::class)->except(['index', 'show']);
    Route::resource('categories', CategoryController::class);
    Route::get('/reports/borrows', [BorrowController::class, 'report'])->name('reports.borrows');
    Route::get('/reports/overdue', [BorrowController::class, 'overdueReport'])->name('reports.overdue');
});

// Grup route peminjaman hanya untuk user login
Route::middleware(['auth'])->group(function () {
    Route::resource('borrows', BorrowController::class);
    Route::get('/borrows/{borrow}/return', [BorrowController::class, 'showReturnForm'])->name('borrows.return');
    Route::post('/borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrows.process-return');
});
