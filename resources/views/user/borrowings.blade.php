@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Peminjaman Saya</h5>
                    <a href="{{ route('user') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Jam Pengambilan</th>
                                    <th>Status</th>
                                    <th>Catatan Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowings as $borrowing)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($borrowing->book->cover_image)
                                                    <img src="{{ asset('storage/' . $borrowing->book->cover_image) }}" 
                                                         class="me-2" 
                                                         style="width: 40px; height: 60px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $borrowing->book->title }}</strong><br>
                                                    <small class="text-muted">{{ $borrowing->book->author }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $borrowing->request_date ? $borrowing->request_date->format('d/m/Y') : '-' }}</td>
                                        <td>{{ $borrowing->borrow_date ? $borrowing->borrow_date->format('d/m/Y') : '-' }}</td>
                                        <td>{{ $borrowing->due_date ? $borrowing->due_date->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            @if($borrowing->pickup_time)
                                                @php
                                                    $timeStr = $borrowing->pickup_time->format('H:i');
                                                    $slotLabel = $pickupSlots[$timeStr] ?? $timeStr;
                                                @endphp
                                                {{ $slotLabel }}
                                            @else
                                                -
                                            @endif
                                        </td>
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
                                        <td>{{ $borrowing->notes ?? '-' }}</td>
                                        <td>
                                            @if($borrowing->status === 'pending')
                                                <form action="{{ route('borrowings.cancel', $borrowing) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-times"></i> Batalkan
                                                    </button>
                                                </form>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada peminjaman</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $borrowings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 