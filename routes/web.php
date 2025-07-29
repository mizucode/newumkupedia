<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\PemanfaatController; 


// Rute Publik (Guest & User)
Route::get('/', [BookController::class, 'home'])->name('home');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    // Daftar request buku user
    Route::get('/daftar-request', function() {
        $requests = \App\Models\RequestEbook::where('user_id', auth()->id())->latest()->get();
        return view('admin.dashboard.daftarpermintaanebook', compact('requests'));
    })->name('daftarpermintaanebook');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Rute untuk membaca buku (sekarang menampilkan view page-flip)
    Route::get('/books/{book}/read', [BookController::class, 'read'])->name('books.read');
    Route::get('/books/{book}/serve', [BookController::class, 'servePdf'])->name('books.serve');

    // Rute untuk fitur favorit
    Route::post('/favorites/toggle/{book}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorit-book', [FavoriteController::class, 'list'])->name('favorites.list');

    // Rute request ebook (hanya user yang bisa mengisi)
    Route::post('/requestebook', [\App\Http\Controllers\RequestEbookController::class, 'store'])->name('admin.requestebook.store');
    Route::get('/requestebook', function() {
        $requests = \App\Models\RequestEbook::where('user_id', auth()->id())->latest()->get();
        return view('admin.dashboard.requestebook', compact('requests'));
    })->name('admin.requestebook.form');
});

// Rute khusus Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard khusus admin
    Route::get('/dashboard', function() {
        $favoriteBooks = \App\Models\Book::whereHas('favorites')->get();
        return view('admin.dashboard-admin.index', compact('favoriteBooks'));
    })->name('dashboard');

   Route::get('/daftar-request', function() {
        $requests = \App\Models\RequestEbook::latest()->get();
        return view('admin.dashboard-admin.daftarpermintaanebook', compact('requests'));
    })->name('daftarpermintaanebook');
    Route::resource('books', AdminBookController::class);
    Route::resource('pemanfaat', PemanfaatController::class);
    Route::get('/laporan-buku', [LaporanController::class, 'laporanBuku'])->name('laporan.buku');
    Route::get('/laporan-pengguna', [LaporanController::class, 'laporanPengguna'])->name('laporan.pengguna');

});
