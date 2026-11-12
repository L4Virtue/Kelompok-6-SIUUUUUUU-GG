<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class PendaftaranController extends Controller
{
    public function daftar()
    {
        $pendaftaran = Pendaftaran::all();
        return view('pendaftaran.index', compact('pendaftaran'));
    }

    public function tambah()
    {
        return view('pendaftaran.tambah');
    }

    public function store(Request $request)
    {
        // Validasi data inputan sesuai kolom database
        $request->validate([
            'nama_peserta'    => 'required|max:100',
            'instansi_kampus' => 'required|max:100',
            'nomor_kontak'    => 'required|max:20',
            'email_aktif'     => 'required|email|max:100',
        ]);

        // Menyimpan data ke database menggunakan Model Pendaftaran
        Pendaftaran::create([
            'nama_peserta'    => $request->nama_peserta,
            'instansi_kampus' => $request->instansi_kampus,
            'nomor_kontak'    => $request->nomor_kontak,
            'email_aktif'     => $request->email_aktif,
        ]);

        // Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('pendaftaran.daftar')->with('success', 'Data peserta berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data peserta.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        // Pengecekan Hak Akses: Tolak jika bukan admin
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect()->route('pendaftaran.daftar')->with('error', 'Akses ditolak! Hanya admin yang dapat mengedit data.');
        }

        return view('pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * Memproses pembaruan data peserta ke database.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        // Pengecekan Hak Akses: Tolak jika bukan admin
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect()->route('pendaftaran.daftar')->with('error', 'Akses ditolak! Hanya admin yang dapat mengubah data.');
        }

        $request->validate([
            'nama_peserta'    => 'required|string|max:255',
            'instansi_kampus' => 'required|string|max:255',
            'nomor_kontak'    => 'required|string|max:20',
            'email_aktif'     => 'required|email|max:255',
        ]);

        $pendaftaran->update([
            'nama_peserta'    => $request->nama_peserta,
            'instansi_kampus' => $request->instansi_kampus,
            'nomor_kontak'    => $request->nomor_kontak,
            'email_aktif'     => $request->email_aktif,
        ]);

        return redirect()->route('pendaftaran.daftar')->with('success', 'Data peserta berhasil diperbarui!');
    }

    /**
     * Menghapus data peserta dari database.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        // Pengecekan Hak Akses: Tolak jika bukan admin
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return redirect()->route('pendaftaran.daftar')->with('error', 'Akses ditolak! Hanya admin yang dapat menghapus data.');
        }

        // Menghapus data dari database menggunakan Eloquent
        $pendaftaran->delete();

        // Redirect kembali ke halaman daftar peserta dengan pesan sukses
        return redirect()->route('pendaftaran.daftar')->with('success', 'Data peserta berhasil dihapus!');
    }
}