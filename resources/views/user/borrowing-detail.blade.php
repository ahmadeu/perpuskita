@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Detail Peminjaman</h5>
                </div>

                <div class="card-body">
                    <div class="book-info mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                @if($borrowing->book->cover_image)
                                    <img src="{{ asset('storage/' . $borrowing->book->cover_image) }}" class="img-fluid rounded" alt="{{ $borrowing->book->title }}">
                                @else
                                    <img src="https://via.placeholder.com/300x400" class="img-fluid rounded" alt="{{ $borrowing->book->title }}">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $borrowing->book->title }}</h4>
                                <p class="text-muted">Penulis: {{ $borrowing->book->author }}</p>
                                <p class="text-muted">ISBN: {{ $borrowing->book->isbn }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="borrowing-details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Tanggal Pengajuan</p>
                                    <p class="h5">{{ $borrowing->request_date->format('d/m/Y') }}</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Tanggal Pinjam</p>
                                    <p class="h5">{{ $borrowing->borrow_date ? $borrowing->borrow_date->format('d/m/Y') : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Status</p>
                                    <p class="h5">
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
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Tanggal Kembali</p>
                                    <p class="h5">{{ $borrowing->due_date ? $borrowing->due_date->format('d/m/Y') : '-' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($borrowing->user_notes)
                            <div class="mb-3">
                                <p class="text-muted mb-1">Catatan Anda</p>
                                <p class="h5">{{ $borrowing->user_notes }}</p>
                            </div>
                        @endif

                        @if($borrowing->notes)
                            <div class="mb-3">
                                <p class="text-muted mb-1">Catatan Admin</p>
                                <p class="h5">{{ $borrowing->notes }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('user.borrowings') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .book-info img {
        max-height: 200px;
        width: auto;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endsection 