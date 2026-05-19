<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPEDA</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9; /* Warna background abu-abu terang yang lembut */
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .login-header {
            background: #1e1e2d;
            padding: 40px 20px;
            text-align: center;
        }
        .logo-box {
            background: #ffffff;
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #1976d2;
            border-color: #1976d2;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(25, 118, 210, 0.25);
            border-color: #1976d2;
        }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card login-card">

                    <!-- Header Login -->
                    <div class="login-header">
                        <div class="logo-box mb-3">
                            <h2 class="m-0 fw-bolder" style="color: #1976d2;">SP</h2>
                        </div>
                        <h4 class="text-white fw-bold mb-0">Portal Pemuda</h4>
                        <p class="text-white-50 small mb-0 mt-1">Sistem Informasi Pengelolaan Data</p>
                    </div>

                    <!-- Form Login -->
                    <div class="card-body p-4 p-md-5 bg-white">
                        <h5 class="fw-bold mb-4 text-center text-dark">Selamat Datang Kembali!</h5>

                        <!-- Alert Error Global (Opsional) -->
                        @if ($errors->any())
                            <div class="alert alert-danger p-2 mb-4" style="font-size: 0.9rem;">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <!-- Input Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium text-secondary small">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email" class="form-control border-start-0 ps-0 bg-light @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                                </div>
                            </div>

                            <!-- Input Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-medium text-secondary small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="password" class="form-control border-start-0 ps-0 bg-light @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label small text-secondary" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-primary">
                                    Login ke Dashboard <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Footer Text -->
                <div class="text-center mt-4 text-muted small">
                    &copy; {{ date('Y') }} SIPEDA. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
