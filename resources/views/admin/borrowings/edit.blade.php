@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Peminjaman</h5>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Peminjam</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="">Pilih Peminjam</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $borrowing->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="book_id" class="form-label">Buku</label>
                            <select class="form-select @error('book_id') is-invalid @enderror" id="book_id" name="book_id" required>
                                <option value="">Pilih Buku</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} ({{ $book->isbn }})
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="borrow_date" class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control @error('borrow_date') is-invalid @enderror" id="borrow_date" name="borrow_date" value="{{ old('borrow_date', $borrowing->borrow_date ? $borrowing->borrow_date->format('Y-m-d') : '') }}" required>
                            @error('borrow_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="due_date" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', $borrowing->due_date ? $borrowing->due_date->format('Y-m-d') : '') }}" required>
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="return_date" class="form-label">Tanggal Dikembalikan</label>
                            <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ old('return_date', $borrowing->return_date ? $borrowing->return_date->format('Y-m-d') : '') }}">
                            @error('return_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $borrowing->status) == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="approved" {{ old('status', $borrowing->status) == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="borrowed" {{ old('status', $borrowing->status) == 'borrowed' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="returned" {{ old('status', $borrowing->status) == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="rejected" {{ old('status', $borrowing->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                <option value="overdue" {{ old('status', $borrowing->status) == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $borrowing->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 