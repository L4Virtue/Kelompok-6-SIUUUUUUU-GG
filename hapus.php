<?php
require 'koneksi.php';

$id = $_GET['id'];
$hasil = mysqli_query($conn, "SELECT * FROM speaker WHERE id = ?", [$id]);
?>

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="nama_pembicara" value="<?php echo $row['nama_pembicara']; ?>">
<input type="hidden" name="keahlian" value="<?php echo $row['keahlian']; ?>">
<input type="hidden" name="institusi" value="<?php echo $row['institusi']; ?>">
<input type="hidden" name="portofolio" value="<?php echo $row['portofolio']; ?>">
<input type = "submit" name="hapus" value="Hapus" class="btn btn-danger">