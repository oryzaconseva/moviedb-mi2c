<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes - Versi Final
|--------------------------------------------------------------------------
*/

// == RUTE PUBLIK (TIDAK BUTUH LOGIN) ==
Route::get('/', [MovieController::class, 'homepage'])->name('homepage');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// == RUTE BUTUH LOGIN (UMUM UNTUK ADMIN & STAFF) ==
Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

    // Staff BISA Tambah Movie
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

    // Staff BISA Lihat Detail
    Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

    // Staff BISA Hapus
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});


// == RUTE KHUSUS HANYA UNTUK ADMIN (EDIT & UPDATE) ==
Route::middleware(['auth', RoleAdmin::class])->group(function () {
    // Staff TIDAK BISA Edit & Update
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
});
