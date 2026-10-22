<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function daftar()
    {
        $tiket = Tiket::orderByDesc('id')->get();

        return view('tiket.daftar', compact('tiket'));
    }

    
    public function index()
    {
        return view('tiket.index');
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipe_tiket' => 'required|string|max:50',
            'harga_tiket' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:1',
            'fasilitas' => 'required|string',
        ]);

        Tiket::create($data);

        return redirect()
            ->route('tiket.daftar')
            ->with('success', 'Data tiket berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $tiket = Tiket::findOrFail($id);

        return view('tiket.edit', compact('tiket'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tipe_tiket' => 'required|string|max:50',
            'harga_tiket' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:1',
            'fasilitas' => 'required|string',
        ]);

        $tiket = Tiket::findOrFail($id);

        $tiket->update($data);

        return redirect()
            ->route('tiket.daftar')
            ->with('success', 'Data tiket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tiket = Tiket::findOrFail($id);

        $tiket->delete();

        return redirect()
            ->route('tiket.daftar')
            ->with('success', 'Data tiket berhasil dihapus.');
    }

}
