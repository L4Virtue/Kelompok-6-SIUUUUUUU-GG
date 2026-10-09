<?php
$pesan_error = "";
$hasil = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipe_tiket = $_POST["tipe_tiket"];
    $harga_tiket = $_POST["harga_tiket"];
    $kuota = $_POST["kuota"];
    $fasilitas = $_POST["fasilitas"];

    if (
        empty($tipe_tiket) ||
        empty($harga_tiket) ||
        empty($kuota) ||
        empty($fasilitas)
    ) {
        $pesan_error = "Semua data harus diisi.";
    } else {
        $hasil = [
            "tipe_tiket" => $tipe_tiket,
            "harga_tiket" => $harga_tiket,
            "kuota" => $kuota,
            "fasilitas" => $fasilitas
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event - Tambah Tiket</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Modul Tiket & Kategori</a>
            <a class="btn btn-outline-light" href="index.php">Kembali ke Daftar</a>
        </div>
    </nav>

    <div class="container">
        <div class="form-box">
            <h2 class="mb-4">Formulir Tambah Tiket</h2>
            <?php if ($pesan_error != "") { ?>
            <div class="alert alert-danger">
                <?php echo $pesan_error; ?>
            </div>
            <?php } ?>
            
            <form action="proses_tambah.php" method="POST">
                <div class="mb-3">
                    <label for="tipeTiket" class="form-label">Tipe Tiket</label>
                    <select class="form-select" id="tipeTiket" name="tipe_tiket" required>
                        <option value="">Pilih Tipe Tiket...</option>
                        <option value="Early Bird">Early Bird</option>
                        <option value="VIP">VIP</option>
                        <option value="Regular">Regular</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    </label for="hargaTiket" class="form-label">Harga Tiket (Rp)</label>
                    <input type="number" class="form-control" id="hargaTiket" name="harga_tiket" min="0">
                </div>

                <div class="mb-3">
                    <label for="kuotaTiket" class="form-label">Kuota</label>
                    <input type="number" class="form-control" id="kuotaTiket" name="kuota" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="fasilitasBenefit" class="form-label">Fasilitas Benefit</label>
                    <textarea class="form-control" id="fasilitasBenefit" name="fasilitas" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan Data Tiket</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php if ($hasil != null) { ?>

    <div class="mt-4">
        <h4>Data Tiket Berhasil Ditambahkan</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Tipe Tiket</th>
                        <th>Harga</th>
                        <th>Kuota</th>
                        <th>Fasilitas Benefit</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <?= htmlspecialchars($hasil["tipe_tiket"]); ?>
                        </td>

                        <td>
                            Rp <?= number_format($hasil["harga_tiket"], 0, ',', '.'); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($hasil["kuota"]); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($hasil["fasilitas"]); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php } ?>