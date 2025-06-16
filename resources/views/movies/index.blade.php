@extends('layouts.template')

@section('content')
<div class="container">
    <h1 class="my-4">Data Movie</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Tambah Movie (bisa diakses staff & admin) --}}
    <a href="{{ route('movies.create') }}" class="btn btn-success mb-3">Tambah Movie</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Year</th>
                    <th scope="col">Actors</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->category->name ?? 'Uncategorized' }}</td>
                        <td>{{ $movie->year }}</td>
                        <td>{{ $movie->actors ?? 'N/A' }}</td>
                        <td>
                            {{-- Tombol Detail (aktif untuk semua) --}}
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info btn-sm">Detail</a>

                            {{-- INI KUNCINYA: Tombol Edit sekarang menjadi link untuk semua,
                                 tapi URL-nya akan dilindungi oleh middleware untuk staff --}}
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            {{-- Tombol Delete (aktif untuk admin dan staff) --}}
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus film ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
