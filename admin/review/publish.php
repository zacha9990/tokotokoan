<?php 
$id= $_GET ['id'];
$komentar->publish($id);

echo "<script>alert ('Komentar Berhasil di Publish'); location='index.php?halaman=review';</script>";
 ?>