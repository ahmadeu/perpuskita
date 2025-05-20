@extends('layouts.app')

@section('title', 'Login - Perpustakaan UMKU')

@section('styles')
<style>
    .login-section {
        min-height: calc(100vh - 300px);
        display: flex;
        align-items: center;
        padding: 40px 0;
    }
    
    .login-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    .login-header {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        color: white;
        padding: 20px;
        border-radius: 15px 15px 0 0;
        text-align: center;
    }
    
    .login-body {
        padding: 30px;
    }
    
    .form-control {
        border-radius: 10px;
        padding: 12px;
        border: 1px solid #ddd;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .btn-login {
        background: linear-gradient(to right, #0d6efd, #0dcaf0);
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        width: 100%;
        margin-top: 20px;
    }
    
    .btn-login:hover {
        background: linear-gradient(to right, #0b5ed7, #0bb6d9);
    }
    
    .login-footer {
        text-align: center;
        margin-top: 20px;
    }
    
    .login-footer a {
        color: #0d6efd;
        text-decoration: none;
    }
    
    .login-footer a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
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
@endsection