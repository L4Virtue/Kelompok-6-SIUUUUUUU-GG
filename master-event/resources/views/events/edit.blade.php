<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Master Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('events.index') }}">Sistem Event & Workshop</a>
            <div class="navbar-nav align-items-center">
                <a class="nav-link" href="{{ route('events.index') }}">Daftar Event</a>
                <a class="nav-link" href="{{ route('events.create') }}">Tambah Event</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm ms-3" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm p-4 bg-white rounded border-0 mx-auto" style="max-width: 700px;">
            <h2 class="h4 text-primary mb-4">Edit Data Master Event</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul Event</label>
                    <input type="text" name="judul_event" class="form-control" value="{{ $event->judul_event ?? $event->judul }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required>{{ $event->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="Teknologi" {{ $event->kategori == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                        <option value="Bisnis" {{ $event->kategori == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                        <option value="Pengembangan Diri" {{ $event->kategori == 'Pengembangan Diri' ? 'selected' : '' }}>Pengembangan Diri</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Silabus</label>
                    <textarea name="silabus" class="form-control" rows="3" required>{{ $event->silabus }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Durasi Sesi (Menit)</label>
                    <input type="number" name="durasi_sesi" class="form-control" value="{{ $event->durasi_sesi ?? $event->durasi }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning">Update Event</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>