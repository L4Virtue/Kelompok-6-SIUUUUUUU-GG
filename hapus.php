<?php
include 'koneksi.php';

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
?>