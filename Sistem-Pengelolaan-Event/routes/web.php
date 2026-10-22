<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return "DB berhasil connect!";
    } catch (\Exception $e) {
        return 'DB gagal connect: ' . $e->getMessage();
    }
})->withoutMiddleware('web');

Route::get('/tiket', [\App\Http\Controllers\TiketController::class, 'daftar'])->name('tiket.daftar');

Route::get('/tiket/tambah', [\App\Http\Controllers\TiketController::class, 'index'])->name('tiket.index');

Route::post('/tiket', [\App\Http\Controllers\TiketController::class, 'store'])->name('tiket.store');

Route::middleware('auth')->group(function () {
    Route::get('/tiket/{id}/edit', [\App\Http\Controllers\TiketController::class, 'edit'])->name('tiket.edit');

    Route::put('/tiket/{id}', [\App\Http\Controllers\TiketController::class, 'update'])->name('tiket.update');

    Route::delete('/tiket/{id}', [\App\Http\Controllers\TiketController::class, 'destroy'])->name('tiket.destroy');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
