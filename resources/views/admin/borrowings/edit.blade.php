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
                        {{-- @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif --}}

                        <form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Peminjam</label>
                                <input type="text" class="form-control" value="{{ $borrowing->user->name }} - {{ $borrowing->user->email }}{{ $borrowing->user->nim ? ' (NIM: '.$borrowing->user->nim.')' : '' }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $borrowing->user_id }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Buku</label>
                                <input type="text" class="form-control" value="{{ $borrowing->book->title }} (Stok: {{ $borrowing->book->quantity }}) - {{ $borrowing->book->isbn }}" readonly>
                                <input type="hidden" name="book_id" value="{{ $borrowing->book_id }}">
                            </div>

                            <div class="mb-3">
                                <label for="borrow_date" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control @error('borrow_date') is-invalid @enderror"
                                    id="borrow_date" name="borrow_date"
                                    value="{{ old('borrow_date', $borrowing->borrow_date ? $borrowing->borrow_date->format('Y-m-d') : '') }}"
                                    required>
                                @error('borrow_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="due_date" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                                    id="due_date" name="due_date"
                                    value="{{ old('due_date', $borrowing->due_date ? $borrowing->due_date->format('Y-m-d') : '') }}"
                                    required>
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
                                    <option value="08:00"
                                        {{ old('pickup_time', $borrowing->pickup_time ? $borrowing->pickup_time->format('H:i') : '') == '08:00' ? 'selected' : '' }}>
                                        08:00 - 09:00</option>
                                    <option value="10:00"
                                        {{ old('pickup_time', $borrowing->pickup_time ? $borrowing->pickup_time->format('H:i') : '') == '10:00' ? 'selected' : '' }}>
                                        10:00 - 11:00</option>
                                    <option value="13:00"
                                        {{ old('pickup_time', $borrowing->pickup_time ? $borrowing->pickup_time->format('H:i') : '') == '13:00' ? 'selected' : '' }}>
                                        13:00 - 15:00</option>
                                </select>
                                @error('pickup_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="return_date" class="form-label">Tanggal Dikembalikan</label>
                                <input type="date" class="form-control @error('return_date') is-invalid @enderror"
                                    id="return_date" name="return_date"
                                    value="{{ old('return_date', $borrowing->return_date ? $borrowing->return_date->format('Y-m-d') : '') }}">
                                @error('return_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="pending"
                                        {{ old('status', $borrowing->status) == 'pending' ? 'selected' : '' }}>Menunggu
                                        Persetujuan</option>
                                    <option value="approved"
                                        {{ old('status', $borrowing->status) == 'approved' ? 'selected' : '' }}>Disetujui
                                    </option>
                                    <option value="borrowed"
                                        {{ old('status', $borrowing->status) == 'borrowed' ? 'selected' : '' }}>Dipinjam
                                    </option>
                                    <option value="returned"
                                        {{ old('status', $borrowing->status) == 'returned' ? 'selected' : '' }}>
                                        Dikembalikan</option>
                                    <option value="rejected"
                                        {{ old('status', $borrowing->status) == 'rejected' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="overdue"
                                        {{ old('status', $borrowing->status) == 'overdue' ? 'selected' : '' }}>Terlambat
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Catatan Admin</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $borrowing->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan User</label>
                                <div class="form-control bg-light">
                                    {{ $borrowing->user_notes ?: 'Tidak ada catatan' }}
                                </div>
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

@section('scripts')
    <x-js.pluginSelect2UserBook />

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('borrowings.index') }}";
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
