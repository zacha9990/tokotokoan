<?php 
$idhapus= $_GET ['id'];
$pembelian->hapus_retur($idhapus);

echo "<script>alert ('Data Retur Berhasil Dihapus'); location='index.php?halaman=retur';</script>";
 ?>