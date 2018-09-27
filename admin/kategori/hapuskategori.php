<?php 
$idhapus= $_GET ['id'];
$kategori->hapus_kategori($idhapus);

echo "<script>alert ('Data Kategori Berhasil Dihapus'); location='index.php?halaman=kategori';</script>";
 ?>