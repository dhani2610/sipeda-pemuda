<div class="topbar d-flex justify-content-between align-items-center bg-white shadow-sm px-4 py-3">

    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light shadow-sm" id="toggleSidebarBtn">
            <i class="fas fa-bars"></i>
        </button>

        <h4 class="m-0 text-dark fw-bold">Dashboard</h4>
    </div>

    <div class="dropdown">
        <div class="d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
            <span class="me-3 fw-medium text-secondary">
                Halo, {{ Auth::user()->name ?? 'User' }}
            </span>

            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=10b981&color=fff&bold=true"
                 class="rounded-circle shadow-sm" width="40" alt="Avatar">

            <i class="fas fa-chevron-down ms-2 text-muted" style="font-size: 0.8rem;"></i>
        </div>

        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center fw-medium">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
