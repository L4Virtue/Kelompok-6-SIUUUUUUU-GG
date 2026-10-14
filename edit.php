<?php
include 'koneksi.php';

$pesan = '';

// Ambil data event berdasarkan ID dari URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM events WHERE id = $id");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

// Proses Update Data saat Form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_event = trim($_POST['judul_event']);
    $deskripsi   = trim($_POST['deskripsi']);
    $kategori    = trim($_POST['kategori']);
    $silabus     = trim($_POST['silabus']);
    $durasi_sesi = (int)$_POST['durasi_sesi'];

    $stmt = mysqli_prepare($koneksi, "UPDATE events SET judul_event=?, deskripsi=?, kategori=?, silabus=?, durasi_sesi=? WHERE id=?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssii", $judul_event, $deskripsi, $kategori, $silabus, $durasi_sesi, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?pesan=berhasil_update");
            exit();
        } else {
            $pesan = '<div class="alert alert-danger">Gagal memperbarui data: ' . mysqli_error($koneksi) . '</div>';
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Event - Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Sistem Event & Workshop</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Daftar Event</a>
                <a class="nav-link" href="tambah.php">Tambah Event</a>
            </div>
        </div>
    </nav>
    
    <div class="container mb-5">
        <div class="shadow-sm p-4 bg-white rounded">
            <h2 class="h4 text-primary mb-4">Formulir Edit Master Event</h2>

            <?= $pesan; ?>

            <form action="edit.php?id=<?= $id; ?>" method="POST">
                <div class="mb-3">
                    <label for="judul_event" class="form-label fw-bold">Judul Event</label>
                    <input type="text" class="form-control" id="judul_event" name="judul_event" value="<?= htmlspecialchars($data['judul_event']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-bold">Deskripsi Event</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label fw-bold">Kategori Event</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="Teknologi" <?= $data['kategori'] == 'Teknologi' ? 'selected' : ''; ?>>Teknologi</option>
                        <option value="Bisnis" <?= $data['kategori'] == 'Bisnis' ? 'selected' : ''; ?>>Bisnis</option>
                        <option value="Desain" <?= $data['kategori'] == 'Desain' ? 'selected' : ''; ?>>Desain</option>
                        <option value="Pengembangan Diri" <?= $data['kategori'] == 'Pengembangan Diri' ? 'selected' : ''; ?>>Pengembangan Diri</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="silabus" class="form-label fw-bold">Silabus Materi</label>
                    <textarea class="form-control" id="silabus" name="silabus" rows="3" required><?= htmlspecialchars($data['silabus']); ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="durasi_sesi" class="form-label fw-bold">Durasi Sesi (Menit)</label>
                    <input type="number" class="form-control" id="durasi_sesi" name="durasi_sesi" value="<?= $data['durasi_sesi']; ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>