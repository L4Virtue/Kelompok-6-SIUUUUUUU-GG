<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route menampilkan halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route memproses login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('events.index'); // Arahkan ke halaman Daftar Master Event di Laravel
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
});

// Route halaman Daftar Master Event (hanya bisa diakses kalau sudah login)
Route::get('/events', function () {
    $events = DB::table('events')->get(); // Mengambil semua data dari tabel events
    return view('events', compact('events'));
})->middleware('auth')->name('events.index');