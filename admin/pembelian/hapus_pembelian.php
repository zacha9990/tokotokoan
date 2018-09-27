<?php 
$idhapus= $_GET ['id'];
$pembelian->hapus_pembelian($idhapus);

echo "<script>alert ('Data Pembelian Berhasil Dihapus'); location='index.php?halaman=pembelian';</script>";
 ?>