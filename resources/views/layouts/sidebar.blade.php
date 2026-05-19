<style>
    /* Styling khusus untuk Sidebar Modern */
    .sidebar {
        background: #1e1e2d; /* Warna dark modern */
        min-height: 100vh;
        color: #a2a3b7;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);

        /* Tambahan untuk Responsif */
        width: 260px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1050; /* Pastikan selalu di atas konten */
        transition: transform 0.3s ease-in-out;
        overflow-y: auto; /* Bisa discroll jika menu kepanjangan */
    }

    .sidebar .nav-link {
        color: #a2a3b7;
        text-decoration: none;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        border-radius: 12px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
    }
    .sidebar .nav-link i {
        width: 35px;
        font-size: 1.1rem;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background: #10b981;
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.3);
    }

    /* OVERLAY GELAP UNTUK MOBILE */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
        display: none; /* Default hidden */
        transition: opacity 0.3s ease;
    }
    .sidebar-overlay.show {
        display: block;
    }

    /* RESPONSIVE LOGIC */
    /* Mobile & Tablet (Layar di bawah 992px) */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%); /* Sembunyi di luar layar (kiri) */
        }
        .sidebar.show {
            transform: translateX(0); /* Muncul saat class 'show' ditambahkan */
        }
    }

    /* Desktop (Layar besar) */
    @media (min-width: 992px) {
        .sidebar.hide {
            transform: translateX(-100%); /* Fitur tutup sidebar di desktop */
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
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3 px-2">
        <div class="text-center w-100">
            <div class="bg-white rounded-4 mx-auto d-flex align-items-center justify-content-center shadow-sm" style="width: 65px; height: 65px;">
                <h3 class="m-0 fw-bolder" style="color: #10b981;">PP</h3>
            </div>
            <h5 class="mt-3 text-white fw-bold tracking-wide">Portal Pemuda</h5>
        </div>

        <button class="btn btn-sm text-white d-lg-none" id="closeSidebarBtn" style="position: absolute; right: 10px; top: 15px; font-size:1.5rem;">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <hr style="border-color: rgba(255,255,255,0.1);" class="mb-4">

    <nav class="d-flex flex-column">
        <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> User Management
        </a>
        <a href="{{ route('pemuda.index', ['type' => 'ppan']) }}" class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type', 'ppan') == 'ppan' ? 'active' : '' }}">
            <i class="fas fa-globe"></i> PPAN
        </a>
        <a href="{{ route('pemuda.index', ['type' => 'ppap']) }}" class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'ppap' ? 'active' : '' }}">
            <i class="fas fa-map-marker-alt"></i> PPAP
        </a>
        <a href="{{ route('pemuda.index', ['type' => 'pelopor']) }}" class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'pelopor' ? 'active' : '' }}">
            <i class="fas fa-magic"></i> Pemuda Pelopor
        </a>
        <a href="{{ route('pemuda.index', ['type' => 'pkpi']) }}" class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'pkpi' ? 'active' : '' }}">
            <i class="fas fa-lightbulb"></i> PKPI
        </a>
        <a href="{{ route('pemuda.index', ['type' => 'wirausaha']) }}" class="nav-link {{ request()->routeIs('pemuda.*') && request()->query('type') == 'wirausaha' ? 'active' : '' }}">
            <i class="fas fa-briefcase"></i> Wirausaha Muda
        </a>
        <a href="{{ route('setting.index') }}" class="nav-link {{ request()->routeIs('setting.*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i> Setting
        </a>
    </nav>
</div>
