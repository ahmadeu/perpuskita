@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Koleksi Buku</h2>
        <form class="d-flex" method="GET" action="{{ route('dashboard') }}">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari buku..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            @if($popularBooks->count())
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
                            @foreach ($popularBooks as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->category->name ?? '-' }}</td>
                                    <td>{{ $book->borrows_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-4">
                    <i class="bi bi-info-circle" style="font-size: 1.5rem;"></i><br>
                    Tidak ada data buku.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
