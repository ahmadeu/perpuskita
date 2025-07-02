@extends('layouts.welcome')

@section('title', 'Perpustakaan UMKU')

@section('styles')
<style>
    body {
        background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('{{ asset('images/gedungumku.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
    
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/gedungumku.jpg') }}');
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 100px 0;
        margin-top: -24px;
    }
    
    .feature-card {
        transition: transform 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    .book-card {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .book-cover {
        height: 200px;
        object-fit: cover;
    }
    
    .testimonial {
        background-color: rgba(248, 249, 250, 0.8);
        backdrop-filter: blur(10px);
        padding: 80px 0;
    }
    
    .stat-item {
        text-align: center;
        padding: 30px 20px;
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    .stat-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #008000;
    }
    
    .cta-section {
        background: linear-gradient(135deg, rgba(0, 128, 0, 0.9), rgba(0, 100, 0, 0.9));
        backdrop-filter: blur(10px);
        padding: 80px 0;
        color: #fff;
        border-radius: 20px;
        margin: 20px 0;
    }
    
    /* Custom button styling */
    .btn-primary {
        background-color: #008000 !important;
        border-color: #008000 !important;
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 128, 0, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 128, 0, 0.4);
        background-color: #006400 !important;
        border-color: #006400 !important;
    }
    
    .btn-light {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #008000;
    }
    
    .btn-light:hover {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Section styling */
    .py-5 {
        padding: 60px 0;
    }
    
    .bg-light {
        background: rgba(248, 249, 250, 0.8) !important;
        backdrop-filter: blur(10px);
    }
    
    /* Card styling improvements */
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    /* Theme color changes */
    .text-primary {
        color: #008000 !important;
    }
    
    .bg-primary {
        background-color: #008000 !important;
    }
    
    /* Icon color changes */
    .fa-book, .fa-users, .fa-exchange-alt {
        color: #008000 !important;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Perpustakaan Universitas Muhammadiyah Kudus</h1>
        <p class="lead mb-5">Rumah bagi jiwa-jiwa yang haus akan pengetahuan. Di antara rak buku yang menjulang, tersembunyi untaian hikmah yang siap dipetik</p>
            <div class="mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg me-3">
                    <i class="fas fa-sign-in-alt me-2"></i> Go To Books
                </a>
            </div>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </a>
            </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="fs-2 fw-bold">{{ $totalBooks }}</h3>
                    <p class="mb-0">Jumlah Buku</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="fs-2 fw-bold">{{ $totalMembers }}</h3>
                    <p class="mb-0">Anggota Terdaftar</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Fitur</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-book fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title">Manajemen Buku</h4>
                        <p class="card-text">Easily add, update, and track all books in your library with detailed information.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title">Informasi Anggota</h4>
                        <p class="card-text">Manage library members with registration, profile updates, and membership tracking.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-exchange-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title">Sistem Peminjaman</h4>
                        <p class="card-text">Handle book borrowing and returns with due date tracking and fine calculation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
{{-- <section class="testimonial">
    <div class="container">
        <h2 class="text-center mb-5">What Our Users Say</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-center">
                                    <p class="lead mb-4">"This system has transformed how we manage our school library. It's user-friendly and saves us so much time!"</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-center">
                                    <p class="lead mb-4">"The borrowing system and overdue tracking has helped us reduce lost books by 45%. Highly recommended!"</p>
                                    <h5 class="fw-bold">Michael Chen</h5>
                                    <p class="text-muted">Public Library Director</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-center">
                                    <p class="lead mb-4">"Comprehensive reports and analytics help us make better decisions about our collection development."</p>
                                    <h5 class="fw-bold">Amanda Torres</h5>
                                    <p class="text-muted">University Librarian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center">
        <h2 class="mb-4">Ready to streamline your library management?</h2>
        <p class="lead mb-5">Start managing your library efficiently with our comprehensive system</p>
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">Get Started Today</a>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize Bootstrap carousel
        var testimonialCarousel = new bootstrap.Carousel(document.getElementById('testimonialCarousel'), {
            interval: 5000
        });
    });
</script>
@endsection