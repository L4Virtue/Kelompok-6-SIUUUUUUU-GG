<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta & Biodata Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1>Selamat Datang di Website Event & Workshop</h1>
    <p class="text-muted">Berikut adalah data-data dari peserta.</p>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Peserta Event & Workshop</h4>
            {{-- Sesuaikan route atau link tambah jika sudah dibuat nanti --}}
            <a href="#" class="btn btn-light btn-sm fw-bold">+ Tambah Peserta</a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped border">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Peserta</th>
                            <th>Asal Instansi/Kampus</th>
                            <th>Nomor Kontak</th>
                            <th>Email Aktif</th>
                            <th class="text-center">Aksi</th>
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
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <a href="#" class="btn btn-warning btn-sm me-1">Edit</a>
                                
                                <!-- Tombol Hapus -->
                                <a href="#" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Belum ada data peserta.</td>
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