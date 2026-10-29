<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembicara - Modul Speaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .navbar-slate { background-color: #0f172a !important; }
        .navbar-slate .navbar-brand, .navbar-slate .nav-link { color: #ffffff !important; }
        .form-card {
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
        .btn-blue:hover { background-color: #1d4ed8; color: white; }
    </style>
</head>
<body style="background-color: #f8fafc;">
    
    <nav class="navbar navbar-expand-lg navbar-slate shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SpeakerHub</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card">
                    <h2 class="h4 fw-bold mb-3 border-bottom pb-2">Edit Data Pembicara</h2>
                    
                    <form action="{{ route('speaker.update', $speaker->id) }}" method="POST">
                        @csrf
                        @method('PUT') 

                        <div class="mb-3">
                            <label for="nama_pembicara" class="form-label fw-semibold">Nama Pembicara</label>
                            <input type="text" class="form-control" id="nama_pembicara" name="nama_pembicara" value="{{ $speaker->nama_pembicara }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="keahlian" class="form-label fw-semibold">Keahlian</label>
                            <input type="text" class="form-control" id="keahlian" name="keahlian" value="{{ $speaker->keahlian }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="institusi" class="form-label fw-semibold">Institusi / Perusahaan</label>
                            <input type="text" class="form-control" id="institusi" name="institusi" value="{{ $speaker->institusi }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="portofolio" class="form-label fw-semibold">Link Portofolio (URL)</label>
                            <input type="url" class="form-control" id="portofolio" name="portofolio" value="{{ $speaker->portofolio }}">
                        </div>

                        <button type="submit" class="btn btn-blue w-100 py-2 fw-semibold">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>