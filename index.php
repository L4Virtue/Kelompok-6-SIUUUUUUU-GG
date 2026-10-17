<?php 
include 'koneksi.php'; 

// Proses Hapus Data (DELETE)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sqlDelete = "DELETE FROM peserta WHERE id = '$id'";
    
    if (mysqli_query($conn, $sqlDelete)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}

// Mengambil data dari database (SELECT)
$sql = "SELECT * FROM peserta";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Daftar Peserta & Biodata Event </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1> Selamat Datang di website Event & Workshop </h1>
    <p> Berikut adalah data data dari peserta </p>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Peserta Event & Workshop</h4>
            <a href="tambah.php" class="btn btn-light btn-sm fw-bold">+ Tambah Peserta</a>
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
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) : 
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['instansi']; ?></td>
                            <td><?= $row['kontak']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td class="text-center">
                                <a href="index.php?hapus=<?= $row['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>    
                </table>    
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>