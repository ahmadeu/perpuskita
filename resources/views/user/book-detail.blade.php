@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-cover-detail" alt="{{ $book->title }}">
                @else
                    <img src="https://via.placeholder.com/300x400" class="book-cover-detail" alt="{{ $book->title }}">
                @endif
            </div>

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">{{ $book->title }}</h2>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <p class="text-muted mb-1">Penulis</p>
                                <p class="h5">{{ $book->author }}</p>
                            </div>
                            <div class="mb-3">
                                <p class="text-muted mb-1">Kategori</p>
                                <p class="h5">{{ $book->category->name }}</p>
                            </div>
                            <div class="mb-3">
                                <p class="text-muted mb-1">ISBN</p>
                                <p class="h5">{{ $book->isbn }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                                <p class="text-muted mb-1">Penerbit</p>
                                <p class="h5">{{ $book->publisher ?? '-' }}</p>
                            </div>
                            <div class="mb-3">
                                <p class="text-muted mb-1">Tahun Terbit</p>
                                <p class="h5">{{ $book->publish_year ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted mb-2">Deskripsi</p>
                        <p class="text-justify">{{ $book->description }}</p>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('user') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                        </a>
                        
                        @auth
                            @if($book->quantity > 0)
                                <a href="{{ route('user.borrowings.create', $book) }}" class="btn btn-primary">
                                    <i class="fas fa-book-reader"></i> Pinjam Buku
                                </a>
                            @else
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-exclamation-circle"></i> Maaf, buku ini sedang tidak tersedia untuk dipinjam.
                                </div>
                            @endif
                        @else
                            <div class="d-flex align-items-center">
                                <div class="alert alert-info mb-0 me-3">
                                    <i class="fas fa-info-circle"></i> Silakan login untuk meminjam buku ini.
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Login untuk Meminjam
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .book-cover-detail {
        max-height: 400px;
        width: auto;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    
    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    
    .text-justify {
        text-align: justify;
    }
</style>
@endsection 