@extends('layouts.app')


@section('content')
    <style>
        /* Styling Dashboard Cards */
        .dash-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            padding: 25px;
            height: 100%;
            transition: transform 0.2s;
        }

        .dash-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        /* Icon Boxes */
        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .icon-box-green {
            background: #ecfdf5;
            color: #10b981;
        }

        .icon-box-purple {
            background: #f3e8ff;
            color: #a855f7;
        }

        .icon-box-blue {
            background: #eff6ff;
            color: #3b82f6;
        }

        .icon-box-orange {
            background: #fff7ed;
            color: #f97316;
        }

        .dash-title {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .dash-value {
            font-size: 1.8rem;
            color: #0f172a;
            font-weight: 800;
            margin: 0;
        }

        /* Program Cards */
        .program-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: inherit;
            transition: all 0.2s;
        }

        .program-card:hover {
            border-color: #cbd5e1;
        }

        .program-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 800;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Warna gradien / solid sesuai gambar */
        .bg-ppan {
            background: #4f46e5;
        }

        .bg-ppap {
            background: #6366f1;
        }

        .bg-pelopor {
            background: #8b5cf6;
        }

        .bg-pkpi {
            background: #d946ef;
        }

        .bg-wirausaha {
            background: #10b981;
        }

        .program-info h3 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 2px 0;
            line-height: 1;
        }

        .program-info p {
            font-size: 0.65rem;
            font-weight: 700;
            color: #64748b;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Welcome Banner */
        .welcome-banner {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 24px;
            padding: 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            margin-top: 30px;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
        }

        /* Hiasan background abstrak di kanan banner */
        .welcome-banner::after {
            content: "";
            position: absolute;
            right: -50px;
            bottom: -50px;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .welcome-title {
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .welcome-desc {
            font-size: 0.95rem;
            opacity: 0.9;
            max-width: 600px;
            line-height: 1.6;
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
        }

        .btn-panduan {
            background: #ffffff;
            color: #059669;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 12px;
            text-decoration: none;
            display: inline-block;
            position: relative;
            z-index: 2;
            transition: all 0.2s;
        }

        .btn-panduan:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="container-fluid">
        <div class="d-flex align-items-center mb-4">
            <h4 class="fw-bold text-dark m-0">Selamat datang di Panel Admin</h4>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3 col-sm-6">
                <div class="dash-card">
                    <div class="icon-box icon-box-green"><i class="fas fa-clipboard-list"></i></div>
                    <p class="dash-title">Total Pendaftaran</p>
                    <h3 class="dash-value">{{ $totalPendaftaran }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="dash-card">
                    <div class="icon-box icon-box-purple"><i class="fas fa-users"></i></div>
                    <p class="dash-title">Total User Akun</p>
                    <h3 class="dash-value">{{ $totalUser }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="dash-card">
                    <div class="icon-box icon-box-blue"><i class="fas fa-shield-check"></i></div>
                    <p class="dash-title">Total Terverifikasi</p>
                    <h3 class="dash-value">{{ $totalTerverifikasi }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="dash-card">
                    <div class="icon-box icon-box-orange"><i class="fas fa-clock"></i></div>
                    <p class="dash-title">Pendaftaran Pending</p>
                    <h3 class="dash-value">{{ $totalPending }}</h3>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center mb-3">
            <div style="width: 8px; height: 8px; border-radius: 50%; background-color: #8b5cf6; margin-right: 10px;"></div>
            <h5 class="fw-bold text-dark m-0">Program Pendaftaran Pemuda</h5>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-5 g-3">
            <div class="col">
                <a href="{{ route('pemuda.index', ['type' => 'ppan']) }}" class="program-card">
                    <div class="program-icon bg-ppan">PPA</div>
                    <div class="program-info">
                        <h3>{{ $programStats['ppan'] }}</h3>
                        <p>PPAN</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('pemuda.index', ['type' => 'ppap']) }}" class="program-card">
                    <div class="program-icon bg-ppap">PPA</div>
                    <div class="program-info">
                        <h3>{{ $programStats['ppap'] }}</h3>
                        <p>PPAP</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('pemuda.index', ['type' => 'pelopor']) }}" class="program-card">
                    <div class="program-icon bg-pelopor">PEL</div>
                    <div class="program-info">
                        <h3>{{ $programStats['pelopor'] }}</h3>
                        <p>Pelopor</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('pemuda.index', ['type' => 'pkpi']) }}" class="program-card">
                    <div class="program-icon bg-pkpi">PKP</div>
                    <div class="program-info">
                        <h3>{{ $programStats['pkpi'] }}</h3>
                        <p>PKPI</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('pemuda.index', ['type' => 'wirausaha']) }}" class="program-card">
                    <div class="program-icon bg-wirausaha">WIR</div>
                    <div class="program-info">
                        <h3>{{ $programStats['wirausaha'] }}</h3>
                        <p>Wirausaha</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="welcome-banner">
            <h2 class="welcome-title">Selamat Beraktivitas!</h2>
            <p class="welcome-desc">
                Gunakan portal ini untuk mengelola pendaftaran atlet, pengajuan bantuan
                sarana prasarana, dan penyewaan gedung dengan lebih mudah dan transparan.
            </p>
        </div>

    </div>
@endsection
