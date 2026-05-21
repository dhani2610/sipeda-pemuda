<?php

namespace App\Http\Controllers;

use App\Models\Pemuda;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $isAdmin = auth()->user()->role === 'admin'; // atau auth()->user()->is_admin
        $userId = auth()->id();

        $queryPemuda = Pemuda::query();

        if (!$isAdmin) {
            $queryPemuda->where('id_user', $userId);
        }

        $totalPendaftaran = (clone $queryPemuda)->count();
        $totalUser = $isAdmin ? User::count() : 1; // Jika user biasa, total user dianggap 1
        $totalTerverifikasi = (clone $queryPemuda)->where('status', 'APPROVE')->count();
        $totalPending = (clone $queryPemuda)->where('status', 'PENDING')->count();

        $programStats = [
            'ppan'      => (clone $queryPemuda)->where('registration_type', 'ppan')->count(),
            'ppap'      => (clone $queryPemuda)->where('registration_type', 'ppap')->count(),
            'pelopor'   => (clone $queryPemuda)->where('registration_type', 'pelopor')->count(),
            'pkpi'      => (clone $queryPemuda)->where('registration_type', 'pkpi')->count(),
            'wirausaha' => (clone $queryPemuda)->where('registration_type', 'wirausaha')->count(),
        ];

        return view('dashboard', compact(
            'totalPendaftaran',
            'totalUser',
            'totalTerverifikasi',
            'totalPending',
            'programStats'
        ));
    }
}
