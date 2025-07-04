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
        font-size: 15px;
    }
    
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/gedungumku.jpg') }}');
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 60px 0;
        margin-top: -18px;
    }
    .hero-section h1 {
        font-size: 2.1rem;
    }
    .hero-section .lead {
        font-size: 1.05rem;
    }
    
    .feature-card {
        transition: transform 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        font-size: 0.97rem;
        padding: 1.1rem 0.7rem;
    }
    
    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .book-card {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 0.97rem;
        padding: 1.1rem 0.7rem;
    }
    
    .book-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.09);
    }
    
    .book-cover {
        height: 140px;
        object-fit: cover;
        border-radius: 6px;
    }
    
    .testimonial {
        background-color: rgba(248, 249, 250, 0.8);
        backdrop-filter: blur(10px);
        padding: 50px 0;
    }
    
    .stat-item {
        text-align: center;
        padding: 18px 10px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
        font-size: 0.97rem;
    }
    
    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .stat-icon {
        font-size: 2.1rem;
        margin-bottom: 10px;
        color: #008000;
    }
    
    .cta-section {
        background: linear-gradient(135deg, rgba(0, 128, 0, 0.9), rgba(0, 100, 0, 0.9));
        backdrop-filter: blur(10px);
        padding: 40px 0;
        color: #fff;
        border-radius: 12px;
        margin: 14px 0;
    }
    
    /* Custom button styling */
    .btn-primary {
        background-color: #008000 !important;
        border-color: #008000 !important;
        border: none;
        border-radius: 16px;
        padding: 8px 18px;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 128, 0, 0.18);
    }
    
    .btn-primary.btn-lg {
        font-size: 1.08rem;
        padding: 10px 22px;
        border-radius: 18px;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 128, 0, 0.22);
        background-color: #006400 !important;
        border-color: #006400 !important;
    }
    
    .btn-light {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 8px 18px;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #008000;
    }
    
    .btn-light.btn-lg {
        font-size: 1.08rem;
        padding: 10px 22px;
        border-radius: 18px;
    }
    
    .btn-light:hover {
        transform: translateY(-1px);
        background: rgba(255, 255, 255, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    /* Section styling */
    .py-5 {
        padding: 32px 0;
    }
    
    .bg-light {
        background: rgba(248, 249, 250, 0.8) !important;
        backdrop-filter: blur(10px);
    }
    
    /* Card styling improvements */
    .card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .card-body {
        padding: 1.1rem;
        font-size: 0.97rem;
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

<!-- Features Section (REPLACED) -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-2" style="font-weight: 500; letter-spacing: 1px;">AYO BERGABUNG DENGAN <span style="color:#008000;">PERPUSTAKAAN</span><span style="color:#0073cf;">UMKU</span></h2>
        <div class="text-center mb-5" style="font-size: 1.1rem; color: #222;">Keuntungan Menjadi Anggota Perpustakaan</div>
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="mb-3">
                    <!-- Icon/illustration -->
                    <div style="font-size:70px; color:#2196f3;">
                        <img src="/images/icons8-internet-100.png" alt="akses koleksi" style="height:65px;">
                    </div>
                </div>
                <div style="font-weight:600;">Akses ke berbagai koleksi<br>menarik yang bisa dipinjam</div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <img src="https://img.icons8.com/clouds/100/000000/conference-call.png" alt="komunitas aktif" style="height:90px;">
                </div>
                <div style="font-weight:600;">Mengenal dan berkontribusi<br>kemajuan dunia literasi</div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <img src="https://img.icons8.com/clouds/100/000000/megaphone.png" alt="informasi menarik" style="height:90px;">
                </div>
                <div style="font-weight:600;">Dapatkan berbagai informasi<br>menarik</div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <img src="https://img.icons8.com/clouds/100/000000/prize.png" alt="kegiatan menarik" style="height:90px;">
                </div>
                <div style="font-weight:600;">Mendapatkan pengalaman<br>meminjam buku lebih mudah<br>dan menyenangkan</div>
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