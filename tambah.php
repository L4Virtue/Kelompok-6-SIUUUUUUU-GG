<?php require 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembicara = $_POST['nama_pembicara'];
    $keahlian = $_POST['keahlian'];
    $institusi = $_POST['institusi'];
    $portofolio = $_POST['portofolio'];

    $sql = "INSERT INTO speaker (nama_pembicara, keahlian, institusi, portofolio) VALUES (?, ?, ?, ?)";
    mysqli_execute_query($conn, $sql, [$nama_pembicara, $keahlian, $institusi, $portofolio]);
    
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembicara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-slate shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SpeakerHub</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Daftar Pembicara</a>
                <a class="nav-link active" href="tambah.php">Tambah Pembicara</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="box-konten">
            
            <h2 class="fw-bold mb-4" style="color: #1e293b; margin: 0;">Formulir Tambah Data Pembicara</h2>

            <!-- Action diganti ke "tambah.php" -->
            <form action="tambah.php" method="POST">
                
                <div class="mb-4">
                    <label for="nama_pembicara" class="form-label">Nama Pembicara</label>
                    <!-- Attribute name diganti menjadi "nama_pembicara" -->
                    <input type="text" class="form-control" id="nama_pembicara" name="nama_pembicara" required>
                </div>

                <div class="mb-4">
                    <label for="keahlian" class="form-label">Profil Keahlian</label>
                    <textarea class="form-control" id="keahlian" name="keahlian" rows="3" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="institusi" class="form-label">Riwayat Institusi</label>
                    <input type="text" class="form-control" id="institusi" name="institusi" required>
                </div>

                <div class="mb-4">
                    <label for="portofolio" class="form-label">Tautan Portofolio</label>
                    <input type="url" class="form-control" id="portofolio" name="portofolio" placeholder="https://..." required>
                </div>

                <button type="submit" class="btn btn-blue">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>

            </form>

        </div>
    </div>

</body>
</html>