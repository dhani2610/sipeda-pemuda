<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login
     */
    public function showLoginForm()
    {
        // Jika user sudah login, langsung lempar ke halaman dashboard/sipeda
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        // Pastikan nama view sesuai dengan folder tempat kamu menyimpan login.blade.php
        // Contoh ini mengasumsikan file ada di resources/views/auth/login.blade.php
        return view('auth.login');
    }

    /**
     * Memproses data login
     */
    public function login(Request $request)
    {
        // Validasi inputan
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah checkbox 'Remember Me' dicentang
        $remember = $request->has('remember');

        // Proses autentikasi
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect ke halaman yang ingin dituju (atau default ke sipeda)
            return redirect()->intended(route('dashboard.index'));
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Memproses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
