<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Perpustakaan UMKU'); ?></title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS Inline -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        .navbar {
            padding-top: 1rem;
            padding-bottom: 1rem;
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

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand text-primary" href="<?php echo e(url('/')); ?>">
                    <i class="fas fa-book-reader me-2"></i> Perpustakaan UMKU
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto">
                        <?php if(auth()->guard()->check()): ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('books.index')); ?>"><i class="fas fa-book me-1"></i> Buku</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('members.index')); ?>"><i class="fas fa-users me-1"></i> Anggota</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('categories.index')); ?>"><i class="fas fa-tags me-1"></i> Kategori</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('borrows.index')); ?>"><i class="fas fa-exchange-alt me-1"></i> Peminjaman</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="fas fa-chart-bar me-1"></i> Laporan
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo e(route('reports.borrows')); ?>">Laporan Peminjaman</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('reports.overdue')); ?>">Laporan Terlambat</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav">
                        <?php if(auth()->guard()->guest()): ?>
                        
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-1"></i> <?php echo e(Auth::user()->name); ?>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                           <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                <?php echo $__env->yieldContent('content'); ?>
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
                    </div>
                </div>
                <hr class="my-4">
                <p>&copy; <?php echo e(date('Y')); ?> Perpustakaan UMKU. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\perpuskita\resources\views/layouts/app.blade.php ENDPATH**/ ?>