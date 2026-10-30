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

// Rute untuk Manajemen Pendaftaran Peserta
Route::get('/daftar-biodata', [PendaftaranController::class, 'daftar'])->name('pendaftaran.daftar');
Route::get('/daftar-biodata/tambah', [PendaftaranController::class, 'tambah'])->name('pendaftaran.tambah');
Route::post('/daftar-biodata', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::get('/daftar-biodata/{pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
Route::put('/daftar-biodata/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');

Route::delete('/daftar-biodata/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

// Rute Autentikasi Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute CRUD yang Membutuhkan Login (Middleware Auth)
Route::middleware('auth')->group(function () {
    Route::get('/daftar-biodata/tambah', [PendaftaranController::class, 'tambah'])->name('pendaftaran.tambah');
    Route::post('/daftar-biodata', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/daftar-biodata/{pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/daftar-biodata/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/daftar-biodata/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
});