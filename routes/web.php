<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes - Versi Final Paling Stabil
|--------------------------------------------------------------------------
| Aturan:
| - Staff: Bisa Tambah & Lihat Detail. Tombol lain non-aktif.
| - Admin: Bisa Semua.
*/

// == RUTE PUBLIK ==
Route::get('/', [MovieController::class, 'homepage'])->name('homepage');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// == RUTE BUTUH LOGIN (STAFF & ADMIN) ==
Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

    // Rute untuk menampilkan form tambah & memprosesnya
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
});


// == RUTE AKSI KHUSUS ADMIN SAJA ==
Route::middleware(['auth', RoleAdmin::class])->group(function () {
    // Aksi Edit, Update, dan Delete hanya untuk Admin
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});


// == RUTE DENGAN PARAMETER {MOVIE} DI PALING BAWAH ==
// Diletakkan di sini untuk menghindari konflik dengan /movies/create
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
