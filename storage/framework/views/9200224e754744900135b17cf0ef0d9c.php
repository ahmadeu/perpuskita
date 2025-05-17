<?php $__env->startSection('title', 'Perpustakaan UMKU'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?php echo e(asset('images/library.png')); ?>');
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 100px 0;
        margin-top: -24px;
    }
    
    .feature-card {
        transition: transform 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
    }
    
    .book-card {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
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
        background-color: #f8f9fa;
        padding: 80px 0;
    }
    
    .stat-item {
        text-align: center;
        padding: 30px 20px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #0d6efd;
    }
    
    .cta-section {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        padding: 80px 0;
        color: #fff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Perpustakaan Universitas Muhammadiyah Kudus</h1>
        <p class="lead mb-5">Rumah bagi jiwa-jiwa yang haus akan pengetahuan. Di antara rak buku yang menjulang, tersembunyi untaian hikmah yang siap dipetik</p>
        <?php if(auth()->guard()->guest()): ?>
            <div class="mt-4">
                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary btn-lg me-3">
                    <i class="fas fa-sign-in-alt me-2"></i> Go To Dashboard
                </a>
            </div>
        <?php else: ?>
            <div class="mt-4">
                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-tachometer-alt me-2"></i> Go to Dashboard
                </a>
            </div>
        <?php endif; ?>
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
                    <h3 class="fs-2 fw-bold"><?php echo e($totalBooks); ?></h3>
                    <p class="mb-0">Jumlah Buku</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="fs-2 fw-bold"><?php echo e($totalMembers); ?></h3>
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

<!-- Recent Books Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Recent Books</h2>
        <div class="row g-4">
            <?php $__currentLoopData = $recentBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-lg-2">
                <div class="card book-card">
                    <?php if($book->cover_image): ?>
                        <img src="<?php echo e(asset('storage/' . $book->cover_image)); ?>" class="card-img-top book-cover" alt="<?php echo e($book->title); ?>">
                    <?php else: ?>
                        <div class="card-img-top book-cover d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-book fa-3x text-muted"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e(Str::limit($book->title, 20)); ?></h5>
                        <p class="card-text text-muted"><?php echo e($book->author); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Book Categories</h2>
        <div class="row g-4">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card feature-card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo e($category->name); ?></h5>
                        <p class="card-text text-muted">Code: <?php echo e($category->code); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial">
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
                                    <h5 class="fw-bold">Sarah Johnson</h5>
                                    <p class="text-muted">School Librarian</p>
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
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center">
        <h2 class="mb-4">Ready to streamline your library management?</h2>
        <p class="lead mb-5">Start managing your library efficiently with our comprehensive system</p>
        <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-light btn-lg">Get Started Today</a>
        <?php else: ?>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-light btn-lg">Go to Dashboard</a>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        // Initialize Bootstrap carousel
        var testimonialCarousel = new bootstrap.Carousel(document.getElementById('testimonialCarousel'), {
            interval: 5000
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\perpuskita\resources\views/welcome.blade.php ENDPATH**/ ?>