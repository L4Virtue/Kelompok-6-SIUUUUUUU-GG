<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "masster data event"; // Sesuaikan dengan nama 

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi berhasil
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>