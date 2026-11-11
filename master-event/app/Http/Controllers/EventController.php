<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // 1. Tampilkan daftar event (pengganti index.php)
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->get();
        return view('events.index', compact('events'));
    }

    // 2. Tampilkan form tambah event (pengganti tambah.php)
    public function create()
    {
        return view('events.create');
    }

    // 3. Simpan data event baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul_event' => 'required',
            'deskripsi'   => 'required',
            'kategori'    => 'required',
            'silabus'     => 'required',
            'durasi_sesi' => 'required|numeric',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('pesan', 'Data event berhasil ditambahkan!');
    }

    // 4. Tampilkan form edit event (pengganti edit.php)
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    // 5. Update data event di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_event' => 'required',
            'deskripsi'   => 'required',
            'kategori'    => 'required',
            'silabus'     => 'required',
            'durasi_sesi' => 'required|numeric',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('pesan', 'Data event berhasil diperbarui!');
    }

    // 6. Hapus data event (pengganti hapus.php)
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('pesan', 'Data event berhasil dihapus!');
    }
}