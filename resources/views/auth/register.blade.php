@php
    $setting = \App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - {{ $setting->nama_instansi ?? 'Portal Pemuda' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Menggunakan CSS yang sama persis dengan Login agar konsisten */
        body { background-color: #f0f4f8; }
        .login-card { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); overflow: hidden; }
        .login-header { background: linear-gradient(135deg, #1e56d6 0%, #1976d2 100%); padding: 35px 20px; text-align: center; position: relative; }
        .login-header::after { content: ''; position: absolute; bottom: -20px; left: 0; width: 100%; height: 40px; background: #ffffff; border-radius: 50% 50% 0 0; }
        .logo-box { background: #ffffff; width: 70px; height: 70px; border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: 0 8px 20px rgba(0,0,0,0.15); padding: 5px; position: relative; z-index: 2; }
        .logo-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .btn-primary { background: linear-gradient(135deg, #1e56d6 0%, #1976d2 100%); border: none; padding: 12px; border-radius: 10px; font-weight: 600; transition: all 0.3s; }
        .btn-primary:hover { background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%); transform: translateY(-2px); box-shadow: 0 8px 15px rgba(25, 118, 210, 0.3); }
        .form-control { padding: 12px 15px; border-radius: 10px; background-color: #f8fafc; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.15); border-color: #1976d2; background-color: #ffffff; }
        .input-group-text { border-radius: 10px 0 0 10px; }
    </style>
</head>
<body class="d-flex align-items-center min-vh-100">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
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
                        <h4 class="text-white fw-bold mb-0 position-relative" style="z-index: 2;">Pendaftaran Akun</h4>
                        <p class="text-white-50 small mb-0 mt-1 position-relative" style="z-index: 2;">{{ $setting->nama_instansi ?? 'Portal Pemuda' }}</p>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white pt-2">
                        @if ($errors->any())
                            <div class="alert alert-danger p-2 mb-4 rounded-3" style="font-size: 0.85rem;">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <input type="hidden" name="role" value="user">

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-medium text-secondary small">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-primary"><i class="fas fa-user"></i></span>
                                        <input type="text" name="name" class="form-control border-start-0 ps-0" value="{{ old('name') }}" placeholder="Masukkan nama Anda" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label fw-medium text-secondary small">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-primary"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" class="form-control border-start-0 ps-0" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium text-secondary small">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-primary"><i class="fas fa-phone"></i></span>
                                        <input type="text" name="nomor_telepon" class="form-control border-start-0 ps-0" value="{{ old('nomor_telepon') }}" placeholder="08xxx">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium text-secondary small">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-primary"><i class="fas fa-lock"></i></span>
                                        <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-primary">
                                    Buat Akun Sekarang <i class="fas fa-user-plus ms-1"></i>
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <span class="text-muted small">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk di sini</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
