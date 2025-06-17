@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="mb-4">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="lead text-muted">Anda login sebagai Administrator</p>
                    <div class="mt-4">
                        <i class="fas fa-user-shield fa-3x text-primary mb-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Umum -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Buku</h6>
                            <h2 class="mb-0">{{ $totalBooks }}</h2>
                        </div>
                        <i class="fas fa-book fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Pengguna</h6>
                            <h2 class="mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Peminjaman Aktif</h6>
                            <h2 class="mb-0">{{ $activeBorrowings }}</h2>
                        </div>
                        <i class="fas fa-book-reader fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Keterlambatan</h6>
                            <h2 class="mb-0">{{ $lateReturnsCount }}</h2>
                        </div>
                        <i class="fas fa-exclamation-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Peminjaman Terbaru -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Peminjaman Terbaru</h5>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBorrowings as $borrowing)
                                <tr>
                                    <td>{{ $borrowing->user->name }}</td>
                                    <td>{{ $borrowing->book->title }}</td>
                                    <td>{{ $borrowing->borrow_date ? $borrowing->borrow_date->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if($borrowing->status === 'pending')
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @elseif($borrowing->status === 'approved')
                                            <span class="badge bg-info">Disetujui</span>
                                        @elseif($borrowing->status === 'borrowed')
                                            <span class="badge bg-primary">Dipinjam</span>
                                        @elseif($borrowing->status === 'returned')
                                            <span class="badge bg-success">Dikembalikan</span>
                                        @elseif($borrowing->status === 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @elseif($borrowing->status === 'overdue')
                                            <span class="badge bg-danger">Terlambat</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data peminjaman</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Populer -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Buku Populer</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Total Dipinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularBooks as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $book->total_borrowed }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Stok Menipis</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStockBooks as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>
                                        <span class="badge bg-danger">{{ $book->quantity }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Keterlambatan</h6>
                            <h2 class="mb-0">{{ $lateReturnsCount }}</h2>
                        </div>
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <div class="mt-2">
                        <small>Total Denda: Rp {{ number_format($totalLateFee, 0, ',', '.') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin-bottom: 1rem;
    }
    
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
    }
    
    .badge {
        padding: 0.5em 0.75em;
    }
</style>
@endsection
