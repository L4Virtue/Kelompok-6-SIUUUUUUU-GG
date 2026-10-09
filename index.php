<?php
require 'koneksi.php'; 
$result = mysqli_query($conn, "SELECT * FROM speaker");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembicara - Modul Speaker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-slate shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SpeakerHub</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Daftar Pembicara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Tambah Pembicara</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="custom-card-slate">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold" style="color: #1e293b; margin: 0;">Daftar Pembicara / Speaker</h2>
                <a href="tambah.php" class="btn btn-blue px-3 py-2 fw-semibold">+ Tambah Pembicara</a>
            </div>

            <div class="table-responsive">
                <table class= "table table-striped table-hover align-middle mb-0 table-outlined-slate">
                    <thead>
                        <tr>
                            <th class="fw-bold">No</th>
                            <th class="fw-bold">Nama Pembicara</th>
                            <th class="fw-bold">Keahlian</th>
                            <th class="fw-bold">Institusi</th>
                            <th class="fw-bold">Portofolio</th>
                            <th class="fw-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['nama_pembicara']; ?></td>
                            <td><?php echo $row['keahlian']; ?></td>
                            <td><?php echo $row['institusi']; ?></td>
                            <td><a href="<?php echo $row['portofolio']; ?>" target="_blank" class="btn btn-sm btn-outline-blue">Lihat Portfolio</a></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pembicara ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
                            