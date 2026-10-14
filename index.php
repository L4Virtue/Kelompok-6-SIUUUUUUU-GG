<?php
// Hubungin ke file koneksi database
include 'koneksi.php';

//buat ngambil data event dari database
$query = "SELECT * FROM events ORDER BY id DESC"; 
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Event - Daftar Data</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Sistem Event & Workshop</a>
            <div class="navbar-nav">
                <a class="nav-link active" href="index.php">Daftar Event</a>
                <a class="nav-link" href="tambah.php">Tambah Event</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="custom-card shadow-sm p-4 bg-white rounded">
            
            <!-- Notifikasi Pesan Aksi -->
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'berhasil_hapus'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data event berhasil dihapus!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif ($_GET['pesan'] == 'berhasil_update'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data event berhasil diperbarui!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h4 text-primary mb-0">Daftar Master Event</h2>
                <a href="tambah.php" class="btn btn-success">+ Tambah Event Baru</a>
            </div>

            <!-- Tabel Data Event -->
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
                        <?php 
                        $no = 1;
                        // Cek apakah ada data di dalam database
                        if (mysqli_num_rows($result) > 0) {
                            // Looping data dari database
                            while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['judul_event'] ?? $data['judul'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($data['deskripsi'] ?? ''); ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= htmlspecialchars($data['kategori'] ?? ''); ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($data['silabus'] ?? ''); ?></td>
                                    <td><?= htmlspecialchars($data['durasi_sesi'] ?? $data['durasi'] ?? ''); ?> Menit</td>
                                    <td class="text-center text-nowrap">
                                        <!-- Tombol Edit -->
                                        <a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        
                                        <!-- Tombol Hapus -->
                                        <a href="hapus.php?id=<?= $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">Hapus</a>
                                    </td>
                                </tr>
                        <?php 
                            }
                        } else { 
                        ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada data event yang tersimpan.
                                </td>
                            </tr>
                        <?php 
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>