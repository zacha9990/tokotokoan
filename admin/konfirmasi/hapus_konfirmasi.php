<?php 
$idkon= $_GET ['id_konfirmasi'];
$idpem= $_GET ['id_pembelian'];
$konfirmasi->hapus_konfirmasi($idkon, $idpem);

echo "<script>alert ('Data Konfirmasi dan Pembelian Berhasil Dihapus'); location='index.php?halaman=konfirmasi';</script>";
 ?>