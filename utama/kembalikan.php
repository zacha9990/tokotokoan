<?php 
$id_detail_pembelian = $_GET["id"];
$detpel = $pembelian->detail_detail_pembelian($id_detail_pembelian);
$id_pembelian = $detpel["id_pembelian"];
$id_member = $_SESSION['member']['id_member'];
// echo "<pre>";
// print_r($detpel);
// echo "</pre>";

$a=$detpel['total_ongkir'];
$b=$detpel['total_berat'];
$hasil1=$a/$b;
$hasil2=$hasil1*$detpel['subberat_produk'];
?>
<!-- <pre><?php print_r($detpel) ?></pre> -->
<div class="container">
	
	<div class="row">
		<div class="col-md-8">
			<div class="alert alert-info">
				Anda akan meretur atau mengembalikan produk <?php echo $detpel["nama_produk"] ?>
				 dengan harga Rp. <?php echo number_format($detpel["harga"]) ?>
			</div>
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Alasan Retur</label>
					<textarea class="form-control" name="alasan" required=""></textarea>
				</div>
				<div class="form-group">
					<label>Ongkos Pengiriman Retur</label>
					<input type="text" name="ongkos" readonly="" value="Rp. <?php echo number_format(
						$hasil2); ?>" class="form-control">
				</div>
				<div class="form-group">
					<label>Rekening Untuk Pengembalian Dana</label>
					<textarea class="form-control" name="rekening" required=""></textarea>
				</div>
				<div class="form-group">
					<label>Bukti Transfer Ongkos</label>
					<div class="pull-right">
						<label>Bukti Kondisi Produk</label>
						<input type="file" name="bukti_retur" required="">
					</div>
					<input type="file" name="bukti_ongkos" required="">
				</div>
				<button class="btn btn-primary" name="kirim">Kirim</button>
			</form>

		</div>
		<div class="col-md-4">
			<div class="alert alert-danger">
					Maksimal pengembalian adalah 7 hari setelah barang diterima, <a href="index.php?halaman=Kebijakan_retur"><strong>baca kebijakan retur.</strong></a>
			</div>
			<div class="alert alert-info">
					<ul>
						<li>Ongkos pengiriman retur untuk biaya pengiriman dari toko ke pembeli.</li>
						<li>Silahkan anda transfer sesuai nominal yang sudah tertera disamping.</li>
						<li>Inputkan no. rekening anda lengkap dengan nama bank dan nama pemilik rekening.</li>
					</ul>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST["kirim"]))
{
	$nama1= $_FILES['bukti_retur']['name'];
	$nama2= $_FILES['bukti_ongkos']['name'];
	$size1 = $_FILES['bukti_retur']['size'];
	$size2 = $_FILES['bukti_ongkos']['size'];
	$format1 = pathinfo($nama1, PATHINFO_EXTENSION);
	$format2 = pathinfo($nama2, PATHINFO_EXTENSION);

	if($format1=="jpg" || $format1=="png" && $format2=="jpg" || $format2=="png")
	{
		if($size1==0 && $size2>0 || $size1>0 && $size2==0 || $size1==0 && $size2==0)
		{
			echo "<br><div class='col-md-3 col-sm-offset-1 alert alert-danger'>Maksimal ukuran foto adalah 2MB</div><br>";
		}
		else
		{
			$pembelian->retur_pembelian($id_detail_pembelian,$_POST["alasan"],$_POST["rekening"],$_FILES["bukti_ongkos"],$_FILES["bukti_retur"]);

			echo "<script>alert('terimakasih, retur anda akan kami tidak lanjuti');</script>";
			echo "<script>location='index.php?halaman=lihat_belanja&id_pembelian=$id_pembelian&id_member=$id_member';</script>";

			// ke member
			$to=$_SESSION['member']['email'];
			$sub="Anda Telah Meretur Produk";
			$message="Anda telah meretur atau mengembalikan produk ".$detpel['nama_produk']." dengan alasan ".$_POST['alasan'].". Silahkan anda tunggu, retur akan segera kami proses setelah barang datang.\n\nTerima kasih,\nSepeda Jaya";
			$email=mail($to,$sub,$message,'From: Sepeda Jaya');

			// ke admin
			$to="spedajaya14@gmail.com";
			$sub="Pemberitahuan Retur Pembelian";
			$message="Member bernama ".$_SESSION['member']['nama_member'].", akan meretur atau mengembalikan produk ".$detpel['nama_produk']." dengan alasan ".$_POST['alasan'].".";
			$email=mail($to,$sub,$message,'From: Sepeda Jaya');
		}
	}
	else
	{
		echo "<br><div class='col-md-3 col-sm-offset-1 alert alert-danger'>Format foto harus JPG/PNG</div><br>";
	}

	
	// else
	// {
	
	// }
}
?>
<br><br>