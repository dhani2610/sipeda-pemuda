<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\SipedaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController; // Controller baru untuk halaman publik
use App\Http\Controllers\PemudaController;
use App\Http\Controllers\SettingController;

// ==========================================
// ROUTE PUBLIK (Tidak perlu login)a
// ==========================================

// Halaman Utama (Landing Page)
Route::get('/', [FrontController::class, 'index'])->name('welcome');

// Halaman saat Sub Kategori diklik (membawa ID sub kategori)
Route::get('/bankdata/{id}', [FrontController::class, 'showData'])->name('bankdata.show');

// ==========================================
// ROUTE AUTENTIKASI
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// ROUTE ADMIN (Wajib Login)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Resource Routes untuk CRUD Admin
    Route::resource('users', UserController::class);

    Route::resource('pemuda', PemudaController::class);
    Route::post('pemuda/{id}/status', [App\Http\Controllers\PemudaController::class, 'updateStatus'])->name('pemuda.status');
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    // Route untuk Ajax Fetch Sub Kategori
    Route::get('/get-subkategori/{id}', [SipedaController::class, 'getSubKategori']);
});
