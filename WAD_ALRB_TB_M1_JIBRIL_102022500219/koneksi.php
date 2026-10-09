<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "tiket_kategori";

$koneksi = mysqli_connect($host, $user, $password, $database, 3307);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>