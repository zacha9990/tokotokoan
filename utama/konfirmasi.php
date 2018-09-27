<?php
// niatnya mau ngupload pembayaran untuk suatu pembelian, pembelian yg mana? yg id_nya ada di url

// a. mendapatkan id_pembelian dari url
$id_pembelian = $_GET["id"];
$tampil = $pembelian->ambil_pembelian($id_pembelian);
?>
<section class="pembayaran">
	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<div class="row">
			<div class="col-md-8">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama/Pemilik Rekening</label>
						<input type="text" class="form-control" name="nama" required="">
					</div>
					<div class="form-group">
						<label>Nama Bank Anda</label>
						<input type="text" class="form-control" name="bank" required="">
					</div>
					<div class="form-group">
						<label>No Rekening Anda</label>
						<input type="text" class="form-control" name="no" required="">
					</div>
					
					<div class="form-group">
						<label>Jumlah Transfer</label>
						<!-- <div class="pull-right"><strong><i>Rp. <?php echo number_format($tampil['total_bayar']) ?></i></strong></div> -->
						<input type="text" class="form-control" name="jumlah" value="Rp. <?php echo number_format($tampil['total_bayar']) ?>" readonly="">
					</div>
					<div class="form-group">
						<label>Foto Bukti Pembayaran</label>
						<input type="file" class="form-control" name="bukti" required="">
					</div>
					<button class="btn btn-primary" name="kirim">Kirim</button>
				</form>
				<?php
				if (isset($_POST["kirim"]))
				{
					$nama= $_FILES['bukti']['name'];
					$size = $_FILES['bukti']['size'];
					$format = pathinfo($nama, PATHINFO_EXTENSION);
					if($format=="jpg" || $format=="png")
					{
						if($size == 0)
						{
							echo "<br><div class='col-md-4 alert alert-danger'>Maksimal ukuran foto adalah 2MB</div>";
						}
						else
						{
							$konfirmasi->simpan_konfirmasi($id_pembelian,$_POST["nama"],$_POST["bank"],$_POST["no"],$tampil['total_bayar'],$_FILES["bukti"]);

							$to=$_SESSION['member']['email'];
							$sub="Pembayaran Berhasil";
							$message="Pembayaran pemesanan (KD".$id_pembelian.") sebesar ".$tampil['total_bayar']." telah berhasil.\n\nTerima kasih,\nSepeda Jaya";
							$email=mail($to,$sub,$message,'From: Sepeda Jaya');

							$to="spedajaya14@gmail.com";
							$sub="Konfirmasi Pembayaran";
							$message="Member ".$_SESSION['member']['nama_member']." telah melakukan pembayaran dengan kode pembelian: KD".$id_pembelian.".";
							$email=mail($to,$sub,$message,'From: Sepeda Jaya');

							echo "<script>alert('Terimakasih telah melakukan konfirmasi pembayaran, pesanan anda akan segera kami proses');</script>";
							echo "<script>location='index.php?halaman=riwayat';</script>";
						}
					}
					else
					{
						echo "<br><div class='col-md-4 alert alert-danger'>Format foto harus JPG/PNG</div>";
					}
				}
				?>
			</div>
			<br>
			<div class="col-md-4">
				<div class="alert alert-info">
					<ul>
						Bank Toko Sepeda Jaya:
						<li>No. Rekening: 0995-01-004651-507</li>
						<li>Bank: BRI</li>
						<li>A.n: Sepeda Jaya</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
