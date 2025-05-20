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
<div class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card login-card">
                    <div class="login-header">
                        <h3 class="mb-0"><i class="fas fa-book-reader me-2"></i>Login Perpustakaan UMKU</h3>
                    </div>

                    <div class="login-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>

                            <div class="login-footer">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
