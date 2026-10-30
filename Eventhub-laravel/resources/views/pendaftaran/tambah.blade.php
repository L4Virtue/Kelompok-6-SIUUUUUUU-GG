<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peserta Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    
    {{-- Menampilkan pesan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Formulir Tambah Peserta</h4>
        </div>
        <div class="card-body">
            
            {{-- Form action diarahkan ke route pendaftaran.store dengan method POST --}}
            <form action="{{ route('pendaftaran.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_peserta" class="form-label">Nama Peserta</label>
                    <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="{{ old('nama_peserta') }}" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="instansi_kampus" class="form-label">Asal Instansi / Kampus</label>
                    <input type="text" class="form-control" id="instansi_kampus" name="instansi_kampus" value="{{ old('instansi_kampus') }}" placeholder="Contoh: Telkom University" required>
                </div>

                <div class="mb-3">
                    <label for="nomor_kontak" class="form-label">Nomor Kontak (WhatsApp)</label>
                    <input type="tel" class="form-control" id="nomor_kontak" name="nomor_kontak" value="{{ old('nomor_kontak') }}" placeholder="08xxxxxxxxxx" required>
                </div>

                <div class="mb-3">
                    <label for="email_aktif" class="form-label">Email Aktif</label>
                    <input type="email" class="form-control" id="email_aktif" name="email_aktif" value="{{ old('email_aktif') }}" placeholder="nama@email.com" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pendaftaran.daftar') }}" class="btn btn-secondary">Kembali ke Daftar</a>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>