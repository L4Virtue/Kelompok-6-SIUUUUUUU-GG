<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpeakerController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Publik: boleh dibuka tanpa login (hanya melihat daftar speaker)
Route::get('/', [SpeakerController::class, 'index'])->name('home');
Route::get('/daftar-speaker', [SpeakerController::class, 'index'])->name('speaker.index');

Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return 'DB berhasil connect!';
    } catch (\Exception $e) {
        return 'DB gagal connect: ' . $e->getMessage();
    }
})->withoutMiddleware('web');

// Hanya untuk yang BELUM login (halaman login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// Hanya untuk yang SUDAH login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dibatasi berdasarkan peran & Policy (admin & panitia: tambah & edit/update)
    Route::middleware('role:admin,panitia')->group(function () {
        Route::get('/tambah-speaker', [SpeakerController::class, 'create'])
            ->can('create', \App\Models\Speaker::class)
            ->name('speaker.create');
        Route::post('/tambah-speaker', [SpeakerController::class, 'store'])
            ->can('create', \App\Models\Speaker::class)
            ->name('speaker.store');

        Route::get('/edit-speaker/{speaker}', [SpeakerController::class, 'edit'])
            ->can('update', 'speaker')
            ->name('speaker.edit');
        Route::put('/update-speaker/{speaker}', [SpeakerController::class, 'update'])
            ->can('update', 'speaker')
            ->name('speaker.update');
    });

    // Khusus admin: hapus data speaker
    Route::delete('/hapus-speaker/{speaker}', [SpeakerController::class, 'destroy'])
        ->can('delete', 'speaker')
        ->name('speaker.destroy')
        ->middleware('role:admin');
});