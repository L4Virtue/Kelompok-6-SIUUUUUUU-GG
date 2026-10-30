<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta & Biodata Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

{{-- Navbar dengan Tombol Login / Logout --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('pendaftaran.daftar') }}">Event & Workshop</a>
        
        <div class="ms-auto">
            @auth
                {{-- Jika sudah login, tampilkan info user & tombol logout --}}
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <span class="text-white me-2">Halo, <strong>{{ Auth::user()->username }}</strong></span>
                    <button type="submit" class="btn btn-light btn-sm fw-bold text-danger">Logout</button>
                </form>
            @else
                {{-- Jika belum login, tampilkan tombol Login --}}
                <a href="{{ route('login') }}" class="btn btn-light btn-sm fw-bold px-3">Login</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    <h1>Selamat Datang di Website Event & Workshop</h1>
    <p class="text-muted">Berikut adalah data-data dari peserta.</p>

    {{-- Pesan Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h4 class="mb-0 fs-5 fw-bold">Daftar Peserta Event & Workshop</h4>
            
            {{-- Tombol Tambah Peserta hanya muncul jika sudah login (opsional) atau dibebaskan --}}
            @auth
                <a href="{{ route('pendaftaran.tambah') }}" class="btn btn-light btn-sm fw-bold text-primary">+ Tambah Peserta</a>
            @endauth
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle border">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Peserta</th>
                            <th>Asal Instansi/Kampus</th>
                            <th>Nomor Kontak</th>
                            <th>Email Aktif</th>
                            @auth
                                <th class="text-center">Aksi</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftaran as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->nama_peserta }}</td>
                            <td>{{ $row->instansi_kampus }}</td>
                            <td>{{ $row->nomor_kontak }}</td>
                            <td>{{ $row->email_aktif }}</td>
                            
                            @auth
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <a href="{{ route('pendaftaran.edit', $row->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('pendaftaran.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                            @endauth
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::check() ? 6 : 5 }}" class="text-center text-muted py-4">Belum ada data peserta.</td>
                        </tr>
                        @endforelse
                    </tbody>    
                </table>    
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>