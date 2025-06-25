@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Peminjaman</h5>
                    </div>
                    <div class="card-body">
                        {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                        <form action="{{ route('borrowings.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="book_id" class="form-label">Pilih Buku</label>
                                <select name="book_id" id="book_id"
                                    class="form-control @error('book_id') is-invalid @enderror" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}"
                                            {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                            {{ $book->title }} (Stok: {{ $book->quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="user_id" class="form-label">Pilih Peminjam</label>
                                <select name="user_id" id="user_id"
                                    class="form-control @error('user_id') is-invalid @enderror" required>
                                    <option value="">Pilih Peminjam</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="borrow_date" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control @error('borrow_date') is-invalid @enderror"
                                    id="borrow_date" name="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}"
                                    required>
                                @error('borrow_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                                    id="due_date" name="due_date"
                                    value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}" required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const borrowInput = document.getElementById('borrow_date');
                                    const dueInput = document.getElementById('due_date');
                                    borrowInput.addEventListener('change', function() {
                                        if (borrowInput.value) {
                                            const borrowDate = new Date(borrowInput.value);
                                            borrowDate.setDate(borrowDate.getDate() + 7);
                                            const yyyy = borrowDate.getFullYear();
                                            const mm = String(borrowDate.getMonth() + 1).padStart(2, '0');
                                            const dd = String(borrowDate.getDate()).padStart(2, '0');
                                            dueInput.value = `${yyyy}-${mm}-${dd}`;
                                        }
                                    });
                                });
                            </script>

                            <div class="mb-3">
                                <label for="pickup_time" class="form-label">Jam Pengambilan</label>
                                <select name="pickup_time" id="pickup_time"
                                    class="form-control @error('pickup_time') is-invalid @enderror" required>
                                    <option value="">Pilih Jam Pengambilan</option>
                                    <option value="08:00" {{ old('pickup_time') == '08:00' ? 'selected' : '' }}>08:00 -
                                        09:00</option>
                                    <option value="10:00" {{ old('pickup_time') == '10:00' ? 'selected' : '' }}>10:00 -
                                        11:00</option>
                                    <option value="13:00" {{ old('pickup_time') == '13:00' ? 'selected' : '' }}>13:00 -
                                        15:00</option>
                                </select>
                                @error('pickup_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Catatan Admin</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                                <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <x-js.modalSuccesError />
@endsection
