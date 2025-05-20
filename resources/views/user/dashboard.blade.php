@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Koleksi Buku</h2>
        <form class="d-flex" method="GET" action="{{ route('user') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari buku..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @forelse($books as $book)
            <div class="col">
                <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                    <div class="card h-100">
                        <img src="{{ $book->cover_url ?? 'https://via.placeholder.com/300x400' }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $book->title }}</h5>
                            <p class="card-text text-muted">Penulis: {{ $book->author }}</p>
                            <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                                <small class="text-muted">Tersedia: {{ $book->stock }}</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Tidak ada buku yang tersedia.
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .badge {
        font-size: 0.8rem;
        padding: 0.5em 1em;
    }
</style>
@endsection