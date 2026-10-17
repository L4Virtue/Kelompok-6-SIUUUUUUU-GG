<?php
require "koneksi.php";
$id = $_GET["id"];
mysqli_execute_query($conn,
    "DELETE FROM speaker WHERE id = ?", [$id]);
header("Location: index.php");
exit;
?>