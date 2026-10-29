<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembicara - Modul Speaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .navbar-slate { background-color: #0f172a !important; }
        .navbar-slate .navbar-brand, .navbar-slate .nav-link { color: #ffffff !important; }
        .navbar-slate .nav-link.active { color: #94a3b8 !important; }
        .custom-card-slate {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 24px;
            margin-top: 20px;
        }
        .btn-blue {
            background-color: #2563eb;
            color: white;
            border: none;
        }
        .btn-blue:hover {
            background-color: #1d4ed8;
            color: white;
        }
    </style>
</head>
<body style="background-color: #f8fafc;">
    
    <nav class="navbar navbar-expand-lg navbar-slate shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('speaker.index') }}">SpeakerHub</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('speaker.index') ? 'active' : '' }}" href="{{ route('speaker.index') }}">Daftar Pembicara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('speaker.create') ? 'active' : '' }}" href="{{ route('speaker.create') }}">Tambah Pembicara</a>
                    </li>
                </ul>

                <!-- Menu Login / Logout di Kanan Navbar (Sesuai Slide Modul) -->
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="text-decoration: none;">
                                    Logout ({{ Auth::user()->username }})
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="custom-card-slate">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: #1e293b; margin: 0;">Daftar Pembicara / Speaker</h2>
                <a href="{{ route('speaker.create') }}" class="btn btn-blue px-3 py-2 fw-semibold">+ Tambah Pembicara</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 table-outlined-slate">
                    <thead>
                        <tr>
                            <th class="fw-bold">No</th>
                            <th class="fw-bold">Nama Pembicara</th>
                            <th class="fw-bold">Keahlian</th>
                            <th class="fw-bold">Institusi</th>
                            <th class="fw-bold">Portofolio</th>
                            
                            @auth
                                <th class="fw-bold">Aksi</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($speaker as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_pembicara }}</td>
                            <td>{{ $item->keahlian }}</td>
                            <td>{{ $item->institusi }}</td>
                            <td>
                                @if($item->portofolio)
                                    <a href="{{ $item->portofolio }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Portfolio</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            @auth
                            <td>
                                <a href="{{ route('speaker.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('speaker.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembicara ini?')">Hapus</button>
                                </form>
                            </td>
                            @endauth
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($speaker->isEmpty())
                    <div class="text-center text-muted py-4">
                        Belum ada data pembicara.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>