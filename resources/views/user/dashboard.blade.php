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

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-2">
        @forelse($books as $book)
            <div class="col">
                <a href="{{ route('user.book.detail', $book->id) }}" class="text-decoration-none">
                    <div class="card h-100 book-card">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img" alt="{{ $book->title }}">
                        @else
                            <img src="https://via.placeholder.com/300x400" class="card-img" alt="{{ $book->title }}">
                        @endif
                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <h5 class="card-title text-white">{{ $book->title }}</h5>
                            <p class="card-text text-white-50">Penulis: {{ $book->author }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">{{ $book->category->name }}</span>
                                <small class="text-white-50">Tersedia: {{ $book->quantity }}</small>
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

    {{-- <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div> --}}
</div>

<style>
    .book-card {
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .book-card:hover {
        transform: translateY(-5px);
    }
    
    .card-img {
        height: 300px;
        object-fit: cover;
        filter: brightness(0.7);
    }
    
    .card-img-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
        padding: 1.25rem;
    }
    
    .badge {
        font-size: 0.8rem;
        padding: 0.5em 1em;
    }
</style>
@endsection