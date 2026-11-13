<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tiket', [\App\Http\Controllers\TiketController::class, 'daftar'])->name('tiket.daftar');

Route::get('/tiket/tambah', [\App\Http\Controllers\TiketController::class, 'index'])->name('tiket.index') ->middleware(['auth', 'role:admin,petugas']);

Route::post('/tiket', [\App\Http\Controllers\TiketController::class, 'store'])->name('tiket.store') ->middleware(['auth', 'role:admin,petugas']);

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/tiket/{tiket}/edit', [\App\Http\Controllers\TiketController::class, 'edit'])
    ->name('tiket.edit')
    ->can('update', 'tiket');

    Route::put('/tiket/{id}', [\App\Http\Controllers\TiketController::class, 'update'])->name('tiket.update');

    Route::delete('/tiket/{id}', [\App\Http\Controllers\TiketController::class, 'destroy'])
    ->name('tiket.destroy')
    ->can('hapus-tiket');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');