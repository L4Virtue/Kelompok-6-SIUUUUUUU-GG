<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return "DB berhasil connect!";
    } catch (\Exception $e){
        return "DB gagal connect:" . $e->getMessage();
    }
})->withoutMiddleware('web');

Route::get('/daftar-speaker', [SpeakerController::class, 'daftar'])->name('speaker.daftar');

Route::get('/daftar-speaker', [SpeakerController::class, 'index'])->name('speaker.index');

Route::get('/tambah-speaker', [SpeakerController::class, 'create'])->name('speaker.create');

Route::post('/tambah-speaker', [SpeakerController::class, 'store'])->name('speaker.store');

Route::get('/edit-speaker/{id}', [SpeakerController::class, 'edit'])->name('speaker.edit');

Route::put('/update-speaker/{id}', [SpeakerController::class, 'update'])->name('speaker.update');

Route::delete('/hapus-speaker/{id}', [SpeakerController::class, 'destroy'])->name('speaker.destroy');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [SpeakerController::class, 'index'])->name('home');
Route::get('/daftar-speaker', [SpeakerController::class, 'index'])->name('speaker.index');

// Route Autentifikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    Route::get('/tambah-speaker', [SpeakerController::class, 'create'])->name('speaker.create');
    Route::post('/tambah-speaker', [SpeakerController::class, 'store'])->name('speaker.store');
    
    Route::get('/speaker/{speaker}/edit', [SpeakerController::class, 'edit'])->name('speaker.edit');
    Route::put('/speaker/{speaker}', [SpeakerController::class, 'update'])->name('speaker.update');
    Route::delete('/speaker/{speaker}', [SpeakerController::class, 'destroy'])->name('speaker.destroy');
});