<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/test-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return "DB berhasil connect!";
    } catch (\Exception $e){
        return "DB gagal connect: " . $e->getMessage();
    }
})->withoutMiddleware('web');

// Route menampilkan halaman login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route memproses submit login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        // Sekarang langsung arahkan ke halaman CRUD Laravel (bukan localhost/index.php lagi)
        return redirect()->route('events.index');
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
});

// Route Logout
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// Route Resource CRUD Master Event (index, create, store, edit, update, destroy)
Route::resource('events', EventController::class)->middleware('auth');