<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan UMKU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: #f5f6fa;
        }
        .login-card {
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            background: #fff;
        }
        .login-title {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container d-flex justify-content-center align-items-start" style="min-height: 100vh;">
        <div style="width:100%; margin-top:80px;">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
</html> 