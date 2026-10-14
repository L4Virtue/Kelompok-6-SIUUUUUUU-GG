<?php
// Hubungkan ke database
include 'koneksi.php';

$pesan = '';

// Cek apakah form sudah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_event = trim($_POST['judul_event']);
    $deskripsi   = trim($_POST['deskripsi']);
    $kategori    = trim($_POST['kategori']);
    $silabus     = trim($_POST['silabus']);
    $durasi_sesi = (int)$_POST['durasi_sesi'];

    // Simpan ke database menggunakan Prepared Statement agar aman dari SQL Injection
    $stmt = mysqli_prepare($koneksi, "INSERT INTO events (judul_event, deskripsi, kategori, silabus, durasi_sesi) VALUES (?, ?, ?, ?, ?)");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $judul_event, $deskripsi, $kategori, $silabus, $durasi_sesi);
        
        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke index.php jika berhasil
            header("Location: index.php");
            exit();
        } else {
            $pesan = '<div class="alert alert-danger mb-4">Gagal menyimpan data: ' . mysqli_error($koneksi) . '</div>';
        }
        mysqli_stmt_close($stmt);
    } else {
        $pesan = '<div class="alert alert-danger mb-4">Error Query: ' . mysqli_error($koneksi) . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Event - Tambah Data</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Sistem Event & Workshop</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Daftar Event</a>
                <a class="nav-link active" href="tambah.php">Tambah Event</a>
            </div>
        </div>
    </nav>
    
    <!-- Content -->
    <div class="container mb-5">
        <div class="custom-card shadow-sm p-4 bg-white rounded">
            <h2 class="h4 text-primary mb-4">Formulir Tambah Master Event</h2>

            <!-- Tampilkan pesan alert jika ada error -->
            <?= $pesan; ?>

            <form action="tambah.php" method="POST">
                
                <div class="mb-3">
                    <label for="judul_event" class="form-label fw-bold">Judul Event</label>
                    <input type="text" class="form-control" id="judul_event" name="judul_event" placeholder="Masukkan judul event" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi Event</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi event" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label fw-bold">Kategori Event</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="" selected disabled>-- Pilih Kategori --</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Bisnis">Bisnis</option>
                        <option value="Desain">Desain</option>
                        <option value="Pengembangan Diri">Pengembangan Diri</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="silabus" class="form-label fw-bold">Silabus Materi</label>
                    <textarea class="form-control" id="silabus" name="silabus" rows="3" placeholder="Masukkan materi/silabus event" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="durasi_sesi" class="form-label fw-bold">Durasi Sesi (Menit)</label>
                    <input type="number" class="form-control" id="durasi_sesi" name="durasi_sesi" placeholder="Contoh: 120" min="1" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>