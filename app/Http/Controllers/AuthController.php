<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.register');
    }

    /**
     * Memproses pendaftaran User baru
     */
    public function register(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6',
            'nomor_telepon' => 'nullable|string|max:20',
            'role'          => 'required|in:user', // Mengunci role agar selalu 'user'
        ], [
            'email.unique' => 'Email sudah digunakan. Silakan login atau gunakan email lain.',
            'password.min' => 'Password minimal harus 6 karakter.'
        ]);

        // 2. Hash Password
        $validated['password'] = Hash::make($validated['password']);

        // 3. Simpan ke database
        User::create($validated);

        // 4. Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
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
