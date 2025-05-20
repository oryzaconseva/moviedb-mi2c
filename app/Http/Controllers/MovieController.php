<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Menampilkan semua movie di homepage
    public function homepage()
    {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }

    // Menampilkan detail dari satu movie
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('show', compact('movie'));
    }
}
