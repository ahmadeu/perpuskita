@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="mb-4">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="lead text-muted">Anda login sebagai Administrator</p>
                    <div class="mt-4">
                        <i class="fas fa-user-shield fa-3x text-primary mb-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
