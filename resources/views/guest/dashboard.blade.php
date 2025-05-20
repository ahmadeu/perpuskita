@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Koleksi Buku</h2>
        <form class="d-flex" method="GET" action="{{ route('dashboard') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari buku..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- Card Buku 1 -->
        <div class="col">
            <div class="card h-100">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Cover Buku">
                <div class="card-body">
                    <h5 class="card-title">Pemrograman Web</h5>
                    <p class="card-text text-muted">Penulis: John Doe</p>
                    <p class="card-text">Buku tentang dasar-dasar pemrograman web modern.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary">Teknologi</span>
                        <small class="text-muted">Tersedia: 5</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Buku 2 -->
        <div class="col">
            <div class="card h-100">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Cover Buku">
                <div class="card-body">
                    <h5 class="card-title">Database Management</h5>
                    <p class="card-text text-muted">Penulis: Jane Smith</p>
                    <p class="card-text">Panduan lengkap tentang manajemen database.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">Database</span>
                        <small class="text-muted">Tersedia: 3</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Buku 3 -->
        <div class="col">
            <div class="card h-100">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Cover Buku">
                <div class="card-body">
                    <h5 class="card-title">Algoritma & Struktur Data</h5>
                    <p class="card-text text-muted">Penulis: Robert Johnson</p>
                    <p class="card-text">Konsep dasar algoritma dan struktur data.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-info">Komputer</span>
                        <small class="text-muted">Tersedia: 7</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Buku 4 -->
        <div class="col">
            <div class="card h-100">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Cover Buku">
                <div class="card-body">
                    <h5 class="card-title">Machine Learning</h5>
                    <p class="card-text text-muted">Penulis: Sarah Williams</p>
                    <p class="card-text">Pengantar machine learning untuk pemula.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-warning">AI</span>
                        <small class="text-muted">Tersedia: 2</small>
                    </div>
                </div>
            </div>
        </div>
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
