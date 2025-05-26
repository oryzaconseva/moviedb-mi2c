<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get(' /', [MovieController::class, 'homepage']);

Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/create-movies', [MovieController::class, 'create'])->name('movies.create');

Route::post('/create-movies', [MovieController::class, 'store'])->name('movies.store');


