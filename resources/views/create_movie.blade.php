@extends('layouts.template')

@section('content')
    <h1>Form Data Movie</h1>

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-6">
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Synopsis --}}
        <div class="mb-3 row">
            <label for="synopsis" class="col-sm-2 col-form-label">Synopsis</label>
            <div class="col-sm-6">
                <textarea id="synopsis" name="synopsis" class="form-control @error('synopsis') is-invalid @enderror">{{ old('synopsis') }}</textarea>
                @error('synopsis') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Category --}}
        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-6">
                <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option selected disabled>-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Year --}}
        <div class="mb-3 row">
            <label for="year" class="col-sm-2 col-form-label">Year</label>
            <div class="col-sm-6">
                <input type="number" id="year" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year') }}">
                @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Actors --}}
        <div class="mb-3 row">
            <label for="actors" class="col-sm-2 col-form-label">Actors</label>
            <div class="col-sm-6">
                <input type="text" id="actors" name="actors" class="form-control @error('actors') is-invalid @enderror" value="{{ old('actors') }}">
                @error('actors') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Cover Image --}}
        <div class="mb-3 row">
            <label for="cover" class="col-sm-2 col-form-label">Cover Image</label>
            <div class="col-sm-6">
                <input type="file" id="cover" name="cover" class="form-control @error('cover') is-invalid @enderror">
                @error('cover') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Submit --}}
        <div class="mb-3 row">
            <div class="col-sm-6 offset-sm-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
