<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index()
    {
        $speaker = Speaker::orderByDesc('id')->get();
        return view('speaker.index', compact('speaker'));
    }

    public function create()
    {
        return view('speaker.tambah');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pembicara' => 'required|max:100',
            'keahlian'       => 'required|max:50',
            'institusi'      => 'required|max:100',
            'portofolio'     => 'nullable|url',
        ]);

        Speaker::create($validatedData);

        return redirect('/daftar-speaker')->with('success', 'Data pembicara berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $speaker = Speaker::findOrFail($id);
        return view('speaker.edit', compact('speaker'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pembicara' => 'required|max:100',
            'keahlian'       => 'required|max:50',
            'institusi'      => 'required|max:100',
            'portofolio'     => 'nullable|url',
        ]);

        $speaker = Speaker::findOrFail($id);
        $speaker->update($request->all());

        return redirect('/daftar-speaker')->with('success', 'Data pembicara berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $speaker = Speaker::findOrFail($id);
        $speaker->delete();

        return redirect('/daftar-speaker')->with('success', 'Data pembicara berhasil dihapus!');
    }
}