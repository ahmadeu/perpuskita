@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Informasi</h2>
    <form action="{{ route('informasi.update', $informasi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ $informasi->slug }}" required>
        </div>
        <div class="mb-3">
            <label for="konten" class="form-label">Konten</label>
            <textarea name="konten" class="form-control" id="konten" rows="8">{{ $informasi->konten }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
@section('scripts')
<!-- WYSIWYG editor (TinyMCE CDN) -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: '#konten',
  plugins: 'lists link image table code',
  toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code',
  menubar: false
});
</script>
@endsection 