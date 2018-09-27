<?php 
$idhapus= $_GET ['id'];
$komentar->hapus_komentar($idhapus);

echo "<script>alert ('Data Komentar Berhasil Dihapus'); location='index.php?halaman=review';</script>";
 ?>