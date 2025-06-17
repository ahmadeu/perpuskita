@extends('layouts.app')

@section('title', 'Login - Perpustakaan UMKU')

@section('styles')
<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .login-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }
    
    .login-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 450px;
        margin: 0 auto;
    }
    
    .login-header {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        color: white;
        padding: 15px;
        border-radius: 15px 15px 0 0;
        text-align: center;
    }
    
    .login-body {
        padding: 20px;
    }
    
    .form-control {
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #ddd;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .btn-login {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        width: 100%;
        margin-top: 15px;
    }
    
    .btn-login:hover {
        background: linear-gradient(to right, #0b5ed7, #0bb6d9);
    }
    
    .login-footer {
        text-align: center;
        margin-top: 15px;
        padding: 10px 0;
    }
    
    .login-footer a {
        color: #0d6efd;
        text-decoration: none;
    }
    
    .login-footer a:hover {
        text-decoration: underline;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }

    .card-header {
        padding: 15px;
    }

    .card-body {
        padding: 20px;
    }
</style>
@endsection

@section('content')
<div class="login-section">
    <div class="container">
        @if(request()->routeIs('login'))
            <div class="mb-3">
                <a href="{{ route('welcome') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        @endif
        <div class="row justify-content-center">
        <div class="col-md-6">
                <div class="card login-card">
                <div class="card-header">
                    <h4 class="mb-0">Login</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="login" class="form-label">NIM atau Email</label>
                            <input type="text" class="form-control @error('login') is-invalid @enderror" 
                                   id="login" name="login" value="{{ old('login') }}" 
                                   placeholder="Masukkan NIM atau Email" required>
                            @error('login')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection