@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Semua Informasi</h2>
    <form action="{{ route('informasi.updateAll') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @foreach([
                'profil' => 'Profil', 
                'standar-pelayanan' => 'Standar Pelayanan', 
                'waktu-pelayanan' => 'Waktu Pelayanan', 
                'pustakawan' => 'Pustakawan'] as $slug => $label)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <label class="form-label"><b>{{ $label }}</b></label>
                            <input type="text" name="judul_{{ $slug }}" class="form-control mb-2" value="{{ $data[$slug]->judul ?? $label }}" placeholder="Judul {{ $label }}">
                            <textarea name="konten_{{ $slug }}" class="form-control mb-2" rows="4">{{ $data[$slug]->konten ?? '' }}</textarea>
                            <label class="form-label">Gambar (opsional)</label>
                            <input type="file" name="gambar_{{ $slug }}" class="form-control mb-2">
                            @if(!empty($data[$slug]->gambar))
                                <div class="mb-2">
                                    <img src="{{ asset('storage/informasi/' . $data[$slug]->gambar) }}" alt="Gambar {{ $label }}" style="max-width:100%; max-height:120px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Simpan Semua</button>
    </form>
</div>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection 