@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Peminjaman</h5>
                    <div>
                        <a href="{{ route('borrowings.printAll') }}" target="_blank" class="btn btn-info me-2">
                            <i class="fas fa-print"></i> Cetak Laporan
                        </a>
                        <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Peminjaman
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    {{-- @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif --}}

                        <div class="mb-3">
                            <form method="GET" action="{{ route('borrowings.index') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari nama peminjam, judul buku, atau status..."
                                        value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>
                                        Cari</button>
                                </div>
                            </form>
                        </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Peminjam</th>
                                    <th>Buku</th>
                                    <th>Oleh</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Jam Pengambilan</th>
                                    <th>Status</th>
                                    <th>Catatan User</th>
                                    <th>Catatan Admin</th>
                                    <th>Denda</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowings as $borrowing)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $borrowing->user->name }}</td>
                                        <td>{{ $borrowing->book->title }}</td>
                                        <td>{{ $borrowing->admin ? 'Admin: ' . $borrowing->admin->name : '-' }}</td>
                                        <td>{{ $borrowing->borrow_date ? $borrowing->borrow_date->format('d/m/Y') : '-' }}
                                        </td>
                                        <td>{{ $borrowing->due_date ? $borrowing->due_date->format('d/m/Y') : '-' }}
                                        </td>
                                        <td>
                                                @if ($borrowing->pickup_time)
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
                                                @if ($borrowing->status === 'pending')
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
                                        <td>
                                            {{ $borrowing->user_notes ?: '-' }}
                                        </td>
                                        <td>
                                            {{ $borrowing->notes ?: '-' }}
                                        </td>
                                        <td>
                                                @php
                                                    $u_denda = 1000;
                                                    $tgl1 = \Carbon\Carbon::now();
                                                    $tgl2 = $borrowing->due_date ? \Carbon\Carbon::parse($borrowing->due_date) : null;
                                                    $selisih = ($tgl2) ? $tgl2->diffInDays($tgl1, false) : 0;
                                                    
                                                    // Pastikan selisih adalah integer dan positif
                                                    $selisih = max(0, (int) floor($selisih));
                                                    $denda = 0;
                                                    
                                                    // Hanya hitung denda untuk peminjaman yang sudah disetujui dan belum dikembalikan
                                                    if ($borrowing->status !== 'pending' && $borrowing->status !== 'rejected' && $selisih > 0) {
                                                        $denda = $selisih * $u_denda;
                                                    }
                                                @endphp
                                                @if ($borrowing->status === 'pending' || $borrowing->status === 'rejected' || $borrowing->status === 'returned')
                                                    -
                                                @elseif ($selisih <= 0)
                                                    <span class="badge bg-primary">Masa Peminjaman</span>
                                            @else
                                                    <span class="badge bg-danger">
                                                        Rp. {{ number_format($denda, 0, ',', '.') }}
                                                    </span>
                                                    <br> Terlambat : {{ $selisih }} Hari
                                            @endif
                                        </td>
                                        <td>
                                                @if ($borrowing->status === 'borrowed' || $borrowing->status === 'overdue')
                                                    <form action="{{ route('borrowings.return', $borrowing) }}"
                                                        method="POST" class="d-inline return-form">
                                                    @csrf
                                                        <button type="button" class="btn btn-sm btn-success btn-return">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                            @endif
                                                <a href="{{ route('borrowings.edit', $borrowing) }}"
                                                    class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                                <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST"
                                                    class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                            <td colspan="12" class="text-center">Tidak ada data peminjaman</td>
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
    <h6> *Note
		<br> Masa peminjaman buku adalah <span class="text-danger fw-bold">7 hari</span> dari tanggal peminjaman.
		<br> Jika buku dikembalikan lebih dari masa peminjaman, maka akan dikenakan <span class="text-danger fw-bold">denda</span>
		<br> sebesar <span class="text-danger fw-bold">Rp 1.000/hari</span>.
	</h6>
</div>
@endsection 

@section('scripts')
<x-js.modalConfirHapusPeminjaman />
<x-js.modalSuccesError />
@endsection
