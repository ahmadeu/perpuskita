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

    <!-- Custom CSS -->
    <style>
        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        /* Navbar Styles */
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

        /* Button Styles */
        .btn-search {
            background-color: #008000;
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-search:hover {
            background-color: #006400;
        }

        /* Form Styles */
        .input-search {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #ccc;
            width: 100%;
        }

        /* Footer Styles */
        footer {
            margin-top: 60px;
        }

        footer h5 {
            font-weight: 600;
        }

        footer p, footer li {
            font-size: 0.95rem;
        }
        
        /* Theme color changes */
        .text-primary {
            color: #008000 !important;
        }
        
        .bg-primary {
            background-color: #008000 !important;
        }
        
        .btn-primary {
            background-color: #008000 !important;
            border-color: #008000 !important;
        }
        
        .btn-primary:hover {
            background-color: #006400 !important;
            border-color: #006400 !important;
        }
    </style>

    @yield('styles')
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light bg-white">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand text-primary" href="#">
                    <img src="/images/lambangumku.png" alt="Logo" style="height: 28px; width: 28px; object-fit: contain; display: inline-block; vertical-align: middle; margin-right: 8px;">
                    <span style="color: #008000; font-weight: 700;">Perpustakaan UMKU</span>
                </a>

                <!-- Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin') ? 'active' : '' }}" href="{{ route('admin') }}">
                                        <i class="fas fa-home"></i> Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                                        <i class="fas fa-book"></i> Buku
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                        <i class="fas fa-users"></i> User
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                        <i class="fas fa-tags"></i> Kategori
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}" href="{{ route('borrowings.index') }}">
                                        <i class="fas fa-book-reader"></i> Peminjaman
                                    </a>
                                </li>
                            @elseif(auth()->user()->role === 'user')
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('user.borrowings') ? 'active' : '' }}" href="{{ route('user.borrowings') }}">
                                        <i class="fas fa-book-reader"></i> Peminjaman Saya
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-right"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        @endguest
                    </ul>
                    
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                @if(request()->routeIs('dashboard'))
                    <div class="mb-3">
                        <a href="{{ route('welcome') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                        </a>
                    </div>
                @endif
                {{-- @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                @if(session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: '{{ session('error') }}',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif --}}
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        @if(auth()->check() && auth()->user()->role === 'user' || !auth()->check())
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
                <p>&copy; {{ date('Y') }} Perpustakaan UMKU. All rights reserved.</p>
            </div>
        </footer>
        @endif
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

      <!-- Select2 CSS dan JS -->
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('scripts')
</body>
</html>
