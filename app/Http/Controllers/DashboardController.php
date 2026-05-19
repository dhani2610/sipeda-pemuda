<?php

namespace App\Http\Controllers;

use App\Models\Pemuda;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Statistik Atas
        $totalPendaftaran = Pemuda::count();
        $totalUser = User::count();
        $totalTerverifikasi = Pemuda::where('status', 'APPROVE')->count();
        $totalPending = Pemuda::where('status', 'PENDING')->count();

        // 2. Data Program (Berdasarkan type)
        $programStats = [
            'ppan'      => Pemuda::where('registration_type', 'ppan')->count(),
            'ppap'      => Pemuda::where('registration_type', 'ppap')->count(),
            'pelopor'   => Pemuda::where('registration_type', 'pelopor')->count(),
            'pkpi'      => Pemuda::where('registration_type', 'pkpi')->count(),
            'wirausaha' => Pemuda::where('registration_type', 'wirausaha')->count(),
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
