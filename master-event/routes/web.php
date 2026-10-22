<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return "DB berhasil connect!";
    } catch (\Exception $e){
        return "DB gagal connect: " . $e->getMessage();
    }
})->withoutMiddleware('web');

// Route untuk menampilkan halaman form login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route untuk memproses submit form login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return "Berhasil Login!";
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
});