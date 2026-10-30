  <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peserta Event</title>
    <!-- Bootstrap 5 CSS -->
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

    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark py-3">
            <h4 class="mb-0 fs-5 fw-bold">Formulir Edit Peserta</h4>
        </div>
        <div class="card-body p-4">
            {{-- Form action diarahkan ke route pendaftaran.update dengan method PUT --}}
            <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_peserta" class="form-label fw-semibold">Nama Peserta</label>
                    <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="{{ old('nama_peserta', $pendaftaran->nama_peserta) }}" required>
                </div>

                <div class="mb-3">
                    <label for="instansi_kampus" class="form-label fw-semibold">Asal Instansi / Kampus</label>
                    <input type="text" class="form-control" id="instansi_kampus" name="instansi_kampus" value="{{ old('instansi_kampus', $pendaftaran->instansi_kampus) }}" required>
                </div>

                <div class="mb-3">
                    <label for="nomor_kontak" class="form-label fw-semibold">Nomor Kontak (WhatsApp)</label>
                    <input type="tel" class="form-control" id="nomor_kontak" name="nomor_kontak" value="{{ old('nomor_kontak', $pendaftaran->nomor_kontak) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email_aktif" class="form-label fw-semibold">Email Aktif</label>
                    <input type="email" class="form-control" id="email_aktif" name="email_aktif" value="{{ old('email_aktif', $pendaftaran->email_aktif) }}" required>
                </div>

                <div class="d-flex justify-content-between pt-2">
                    <a href="{{ route('pendaftaran.daftar') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-warning px-4 fw-bold">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>