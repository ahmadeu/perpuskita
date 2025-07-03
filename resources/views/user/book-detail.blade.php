@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Sisi Kiri - Sampul Buku -->
                        <div class="col-md-4 col-lg-4">
                            <div class="text-center">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="book-cover-detail" alt="{{ $book->title }}">
                                @else
                                    <div class="book-cover-detail default-cover d-flex flex-column justify-content-center align-items-center">
                                        <i class="fas fa-book fa-5x mb-3"></i>
                                        <h4 class="text-center px-2">{{ $book->title }}</h4>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Sisi Kanan - Informasi Detail Buku -->
                        <div class="col-md-8 col-lg-8">
                            <div class="book-info">
                                <h2 class="book-title mb-4">{{ $book->title }}</h2>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <p class="text-muted mb-1">Penulis</p>
                                            <p class="h5">{{ $book->author }}</p>
                                        </div>
                                        <div class="info-item mb-3">
                                            <p class="text-muted mb-1">Kategori</p>
                                            <p class="h5">{{ $book->category->name }}</p>
                                        </div>
                                        <div class="info-item mb-3">
                                            <p class="text-muted mb-1">ISBN</p>
                                            <p class="h5">{{ $book->isbn }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item mb-3">
                                            <p class="text-muted mb-1">Status</p>
                                            <p class="h5">
                                                @if($book->quantity > 0)
                                                    <span class="badge bg-success">Tersedia ({{ $book->quantity }})</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Tersedia</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="info-item mb-3">
                                            <p class="text-muted mb-1">Penerbit</p>
                                            <p class="h5">{{ $book->publisher ?? '-' }}</p>
                                        </div>
                                        <div class="info-item mb-3">
                                            <p class="text-muted mb-1">Tahun Terbit</p>
                                            <p class="h5">{{ $book->publish_year ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="description-section mb-4">
                                    <p class="text-muted mb-2">Deskripsi</p>
                                    <p class="text-justify">{{ $book->description }}</p>
                                </div>
                                
                                <div class="action-buttons">
                                    <div class="d-flex flex-wrap gap-2">
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
                                            <div class="d-flex flex-wrap align-items-center gap-2">
                                                <div class="alert alert-info mb-0">
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
            </div>
        </div>
    </div>
</div>

<style>
    .book-cover-detail {
        max-height: 500px;
        width: auto;
        max-width: 100%;
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        border-radius: 12px;
        transition: transform 0.3s ease;
    }
    
    .book-cover-detail:hover {
        transform: scale(1.02);
    }
    
    .default-cover {
        background: linear-gradient(135deg, #2c3e50, #008000);
        color: white;
        text-align: center;
        padding: 2rem;
        min-height: 500px;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    
    .default-cover i {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .card {
        border: none;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        border-radius: 16px;
        overflow: hidden;
    }
    
    .book-title {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.8rem;
        border-bottom: 3px solid #008000;
        padding-bottom: 10px;
    }
    
    .info-item {
        padding: 8px 0;
    }
    
    .info-item p.text-muted {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-item p.h5 {
        color: #2c3e50;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0;
    }
    
    .description-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #008000;
    }
    
    .description-section p.text-muted {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }
    
    .text-justify {
        text-align: justify;
        line-height: 1.6;
        font-size: 0.9rem;
    }
    
    .action-buttons {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .action-buttons .btn {
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .action-buttons .btn-primary {
        background: linear-gradient(135deg, #008000, #006400);
        border: none;
        box-shadow: 0 4px 8px rgba(0, 128, 0, 0.3);
        color: white;
    }
    
    .action-buttons .btn-primary:hover {
        background: linear-gradient(135deg, #006400, #004d00);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 128, 0, 0.4);
        color: white;
    }
    
    .action-buttons .btn-secondary {
        background: linear-gradient(135deg, #95a5a6, #7f8c8d);
        border: none;
        box-shadow: 0 4px 8px rgba(149, 165, 166, 0.3);
        color: white;
    }
    
    .action-buttons .btn-secondary:hover {
        background: linear-gradient(135deg, #7f8c8d, #6c7b7d);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(149, 165, 166, 0.4);
        color: white;
    }
    
    .gap-2 {
        gap: 0.5rem !important;
    }
    
    .alert {
        font-size: 0.85rem;
        padding: 0.75rem 1rem;
        border-radius: 6px;
    }
    
    @media (max-width: 768px) {
        .book-cover-detail {
            max-height: 300px;
        }
        
        .default-cover {
            min-height: 300px;
        }
        
        .book-title {
            font-size: 1.4rem;
        }
        
        .action-buttons .btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .action-buttons .d-flex {
            flex-direction: column;
        }
        
        .action-buttons .alert {
            margin-bottom: 10px;
        }
    }
</style>
@endsection
@section('scripts')
@if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection 