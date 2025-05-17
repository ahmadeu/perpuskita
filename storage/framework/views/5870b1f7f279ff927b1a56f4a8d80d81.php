

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Koleksi Buku</h2>
        <form class="d-flex" method="GET" action="<?php echo e(route('dashboard')); ?>">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari buku..." value="<?php echo e(request('search')); ?>">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($popularBooks->count()): ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Total Dipinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $popularBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($book->title); ?></td>
                                    <td><?php echo e($book->category->name ?? '-'); ?></td>
                                    <td><?php echo e($book->borrows_count); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center text-muted py-4">
                    <i class="bi bi-info-circle" style="font-size: 1.5rem;"></i><br>
                    Tidak ada data buku.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\perpuskita\resources\views/user/dashboard.blade.php ENDPATH**/ ?>