<?php
include "koneksi.php";

$sql = "SELECT * FROM tiket";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event - Daftar Tiket</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Modul Tiket & Kategori</a>
            <a class="btn btn-outline-light" href="tambah.php">Tambah Tiket Baru</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-3">Daftar Kategori Tiket</h2>
        <table class="table table-striped table-bordered custom-table-spacing">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tipe Tiket</th>
                    <th>Harga (Rp)</th>
                    <th>Kuota</th>
                    <th>Fasilitas Benefit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                <tbody>
<?php
while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><strong><?= $row['tipe_tiket']; ?></strong></td>
        <td>Rp <?= number_format($row['harga_tiket'], 0, ',', '.'); ?></td>
        <td><?= $row['kuota']; ?></td>
        <td><?= $row['fasilitas']; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id']; ?>" class="btn-warning btn--sm">Edit</a>
            <a href="hapus.php?id=<?= $row['id']; ?>"class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus tiket ini?')">Hapus</a>
        </td>
    </tr>
<?php
}
?>
</tbody>
        </table>
    </div>

</body>
</html>