@php
    // Memanggil data Setting dari database
    $setting = \App\Models\Setting::first();
@endphp

<style>
    /* Styling khusus untuk Sidebar Modern (Light & Blue Theme) */
    .sidebar {
        background: #ffffff;
        /* Background putih bersih */
        min-height: 100vh;
        color: #4b5563;
        /* Warna teks utama abu-abu gelap */
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
        /* Shadow halus ke kanan */
        border-right: 1px solid #f1f5f9;

        /* Tambahan untuk Responsif */
        width: 260px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1050;
        /* Pastikan selalu di atas konten */
        transition: transform 0.3s ease-in-out;
        overflow-y: auto;
        /* Bisa discroll jika menu kepanjangan */
    }

    /* Kustomisasi Scrollbar Sidebar */
    .sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* Kotak Logo */
    .sidebar-logo-box {
        background: #ffffff;
        width: 65px;
        height: 65px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid #f1f5f9;
        padding: 5px;
    }

    /* Menu Link */
    .sidebar .nav-link {
        color: #64748b;
        /* Abu-abu kebiruan untuk menu tidak aktif */
        text-decoration: none;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        border-radius: 10px;
        margin-bottom: 6px;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .sidebar .nav-link i {
        width: 35px;
        font-size: 1.1rem;
        color: #94a3b8;
        /* Ikon sedikit lebih pudar */
        transition: color 0.3s ease;
    }

    /* Menu Link Hover & Active (Tema Biru Dominan) */
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background: linear-gradient(135deg, #1e56d6 0%, #1976d2 100%);
        /* Gradasi biru seperti login */
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(25, 118, 210, 0.25);
    }

    .sidebar .nav-link:hover i,
    .sidebar .nav-link.active i {
        color: #ffffff;
        /* Ikon jadi putih saat aktif */
    }

    /* OVERLAY GELAP UNTUK MOBILE */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
        display: none;
        /* Default hidden */
        transition: opacity 0.3s ease;
    }

    .sidebar-overlay.show {
        display: block;
    }

    /* RESPONSIVE LOGIC */
    /* Mobile & Tablet (Layar di bawah 992px) */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
            /* Sembunyi di luar layar (kiri) */
        }

        .sidebar.show {
            transform: translateX(0);
            /* Muncul saat class 'show' ditambahkan */
        }
    }

    /* Desktop (Layar besar) */
    @media (min-width: 992px) {
        .sidebar.hide {
            transform: translateX(-100%);
            /* Fitur tutup sidebar di desktop */
        }

        /* Menggeser konten utama agar tidak tertutup sidebar */
        .main-content-wrapper {
            margin-left: 260px;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content-wrapper.expanded {
            margin-left: 0;
        }
    }
</style>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar p-3" id="sidebar">
    <div class="d-flex justify-content-between align-items-center mb-2 mt-4 px-2">
        <div class="text-center w-100">
            @if ($setting && $setting->logo_instansi)
                <img src="{{ asset($setting->logo_instansi) }}" alt="Logo"
                    style="max-width: 100%; max-height: 100%; object-fit: contain;">
            @else
                <div class="sidebar-logo-box mb-3">
                    <h2 class="m-0 fw-bolder" style="color: #1976d2;">SP</h2>
                </div>
            @endif

            <p class="text-muted small mt-1" style="font-size: 0.75rem;">Administrator Panel</p>
        </div>

        <button class="btn btn-sm text-dark d-lg-none" id="closeSidebarBtn"
            style="position: absolute; right: 10px; top: 15px; font-size:1.5rem;">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <hr style="border-color: #e2e8f0;" class="mb-4 mt-2 mx-2">

    <nav class="d-flex flex-column px-2 pb-4">
        <a href="{{ route('dashboard.index') }}"
            class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>

        @if (auth()->user()->role == 'admin')
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> User Management
            </a>
        @endif

        <a href="{{ route('pemuda.index', ['type' => 'ppan']) }}"
            class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type', 'ppan') == 'ppan' ? 'active' : '' }}">
            <i class="fas fa-globe"></i> PPAN
        </a>

        <a href="{{ route('pemuda.index', ['type' => 'ppap']) }}"
            class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'ppap' ? 'active' : '' }}">
            <i class="fas fa-map-marker-alt"></i> PPAP
        </a>

        <a href="{{ route('pemuda.index', ['type' => 'pelopor']) }}"
            class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'pelopor' ? 'active' : '' }}">
            <i class="fas fa-magic"></i> Pemuda Pelopor
        </a>

        <a href="{{ route('pemuda.index', ['type' => 'pkpi']) }}"
            class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'pkpi' ? 'active' : '' }}">
            <i class="fas fa-lightbulb"></i> PKPI
        </a>

        <a href="{{ route('pemuda.index', ['type' => 'wirausaha']) }}"
            class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'wirausaha' ? 'active' : '' }}">
            <i class="fas fa-briefcase"></i> Wirausaha Muda
        </a>

        @if (auth()->user()->role == 'admin')
            <hr style="border-color: #e2e8f0;" class="my-2">

            <a href="{{ route('setting.index') }}"
                class="nav-link {{ request()->routeIs('setting.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> Setting
            </a>
        @endif
    </nav>
</div>
