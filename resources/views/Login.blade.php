@extends('layouts.login')

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
            padding: 0;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .login-header {
            background: linear-gradient(to right, #008000, #006400);
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
            border: 1px solid #008000;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 128, 0, 0.25);
        }

        .btn-login {
            background: linear-gradient(to right, #008000, #006400);
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            width: 100%;
            margin-top: 15px;
            color: #fff;
        }

        .btn-login:hover {
            background: linear-gradient(to right, #006400, #004d00);
        }

        .login-footer {
            text-align: center;
            margin-top: 15px;
            padding: 10px 0;
        }

        .login-footer a {
            color: #008000;
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

        .btn-green {
            background: linear-gradient(90deg, #008000 0%, #006400 100%) !important;
            color: #fff !important;
            border: none !important;
        }
        .btn-green:hover {
            background: linear-gradient(90deg, #006400 0%, #004d00 100%) !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('content')
    <div class="login-section">
        <div class="container">
            @if (request()->routeIs('login'))
                <div class="mb-3">
                    <a href="{{ route('welcome') }}" class="btn btn-primary btn-green">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            @endif
            
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card login-card animate__animated animate__fadeInDown">
                        <div class="text-center mb-3">
                            <img src="{{ asset('images/lambangumku.png') }}" alt="Logo" style="width: 80px;">
                        </div>
                        <div class="card-header text-center bg-gradient-primary">
                            <h4 class="mb-0 login-title" style="color: #fff;">Login Perpustakaan</h4>
                            <small class="text-muted" style="color: #fff !important;">Selamat datang, silakan login untuk melanjutkan</small>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
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
                                    <div class="d-flex align-items-center position-relative">
                                        <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror"
                                               id="password" name="password" placeholder="Password" required>
                                        <span class="position-absolute" style="right: 15px; cursor: pointer;" onclick="togglePassword()">
                                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                


                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gradient-primary btn-login">
                                        <i class="fas fa-sign-in-alt me-2"></i> Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animasi dan gradient -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #008000 0%, #006400 100%);
            color: #fff;
            border-radius: 15px 15px 0 0;
            padding: 20px 0 10px 0;
        }

        .btn-gradient-primary {
            background: linear-gradient(90deg, #008000 0%, #006400 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-gradient-primary:hover {
            background: linear-gradient(90deg, #006400 0%, #004d00 100%);
            color: #fff;
        }
    </style>
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
