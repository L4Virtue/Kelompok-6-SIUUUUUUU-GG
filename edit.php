<?php
include 'koneksi.php';

// Ambil ID dari URL (GET)
$id = $_GET['id'];

// Ambil data peserta berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM peserta WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

// Proses Update Data (POST)
if (isset($_POST['update'])) {
    $nama     = $_POST['nama'];
    $instansi = $_POST['instansi'];
    $kontak   = $_POST['kontak'];
    $email    = $_POST['email'];

    $sqlUpdate = "UPDATE peserta SET nama = '$nama', instansi = '$instansi', kontak = '$kontak', email = '$email' WHERE id = '$id'";
    
    if (mysqli_query($conn, $sqlUpdate)) {
        header("Location: index.php"); // Ganti ke indeks.php jika file utamamu pakai ks
        exit();
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

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
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark py-3">
            <h4 class="mb-0 fs-5 fw-bold">Formulir Edit Peserta</h4>
        </div>
        <div class="card-body p-4">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Peserta</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="instansi" class="form-label fw-semibold">Asal Instansi / Kampus</label>
                    <input type="text" class="form-control" id="instansi" name="instansi" value="<?= $data['instansi']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="kontak" class="form-label fw-semibold">Nomor Kontak (WhatsApp)</label>
                    <input type="tel" class="form-control" id="kontak" name="kontak" value="<?= $data['kontak']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Aktif</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $data['email']; ?>" required>
                </div>

                <div class="d-flex justify-content-between pt-2">
                    <a href="index.php" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" name="update" class="btn btn-warning px-4 fw-bold">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>