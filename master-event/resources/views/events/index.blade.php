<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Event - Daftar Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('events.index') }}">Sistem Event & Workshop</a>
            <div class="navbar-nav align-items-center">
                <a class="nav-link active" href="{{ route('events.index') }}">Daftar Event</a>
                <a class="nav-link" href="{{ route('events.create') }}">Tambah Event</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm ms-3" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="card shadow-sm p-4 bg-white rounded border-0">
            
            @if (session('pesan'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('pesan') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h4 text-primary mb-0">Daftar Master Event</h2>
                <a href="{{ route('events.create') }}" class="btn btn-success">+ Tambah Event Baru</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Judul Event</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Silabus</th>
                            <th>Durasi Sesi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->judul_event ?? $data->judul }}</td>
                                <td>{{ $data->deskripsi }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $data->kategori }}
                                    </span>
                                </td>
                                <td>{{ $data->silabus }}</td>
                                <td>{{ $data->durasi_sesi ?? $data->durasi }} Menit</td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('events.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    
                                    <form action="{{ route('events.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada data event yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>