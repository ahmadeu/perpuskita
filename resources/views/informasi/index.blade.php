@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Manajemen Informasi</h2>
        <a href="{{ route('informasi.create') }}" class="btn btn-primary">Tambah Informasi</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Slug</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($informasis as $info)
            <tr>
                <td>{{ $info->judul }}</td>
                <td>{{ $info->slug }}</td>
                <td>
                    <a href="{{ route('informasi.edit', $info->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('informasi.destroy', $info->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 