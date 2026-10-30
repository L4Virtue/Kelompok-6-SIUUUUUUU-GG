<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
public function showLogin()
    {
        // Jika user sudah login, langsung alihkan ke halaman daftar peserta
        if (Auth::check()) {
            return redirect()->route('pendaftaran.daftar');
        }
        
        return view('auth.login');
    }
    /**
     * Memproses permintaan login dari pengguna.
     */
    public function login(Request $request)
    {
        // 1. Validasi input dari form
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Cek kecocokan data dengan database menggunakan Auth::attempt
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('pendaftaran.daftar'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->username . '!');
        }

        // 3. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    /**
     * Memproses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pendaftaran.daftar')->with('success', 'Anda telah berhasil logout.');
    }
}