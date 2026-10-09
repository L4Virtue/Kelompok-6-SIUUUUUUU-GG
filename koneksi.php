<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "pembicara_speaker";
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_error($conn));
}
