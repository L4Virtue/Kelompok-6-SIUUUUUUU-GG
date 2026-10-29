<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembicara - Modul Speaker</title>
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
            padding: 30px;
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
            <a class="navbar-brand fw-bold" href="#">SpeakerHub</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('speaker.index') }}">Daftar Pembicara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('speaker.create') }}">Tambah Pembicara</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="custom-card-slate">
                    
                    <h2 class="fw-bold mb-4" style="color: #1e293b; margin: 0;">Formulir Tambah Data Pembicara</h2>

                    <form action="{{ route('speaker.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama_pembicara" class="form-label fw-semibold">Nama Pembicara</label>
                            <input type="text" class="form-control" id="nama_pembicara" name="nama_pembicara" required>
                        </div>

                        <div class="mb-4">
                            <label for="keahlian" class="form-label fw-semibold">Profil Keahlian</label>
                            <textarea class="form-control" id="keahlian" name="keahlian" rows="3" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="institusi" class="form-label fw-semibold">Riwayat Institusi</label>
                            <input type="text" class="form-control" id="institusi" name="institusi" required>
                        </div>

                        <div class="mb-4">
                            <label for="portofolio" class="form-label fw-semibold">Tautan Portofolio</label>
                            <input type="url" class="form-control" id="portofolio" name="portofolio" placeholder="https://..." required>
                        </div>

                        <button type="submit" class="btn btn-blue px-4 py-2 fw-semibold">Simpan</button>
                        <a href="{{ route('speaker.index') }}" class="btn btn-secondary px-4 py-2 fw-semibold">Batal</a>

                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
</html>