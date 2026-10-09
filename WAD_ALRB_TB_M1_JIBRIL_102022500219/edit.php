
<?php
require "koneksi.php";

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipe_tiket = $_POST["tipe_tiket"];
    $harga_tiket = $_POST["harga_tiket"];
    $kuota = $_POST["kuota"];
    $fasilitas = $_POST["fasilitas"];

    $sql = "UPDATE tiket
            SET tipe_tiket = ?, harga_tiket = ?, kuota = ?, fasilitas = ?
            WHERE id = ?";

    mysqli_execute_query($koneksi, $sql, [
        $tipe_tiket,
        $harga_tiket,
        $kuota,
        $fasilitas,
        $id
    ]);

    header("Location: index.php");
    exit;
}

$result = mysqli_execute_query(
    $koneksi,
    "SELECT * FROM tiket WHERE id = ?",
    [$id]
);

$tiket = mysqli_fetch_assoc($result);

if (!$tiket) {
    die("Data tiket tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Tiket</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Tipe Tiket</label>
                <select name="tipe_tiket" class="form-select" required>
                    <option value="Early Bird" <?= $tiket["tipe_tiket"] == "Early Bird" ? "selected" : "" ?>>Early Bird</option>
                    <option value="VIP" <?= $tiket["tipe_tiket"] == "VIP" ? "selected" : "" ?>>VIP</option>
                    <option value="Regular" <?= $tiket["tipe_tiket"] == "Regular" ? "selected" : "" ?>>Regular</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga_tiket" class="form-control"
                       value="<?= htmlspecialchars((string) $tiket["harga_tiket"]) ?>" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kuota</label>
                <input type="number" name="kuota" class="form-control"
                       value="<?= htmlspecialchars((string) $tiket["kuota"]) ?>" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fasilitas Benefit</label>
                <textarea name="fasilitas" class="form-control" required><?= htmlspecialchars($tiket["fasilitas"]) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
