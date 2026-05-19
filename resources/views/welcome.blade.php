<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pemuda Sulawesi Tengah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Colors & Styles */
        body {
            background-color: #0A1227; /* Warna background utama biru dongker */
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Efek Glow untuk Tombol Hijau */
        .btn-glow {
            background-color: #18C97A;
            color: #ffffff;
            border: none;
            box-shadow: 0 0 15px rgba(24, 201, 122, 0.4);
            transition: all 0.3s ease-in-out;
        }

        .btn-glow:hover {
            background-color: #14a866;
            color: #ffffff;
            box-shadow: 0 0 25px rgba(24, 201, 122, 0.7);
            transform: translateY(-2px);
        }

        /* Styling Custom untuk Badge Kategori */
        .badge-custom {
            background-color: rgba(24, 201, 122, 0.1);
            color: #18C97A;
            border: 1px solid rgba(24, 201, 122, 0.2);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        /* Styling Gambar Hero Kanan */
        .hero-image {
            border-radius: 2rem;
            object-fit: cover;
            width: 100%;
            max-height: 450px;
        }

        /* Link Hover */
        .nav-link-custom {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-link-custom:hover {
            color: #ffffff;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="container-fluid px-4 px-lg-5 py-4">
        <div class="row align-items-center max-w-7xl mx-auto">
            <div class="col-6">
                <img src="{{ asset($setting->logo_instansi ?? 'img/logo-kemenpora-dispora.png') }}" alt="Logo" height="80">
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center gap-4">
                @if (auth()->check() == null)
                        <a href="{{ route('login') }}" class="nav-link-custom fw-medium">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-glow px-4 py-2 fw-bold rounded-3">Daftar</a>
                @else
                    <a href="{{ route('dashboard.index') }}" class="btn btn-glow px-4 py-2 fw-bold rounded-3">Dashboard</a>
                @endif
            </div>
        </div>
    </header>

    <main class="flex-grow-1 d-flex align-items-center py-5">
        <div class="container px-4 px-lg-5 max-w-7xl">
            <div class="row align-items-center gy-5">

                <div class="col-lg-6 pe-lg-5">
                    <span class="badge-custom fw-bold d-inline-block mb-4">
                        {{ $setting->badge_text ?? 'BIDANG KEPEMUDAAN' }}
                    </span>

                    <h1 class="display-4 fw-bolder mb-3" style="line-height: 1.2;">
                        {{ $setting->hero_title ?? 'PENDAFTARAN PEMUDA SULAWESI TENGAH' }}
                    </h1>

                    <p class="fs-5 text-white-50 mb-5">
                        {{ $setting->hero_subtitle ?? 'Bangun Masa Depan Kepemudaan Prov. Sulawesi Tengah' }}
                    </p>

                    <a href="{{ url('login') }}" class="btn btn-glow px-5 py-3 fw-bold fs-6 rounded-4">
                        Mulai Sekarang
                    </a>
                </div>

                <div class="col-lg-6 text-center text-lg-end">
                    <img src="{{ asset('img/photo-1517649763962-0c623066013b.avif') }}" alt="Hero Illustration" class="hero-image shadow-lg">
                </div>

            </div>
        </div>
    </main>

    <footer class="text-center py-4 text-white-50" style="font-size: 0.75rem; letter-spacing: 1px;">
        {{ $setting->copyright_text ?? '© 2026 DISPORA SULAWESI TENGAH. SELURUH HAK CIPTA DILINDUNGI.' }}
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
