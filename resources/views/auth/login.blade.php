@php
    // Memanggil data Setting dari database
    $setting = \App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ $setting->nama_instansi ?? 'Portal Pemuda' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f4f8;
            /* Background biru-abu sangat muda */
        }

        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-header {
            /* Tema Biru Dominan Modern */
            background: linear-gradient(135deg, #1e56d6 0%, #1976d2 100%);
            padding: 45px 20px;
            text-align: center;
            position: relative;
        }

        /* Aksen lengkungan dekoratif di header */
        .login-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 40px;
            background: #ffffff;
            border-radius: 50% 50% 0 0;
        }

        .logo-box {
            background: #ffffff;
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 5px;
            position: relative;
            z-index: 2;
        }

        .logo-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e56d6 0%, #1976d2 100%);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(25, 118, 210, 0.3);
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            background-color: #f8fafc;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.15);
            border-color: #1976d2;
            background-color: #ffffff;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
        }
    </style>
</head>

<body class="d-flex align-items-center min-vh-100">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">

                @if (session('success'))
                    <div class="alert alert-success text-center mb-4 rounded-3 border-0 shadow-sm">
                        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="card login-card">
                    <div class="login-header">
                        @if ($setting && $setting->logo_instansi)
                            <img src="{{ asset($setting->logo_instansi) }}" alt="Logo" style="max-width: 80%" class="mb-3">
                        @else
                            <div class="logo-box mb-3">
                                {{-- Implementasi Logo Setting --}}
                                <h2 class="m-0 fw-bolder" style="color: #1976d2;">SP</h2>
                            </div>
                        @endif

                        {{-- Implementasi Nama Instansi Setting --}}
                        <h4 class="text-white fw-bold mb-0 position-relative" style="z-index: 2;">
                            {{ $setting->nama_instansi ?? 'Portal Pemuda' }}
                        </h4>

                    </div>

                    <div class="card-body p-4 p-md-5 bg-white pt-2">
                        <h5 class="fw-bold mb-4 text-center text-dark">Selamat Datang!</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger p-2 mb-4 rounded-3" style="font-size: 0.85rem;">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium text-secondary small">Alamat
                                    Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-primary">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email"
                                        class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-medium text-secondary small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-primary">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="password"
                                        class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                        placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-primary">
                                    Masuk Sekarang <i class="fas fa-sign-in-alt ms-1"></i>
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <span class="text-muted small">Belum punya akun? <a href="{{ route('register') }}"
                                        class="text-primary fw-bold text-decoration-none">Daftar di sini</a></span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4 text-muted small">
                    {!! $setting->footer_text ?? '&copy; ' . date('Y') . ' SIPEDA. All rights reserved.' !!}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
