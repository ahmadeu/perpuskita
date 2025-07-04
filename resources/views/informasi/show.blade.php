@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>{{ $informasi->judul }}</h2>
    <div>{!! $informasi->konten !!}</div>
</div>
@endsection 