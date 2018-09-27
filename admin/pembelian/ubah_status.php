<?php 
$idretur = $_GET['id_retur'];
$ambil=$pembelian->email_ubah_retur($idretur);
?>
<!-- <pre><?php print_r($ambil) ?></pre> -->
<form method="post">
	<div class="col-md-12">
		<div class="form-group">
			<select class="form-control" name="status">
				<option>Pilih Status</option>
				<option>Stok kosong</option>
				<option>Retur ditolak</option>
				<option>Pengiriman</option>
			</select>
		</div>
	</div>
	<br>
	<div class="col-md-12">
		<div class="form-group">
			<label>Inputkan no resi jika status pilihan "pengiriman"</label>
			<input type="text" name="resi" class="form-control">
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<button name="ubah" class="btn btn-primary">Ubah</button>
		</div>
	</div>
</form>

<?php 
if(isset($_POST['ubah']))
{
	$pembelian->ubah_status_retur($_POST['status'], $idretur);
	echo "<script>alert('Data berhasil diubah'); location='index.php?halaman=retur';</script>";

	if ($_POST['status']=='Pengiriman') 
	{
		$to=$ambil['email'];
		$sub="Retur Pembelian Diterima";
		$message="Kepada bpk/ibu ".$ambil['nama_member'].",\n\nRetur yang anda kirimkan kepada kami telah diverifikasi dan telah memenuhi kebijakan atau syarat retur kami. Dan saat ini barang anda sedang dalam proses pengiriman. Berikut no resi pengiriman: ".$_POST['resi']."\n\nTerima kasih,\nSepeda Jaya";
		$email=mail($to,$sub,$message,'From: Sepeda Jaya');
	} 
	if ($_POST['status']=='Retur ditolak') 
	{
		$to=$ambil['email'];
		$sub="Retur Pembelian Ditolak";
		$message="Kepada bpk/ibu ".$ambil['nama_member'].",\n\nMohon maaf retur yang anda kirimkan kepada kami tidak memenuhi kebijakan atau syarat retur kami, sehingga uang anda tidak dapat kami kembalikan kecuali uang ongkir. Uang ongkir anda akan kami kembalikan dalam 2x24 jam.\n\nTerima kasih,\nSepeda Jaya";
		$email=mail($to,$sub,$message,'From: Sepeda Jaya');
	} 
	if ($_POST['status']=='Stok kosong') 
	{
		$to=$ambil['email'];
		$sub="Retur Pembelian";
		$message="Kepada bpk/ibu ".$ambil['nama_member'].",\n\nRetur yang anda kirimkan kepada kami telah diverifikasi dan telah memenuhi kebijakan atau syarat retur kami. Namun stok barang untuk barang yang anda retur sedang kosong, sehingga uang anda termasuk ongkos kirim akan kami kembalikan dalam 5-7 hari.\n\nTerima kasih,\nSepeda Jaya";
		$email=mail($to,$sub,$message,'From: Sepeda Jaya');
	} 
		
		
}

 ?>