<?php 
$idhapus= $_GET['id'];

$produk->hapus_produk($idhapus);
echo "<script>alert ('Data Produk Berhasil Dihapus'); location= 'index.php?halaman=produk';</script>";

 ?>