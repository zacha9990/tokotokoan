<?php 
$idpro = $_GET['id'];

$keranjang->hapus_keranjang($idpro);
echo "<script>alert ('Item telah dihapus dari keranjang'); location= 'index.php?halaman=keranjang';</script>";


 ?>