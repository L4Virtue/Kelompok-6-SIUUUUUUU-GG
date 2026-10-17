<?php
require "koneksi.php";

$id = $_GET["id"];
$result = mysqli_execute_query($conn, "SELECT * FROM speaker WHERE id = ?", [$id]);
$speaker = mysqli_fetch_assoc($result);

if (!$speaker) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["update"])) {
    $nama_pembicara = $_POST["nama_pembicara"];
    $keahlian       = $_POST["keahlian"];
    $institusi      = $_POST["institusi"];
    $portofolio     = $_POST["portofolio"];

    mysqli_execute_query(
        $conn, 
        "UPDATE speaker SET nama_pembicara = ?, keahlian = ?, institusi = ?, portofolio = ? WHERE id = ?", 
        [$nama_pembicara, $keahlian, $institusi, $portofolio, $id]
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pembicara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-slate">
        <div class="container">
            <a class="navbar-brand" href="index.php">SpeakerHub</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Daftar Pembicara</a>
                <a class="nav-link" href="tambah.php">Tambah Pembicara</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="custom-card-slate">
            <h2 class="mb-4">Edit Data Pembicara</h2>

            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nama_pembicara" class="form-label">Nama Pembicara</label>
                    <input type="text" class="form-control" id="nama_pembicara" name="nama_pembicara" value="<?= htmlspecialchars($speaker['nama_pembicara']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="keahlian" class="form-label">Profil Keahlian</label>
                    <textarea class="form-control" id="keahlian" name="keahlian" rows="3" required><?= htmlspecialchars($speaker['keahlian']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="institusi" class="form-label">Riwayat Institusi</label>
                    <input type="text" class="form-control" id="institusi" name="institusi" value="<?= htmlspecialchars($speaker['institusi']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="portofolio" class="form-label">Tautan Portofolio</label>
                    <input type="url" class="form-control" id="portofolio" name="portofolio" value="<?= htmlspecialchars($speaker['portofolio']); ?>" required>
                </div>

                <div class="mt-4">
                    <button type="submit" name="update" class="btn btn-primary me-2">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>