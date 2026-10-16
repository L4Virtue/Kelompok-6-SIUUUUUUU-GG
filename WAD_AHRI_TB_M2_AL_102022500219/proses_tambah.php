<?php

include "koneksi.php";

$tipe_tiket = $_POST["tipe_tiket"];
$harga_tiket = $_POST["harga_tiket"];
$kuota = $_POST["kuota"];
$fasilitas = $_POST["fasilitas"];

$query = "INSERT INTO tiket
          (tipe_tiket, harga_tiket, kuota, fasilitas)
          VALUES
          ('$tipe_tiket', '$harga_tiket', '$kuota', '$fasilitas')";

if (mysqli_query($koneksi, $query)) {

    header("Location: index.php");
    exit;

} else {

    echo "Data gagal disimpan: " . mysqli_error($koneksi);

}

?>