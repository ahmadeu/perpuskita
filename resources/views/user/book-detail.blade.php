@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded shadow" alt="{{ $book->title }}">
            @else
                <img src="https://via.placeholder.com/300x400" class="img-fluid rounded shadow" alt="{{ $book->title }}">
            @endif
        </div>
        <div class="col-md-8">
            <h2 class="mb-3">{{ $book->title }}</h2>
            <div class="mb-3">
                <p class="text-muted mb-1">Penulis</p>
                <p class="h5">{{ $book->author }}</p>
            </div>
            <div class="mb-3">
                <p class="text-muted mb-1">Kategori</p>
                <p class="h5">{{ $book->category->name }}</p>
            </div>
            <div class="mb-3">
                <p class="text-muted mb-1">Deskripsi</p>
                <p>{{ $book->description }}</p>
            </div>
            <div class="mb-3">
                <p class="text-muted mb-1">Status</p>
                <p class="h5">
                    @if($book->quantity > 0)
                        <span class="badge bg-success">Tersedia ({{ $book->quantity }})</span>
                    @else
                        <span class="badge bg-danger">Tidak Tersedia</span>
                    @endif
                </p>
            </div>
            <div class="mb-3">
                <p class="text-muted mb-1">ISBN</p>
                <p class="h5">{{ $book->isbn }}</p>
            </div>
            
            @if($book->quantity > 0)
                <form action="{{ route('borrowings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-book-reader"></i> Pinjam Buku
                    </button>
                </form>
            @else
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-ban"></i> Tidak Tersedia
                </button>
            @endif
        </div>
    </div>
</div>
@endsection 