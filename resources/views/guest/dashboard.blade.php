@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Koleksi Buku</h2>
        <form class="d-flex" method="GET" action="{{ route('dashboard') }}">
            <select name="category" class="form-select me-2" style="width: 200px;" data-theme="green">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="search" class="form-control me-2" placeholder="Cari buku..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-search">Cari</button>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-2">
        @forelse($books as $book)
            <div class="col">
                <a href="{{ route('guest.books.show', $book->id) }}" class="text-decoration-none">
                    <div class="card h-100 book-card">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img" alt="{{ $book->title }}">
                        @else
                            <div class="card-img default-cover d-flex flex-column justify-content-center align-items-center">
                                <i class="fas fa-book fa-4x mb-3"></i>
                                <h5 class="text-center px-2"></h5>
                            </div>
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
    
    .default-cover {
        background: linear-gradient(135deg, #2c3e50, #008000);
        color: white;
        text-align: center;
        padding: 1rem;
    }
    
    .default-cover i {
        color: rgba(255, 255, 255, 0.8);
    }

    .form-select {
        border-radius: 0.375rem;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    .form-select:focus {
        border-color: #008000;
        box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
    }
    
    .btn-search {
        background-color: #008000;
        border: 1px solid #008000;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-search:hover {
        background-color: #006400;
        border-color: #006400;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 128, 0, 0.3);
    }

    @media (max-width: 768px) {
        .d-flex {
            flex-direction: column;
            gap: 10px;
        }
        .form-select, .form-control {
            width: 100% !important;
        }
    }

    /* Dropdown options styling */
    .form-select option:checked {
        background-color: #008000;
        color: white;
    }
    
    .form-select option:hover {
        background-color: #006400;
        color: white;
    }
    
    .form-select option:focus {
        background-color: #008000;
        color: white;
    }
</style>
@endsection