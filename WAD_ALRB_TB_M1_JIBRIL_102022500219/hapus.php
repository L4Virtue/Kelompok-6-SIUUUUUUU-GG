
<?php
require "koneksi.php";

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];

    mysqli_execute_query(
        $koneksi,
        "DELETE FROM tiket WHERE id = ?",
        [$id]
    );
}

header("Location: index.php");
exit;
