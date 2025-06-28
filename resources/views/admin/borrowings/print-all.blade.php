<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Semua Peminjaman - Perpustakaan UMKU</title>
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .summary {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }
        .summary-item {
            text-align: center;
        }
        .summary-number {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .summary-label {
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            font-size: 9px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-approved { background-color: #d1ecf1; color: #0c5460; }
        .status-borrowed { background-color: #cce5ff; color: #004085; }
        .status-returned { background-color: #d4edda; color: #155724; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }
        .status-overdue { background-color: #f8d7da; color: #721c24; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
        .page-break {
            page-break-before: always;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PERPUSTAKAAN UMKU</h1>
        <p>Laporan Semua Data Peminjaman Buku</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="summary">
        <h3 style="margin: 0 0 15px 0; text-align: center;">Ringkasan Peminjaman</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-number">{{ $borrowings->count() }}</div>
                <div class="summary-label">Total Peminjaman</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $borrowings->where('status', 'pending')->count() }}</div>
                <div class="summary-label">Menunggu Persetujuan</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $borrowings->whereIn('status', ['borrowed', 'overdue'])->count() }}</div>
                <div class="summary-label">Sedang Dipinjam</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $borrowings->where('status', 'returned')->count() }}</div>
                <div class="summary-label">Sudah Dikembalikan</div>
            </div>
        </div>
        @php
            $totalDenda = 0;
            foreach($borrowings as $borrowing) {
                $u_denda = 1000;
                $tgl1 = \Carbon\Carbon::now();
                $tgl2 = $borrowing->due_date ? \Carbon\Carbon::parse($borrowing->due_date) : null;
                $selisih = ($tgl2) ? $tgl2->diffInDays($tgl1, false) : 0;
                $selisih = max(0, (int) floor($selisih));
                // Hanya hitung denda jika status bukan pending, rejected, returned dan selisih > 0
                if (!in_array($borrowing->status, ['pending', 'rejected', 'returned']) && $selisih > 0) {
                    $totalDenda += $selisih * $u_denda;
                }
            }
        @endphp
        @if($totalDenda > 0)
        <div style="margin-top: 15px; text-align: center; padding: 10px; background: #fff3cd; border-radius: 5px;">
            <div style="font-size: 16px; font-weight: bold; color: #856404;">
                Total Denda: Rp. {{ number_format($totalDenda, 0, ',', '.') }}
            </div>
        </div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Oleh</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Jam Ambil</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ Str::limit($borrowing->book->title, 25) }}</td>
                    <td>{{ $borrowing->admin ? 'Admin: ' . $borrowing->admin->name : '-' }}</td>
                    <td>{{ $borrowing->borrow_date ? $borrowing->borrow_date->format('d/m/Y') : '-' }}</td>
                    <td>{{ $borrowing->due_date ? $borrowing->due_date->format('d/m/Y') : '-' }}</td>
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
                            <span class="status-badge status-pending">Pending</span>
                        @elseif($borrowing->status === 'approved')
                            <span class="status-badge status-approved">Approved</span>
                        @elseif($borrowing->status === 'borrowed')
                            <span class="status-badge status-borrowed">Borrowed</span>
                        @elseif($borrowing->status === 'returned')
                            <span class="status-badge status-returned">Returned</span>
                        @elseif($borrowing->status === 'rejected')
                            <span class="status-badge status-rejected">Rejected</span>
                        @elseif($borrowing->status === 'overdue')
                            <span class="status-badge status-overdue">Overdue</span>
                        @endif
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
                            <span style="font-size: 8px;">Masa Aktif</span>
                        @else
                            <span style="font-size: 8px; color: #dc3545; font-weight: bold;">
                                Rp. {{ number_format($denda, 0, ',', '.') }}
                            </span>
                            <br>
                            <span style="font-size: 7px;">({{ $selisih }} hari)</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($borrowing->notes ?: $borrowing->user_notes ?: '-', 20) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center;">Tidak ada data peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak pada {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Perpustakaan UMKU - Sistem Informasi Perpustakaan</p>
        <p>Total {{ $borrowings->count() }} data peminjaman</p>
    </div>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Cetak Laporan
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
            Tutup
        </button>
    </div>
</body>
</html> 