<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\BookController as AdminBookController;

// Rute Publik (Guest & User)
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Rute untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rute untuk User yang Sudah Login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk membaca buku (sekarang menampilkan view page-flip)
    Route::get('/books/{book}/read', [BookController::class, 'read'])->name('books.read');
    Route::get('/books/{book}/serve', [BookController::class, 'servePdf'])->name('books.serve');

    // Rute untuk fitur favorit
    Route::post('/favorites/toggle/{book}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

// Rute khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('books', AdminBookController::class);
});