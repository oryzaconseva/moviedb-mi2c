<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'homepage'])->name('homepage');

Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
