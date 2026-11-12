<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AuthController;

// Halaman Utama (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// Tes Koneksi Database
Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return 'DB berhasil connect!';
    } catch (\Exception $e) {
        return 'DB gagal connect: ' . $e->getMessage();
    }
})->withoutMiddleware('web');

// ==========================================
// 1. RUTE PUBLIK (Bisa diakses siapa saja / Tamu & Pengunjung)
// ==========================================
Route::get('/daftar-biodata', [PendaftaranController::class, 'daftar'])->name('pendaftaran.daftar');
Route::get('/daftar-biodata/tambah', [PendaftaranController::class, 'tambah'])->name('pendaftaran.tambah');
Route::post('/daftar-biodata', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// ==========================================
// 2. RUTE GUEST (Hanya untuk yang BELUM login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// ==========================================
// 3. RUTE AUTH & ROLE (Khusus yang SUDAH login)
// ==========================================
Route::middleware('auth')->group(function () {
    // Tombol Logout untuk semua user yang sudah login
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Khusus ADMIN (Dibatasi menggunakan middleware role yang sudah dibuat di Langkah 3)
    // Pengunjung (role 'user') otomatis ditolak (Error 403) jika mencoba mengakses rute ini
    Route::middleware('role:admin')->group(function () {
        Route::get('/daftar-biodata/{pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
        Route::put('/daftar-biodata/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
        Route::delete('/daftar-biodata/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    });
});