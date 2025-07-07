<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan UMKU')</title>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
        .navbar {
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
        }
        .nav-link {
            font-weight: 500;
        }
        .btn-search {
            background-color: #f59e0b;
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-search:hover {
            background-color: #d97706;
        }
        .input-search {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #ccc;
            width: 100%;
        }
        footer {
            margin-top: 60px;
        }
        footer h5 {
            font-weight: 600;
        }
        footer p, footer li {
            font-size: 0.95rem;
        }
    </style>

    @yield('styles')
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand text-primary" href="#">
                    <img src="/images/lambangumku.png" alt="Logo" style="height: 28px; width: 28px; object-fit: contain; display: inline-block; vertical-align: middle; margin-right: 8px;">
                    <span style="color: #28a745; font-weight: 700;">Perpustakaan UMKU</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="informasiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-info-circle"></i> Informasi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="informasiDropdown">
                                <li><a class="dropdown-item" href="{{ route('informasi.show', 'profil') }}">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('informasi.show', 'standar-pelayanan') }}">Standar Pelayanan</a></li>
                                <li><a class="dropdown-item" href="{{ route('informasi.show', 'waktu-pelayanan') }}">Waktu Pelayanan</a></li>
                                <li><a class="dropdown-item" href="{{ route('informasi.show', 'pustakawan') }}">Pustakawan</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
        <!-- Footer -->
        <footer class="bg-primary text-white text-center py-5">
            <div class="container">
                <div class="row text-start">
                    <div class="col-md-4 mb-4">
                        <h5>Tentang Kami</h5>
                        <p>Perpustakaan Universitas Muhammadiyah Kudus menyediakan koleksi buku digital untuk mendukung pembelajaran mahasiswa.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5>Jam Operasional</h5>
                        <ul class="list-unstyled">
                            <li>Senin - Kamis: 08.00 - 15.00</li>
                            <li>Jumat: 09.00 - 10:30</li>
                            <li>Sabtu: 09.00 - 17.00</li>
                            <li>Minggu: Tutup</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Kontak</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-map-marker-alt me-2"></i> Jl. Ganesha Raya No. 1, Kudus</li>
                            <li><i class="fas fa-phone me-2"></i> (0291) 437218</li>
                            <li><i class="fas fa-envelope me-2"></i> info@umkulibrary.com</li>
                        </ul>
                        <div class="mt-3">
                            <div class="map-container" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; border-radius: 10px; overflow: hidden; border: 2px solid rgba(255,255,255,0.3);">
                                <iframe src="https://www.google.com/maps?q=Universitas+Muhammadiyah+Kudus,+Jl.+Ganesha+Raya+No.+1,+Kudus,+Jawa+Tengah&hl=id&z=17&output=embed" width="100%" height="100%" style="position:absolute;top:0;left:0;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Lokasi Universitas Muhammadiyah Kudus"></iframe>
                                <a href="https://www.google.com/maps/search/?api=1&query=Universitas+Muhammadiyah+Kudus,+Jl.+Ganesha+Raya+No.+1,+Kudus,+Jawa+Tengah" target="_blank" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:2;" title="Buka di Google Maps"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <p class="mb-0">&copy; 2025 Perpustakaan UMKU. All rights reserved.</p>
            </div>
        </footer>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
