<?php 
$idhapus= $_GET['id'];

$hapus= $member->hapus_member($idhapus);
echo "<script>alert ('Data Telah Terhapus'); location='index.php?halaman=member';</script>";

 ?>