<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Import class File untuk hapus gambar

class MovieController extends Controller
{
    /**
     * Menampilkan halaman depan (homepage) dengan beberapa film terbaru.
     */
    public function homepage()
    {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }

    /**
     * Menampilkan halaman tabel data untuk admin/staff.
     */
    public function index()
    {
        $movies = Movie::with('category')->latest()->get();
        return view('movies.index', compact('movies'));
    }

    /**
     * Menampilkan form untuk membuat data movie baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create_movie', compact('categories'));
    }

    /**
     * Menyimpan data movie baru ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'synopsis' => 'nullable',
        'category_id' => 'required|exists:categories,id',
        'year' => 'required|digits:4|integer',
        'actors' => 'nullable',
        // Pastikan nama input file Anda 'cover', bukan 'cover_image'
        'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Upload cover image
    $coverName = null;
    if ($request->hasFile('cover')) {
        $coverName = time() . '.' . $request->cover->extension();
        $request->cover->move(public_path('covers'), $coverName);
    }

    // Simpan data ke database
    Movie::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'synopsis' => $request->synopsis,
        'category_id' => $request->category_id,
        'year' => $request->year,
        'actors' => $request->actors,
        // Pastikan nama kolom di database Anda 'cover_image'
        'cover_image' => $coverName,
    ]);

    // INI DIA PERBAIKANNYA: Arahkan ke halaman tabel data
    return redirect()->route('movies.index')->with('success', 'Movie berhasil ditambahkan!');
}

    /**
     * Menampilkan detail satu movie.
     */
    public function show(Movie $movie)
    {
        return view('show', compact('movie'));
    }

    /**
     * Menampilkan form untuk mengedit data movie.
     */
    public function edit(Movie $movie)
    {
        $categories = Category::all();
        return view('edit_movie', compact('movie', 'categories'));
    }

    /**
     * Memperbarui data movie di database.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|max:255|unique:movies,title,' . $movie->id,
            'synopsis' => 'required',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|digits:4|integer',
            'actors' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $coverName = $movie->cover_image;

        if ($request->hasFile('cover_image')) {
            if ($movie->cover_image && File::exists(public_path('covers/' . $movie->cover_image))) {
                File::delete(public_path('covers/' . $movie->cover_image));
            }
            $coverName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('covers'), $coverName);
        }

        $movie->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'synopsis' => $request->synopsis,
            'category_id' => $request->category_id,
            'year' => $request->year,
            'actors' => $request->actors,
            'cover_image' => $coverName,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie berhasil diperbarui!');
    }

    /**
     * Menghapus data movie dari database.
     */
    public function destroy(Movie $movie)
    {
        if ($movie->cover_image && File::exists(public_path('covers/' . $movie->cover_image))) {
            File::delete(public_path('covers/' . $movie->cover_image));
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie berhasil dihapus!');
    }
}
