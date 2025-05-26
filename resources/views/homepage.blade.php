@extends('layouts.template')

@section('content')
    <h1>Latest Movie</h1>
    <div class="row">
        @foreach ($movies as $movie)
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">

                        <img src="{{ asset('covers/' . $movie->cover_image) }}" class="img-fluid rounded-start" alt="{{ $movie->title }}">

                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">{{ Str::words($movie->synopsis, 20, '...') }}</p>

                            {{-- Tambahkan tahun di sini --}}
                            <p class="card-text">
                                <small class="text-muted">Year: {{ $movie->year }}</small>
                            </p>

                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-success">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
        {{ $movies->links() }}
    </div>
@endsection


