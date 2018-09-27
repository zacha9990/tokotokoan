<?php 
$id_pembelian = $_GET['id_beli'];
$idpel = $_GET['id_member'];

$lihat = $pembelian->ambil_detail_pembelian($id_pembelian);

foreach ($lihat as $key => $value) 
{
	$idpro = $value['id_produk'];
	$jumlah = $value['jumlah_produk'];
	$pembelian->batal_beli($idpro, $jumlah, $id_pembelian);
}
// email ke member
$to=$_SESSION['member']['email'];
$sub="Pemberitahuan Batal Beli";
$message="Kepada bpk/ibu ".$_SESSION['member']['nama_member'].",\nAnda telah berhasil membatalkan pemesanan anda dengan kode pembelian KD".$id_pembelian."\n\nTerima kasih,\nSepeda Jaya";
$email=mail($to,$sub,$message,'From: Sepeda Jaya');

// email ke admin
$to="spedajaya14@gmail.com";
$sub="Pemberitahuan Batal Beli";
$message="member ".$_SESSION['member']['nama_member'].", telah membatalkan pemesanan dengan kode pembelian KD".$id_pembelian."";
$email=mail($to,$sub,$message,'From: Sepeda Jaya');

echo "<script>alert ('Belanja Anda Telah Dibatalkan')</script>";
echo "<script>location= 'index.php?halaman=riwayat&id=$idpel';</script>";


 ?>