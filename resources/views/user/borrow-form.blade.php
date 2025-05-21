@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Peminjaman Buku</h5>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="book-info mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="img-fluid rounded" alt="{{ $book->title }}">
                                @else
                                    <img src="https://via.placeholder.com/300x400" class="img-fluid rounded" alt="{{ $book->title }}">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $book->title }}</h4>
                                <p class="text-muted">Penulis: {{ $book->author }}</p>
                                <p class="text-muted">ISBN: {{ $book->isbn }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('user.borrowings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                        <div class="mb-3">
                            <label for="user_notes" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control @error('user_notes') is-invalid @enderror" 
                                    id="user_notes" 
                                    name="user_notes" 
                                    rows="3" 
                                    placeholder="Tambahkan catatan jika diperlukan">{{ old('user_notes') }}</textarea>
                            @error('user_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Informasi Peminjaman:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Pengajuan peminjaman akan diverifikasi oleh admin</li>
                                <li>Buku harus diambil dalam waktu 3 hari setelah disetujui</li>
                                <li>Maksimal peminjaman adalah 7 hari</li>
                                <li>Denda keterlambatan Rp 1.000/hari</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.book.detail', $book) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
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