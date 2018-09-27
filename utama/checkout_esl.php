<?php 
if(!isset($_SESSION['member']))
{
	echo "<script>alert('silakan login dulu')</script>";
	echo "<script>location='index.php?halaman=login'</script>";
	exit();
}

if(isset($_POST['jasa']))
{
	$jasa = $_POST['jasa'];	
	echo "<script>location='index.php?halaman=checkout_$jasa'</script>";
}
else
{
	$jasa="";
}
if (isset($_POST['id_prov'])) 
{
	$id_prov = $_POST['id_prov'];
}
else
{
	$id_prov="";
}
if (isset($_POST['id_kota'])) 
{
	$id_kota = $_POST['id_kota'];
}
else
{
	$id_kota="";
}
// if (isset($_POST['ongkir'])) 
// {
// 	$ongkir = $_POST['ongkir'];
// }
// else
// {
// 	$ongkir="";
// }
$dataprov = $tarif->tampil_provinsi();
$kotaprov = $tarif->tampil_kota_prov($id_prov);

$biaya = $tarif->ambil_tarif($id_kota);

?>
<?php $isikeranjang = $keranjang->tampil_keranjang(); ?>
<!-- <pre><?php print_r($isikeranjang) ?></pre> -->

<div class="container">
	<h3>Data Belanja</h3>
	<table class="table table-bordered">
		<thead>
			<tr class="label-info">
				<th class="text-center">No</th>
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Kuantitas</th>
				<th class="text-center">Berat</th>
				<th class="text-center">Harga</th>
				<th class="text-center">Subberat</th>
				<th class="text-center">Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php $totalbayar = 0; ?>
			<?php $totalberat = 0; ?>
			<?php $totalbelanja = 0; ?>
			<?php $jml = 0; ?>
			<?php $ongkir = 0; ?>
			<?php $totalbiaya = 0; ?>
			<?php foreach ($isikeranjang as $key => $value): ?>
				<tr>

					<td class="text-center"><?php echo $key+1 ?></td>
					<td><?php echo $value ['nama_produk'] ?></td>
					<td class="text-center"><?php echo $value ['jumlah'] ?></td>
					<td class="text-center"><?php echo $value ['berat'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value ['harga']) ?></td>
					<td class="text-center"><?php echo $value ['sub_berat'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value ['sub_total']) ?></td>
				</tr>
				<?php $jumlah=$jml+=$value ['jumlah'] ?>
				<?php $totalberat+=$value['sub_berat'];  ?>
				<?php $ongkir = $biaya['biaya']*$totalberat ?>
				<?php $totalbelanja+=$value['sub_total'];  ?>
				<?php $totalbiaya = $ongkir+$totalbelanja ?>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6">Total Belanja</th>
				<th class="text-center">Rp. <?php echo number_format($totalbelanja) ?></th>
			</tr>
			<tr>
				<th colspan="6">Total Ongkir</th>
				<th class="text-center">
					<?php if (($ongkir=='0') or (empty($id_prov and $id_kota))): ?>
						
					<?php else: ?>
						Rp. <?php echo number_format($ongkir) ?>
					<?php endif ?>
				</th>
			</tr>
			<tr class="warning">
				<th colspan="6">Total Biaya</th>
				<th class="text-center" id="">
					<?php if (($ongkir=='0') or (empty($id_prov and $id_kota))): ?>
						
					<?php else: ?>
						Rp. <?php echo number_format($totalbiaya) ?>
					<?php endif ?>
				</th>
			</tr>
		</tfoot>
	</table>
	<br>
	<form method="post">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Jasa Pengiriman</label>
					<select class="form-control" name="jasa" onchange="submit()">
						<option value="" disabled="">Pilih Jasa Pengiriman</option>
						<option value="jne" <?php if($_GET['halaman']=='checkout_jne'){echo "selected";} ?>>JNE / TIKI / POS</option>
						<option value="esl" <?php if($_GET['halaman']=='checkout_esl'){echo "selected";} ?>>ESL (Eka Sari Lorena)</option>
					</select>
				</div>
			</div>
		</div>
	</form>
	
		<h3>Data Pengiriman</h3>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">

						<label for="">Provinsi</label>
						<select name="id_prov" id="" class="form-control" onchange="submit()" required="">
							<option value="">Pilih Provinsi</option>	
							<?php foreach ($dataprov as $key => $value): ?>
								<option value="<?php echo $value['id_provinsi'] ?>" <?php if($id_prov==$value['id_provinsi']){echo "selected";} ?>><?php echo $value['nama_provinsi'] ?> </option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">

						<label for="">Kota/Kabupaten</label>
						<select name="id_kota" class="form-control" required="" onchange="submit()">
							<option value="">Pilih Kota</option>
							<?php foreach ($kotaprov as $key => $value): ?>
								<option value="<?php echo $value['id_kota'] ?>" <?php if($id_kota==$value['id_kota']){echo "selected";} ?> ><?php echo $value['nama_kota'] ?></option>
							<?php endforeach ?>
						</select>	
					</div>
				</div>
				<!-- <div class="col-md-4">
					<div class="form-group">

						<label for="">Ongkir</label>
						<select name="ongkir" class="form-control" required="" onchange="submit()">
							<option value=""></option>
							<option value="<?php echo $biaya['id_tarif_bus'] ?>" <?php if($ongkir==$biaya['id_tarif_bus']){echo "selected";} ?>>
								<?php if (!empty($id_prov and $id_kota)): ?>
									RPX - Rp. <?php echo $total_ongkir = $biaya['biaya']*$totalberat ?>
								<?php else: ?>
									
								<?php endif ?>
							</option>
						</select>
					</div>
				</div> -->

<!-- <?php $_SESSION['ongkir']=$total_ongkir ?> -->

				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama Penerima</label>
						<input type="text" class="form-control" name="nama_penerima" required="">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Telepon Penerima</label>
						<input type="number" class="form-control" name="telp_penerima" required="">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Kode Pos</label>
						<input type="number" class="form-control" name="kode_pos" required="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="">Alamat Penerima</label>
				<textarea name="alamat_penerima" id="" class="form-control" required=""></textarea>
			</div>
			<button class="btn btn-primary" name="selesai">Selesai</button>
		</form>
<!-- <pre><?php print_r($biaya) ?></pre> -->
<div style="display: none;">
	<form method="post">
		<!-- <input type="text" readonly=""  class="form-control" value="<?php echo $ongkos1=$biaya['biaya'] ?>"> -->
		<input type="text" readonly=""  class="form-control" value="<?php echo $namakota=$biaya['nama_kota'] ?>">
	</form>
</div>
<?php 

// foreach ($isikeranjang as $key => $value) 
// 		{
// 			$produk = $value['nama_produk'];
// $tabel=print( "<table border='1'><tr><td>".$produk."</td></tr></table>");
// 		}
 ?>
	<?php 

	$status = "Pending";
	$tgl = date("Y-m-d");
	$id_pel = $_SESSION['member']['id_member'];
	if(isset($_POST['selesai']))
	{
		if ($ongkir=='') 
		{
			echo "<script>
			alert('Maaf ongkir untuk kota yang anda pilih saat ini belum tersedia')</script>";
			// location='index.php?halaman=checkout_esl';
		}
		else
		{
		$paket = "RPX";
		$kurir = "ESL";

		$idpembelian = $pembelian->tambah_pembelian($id_pel, $tgl, $jumlah, $totalbelanja, $totalberat, $ongkir, $totalbiaya, $status, $_POST['nama_penerima'], $_POST['telp_penerima'], $_POST['alamat_penerima'], $namakota, $paket, $_POST['kode_pos'], $kurir);

		foreach ($isikeranjang as $key => $value) 
		{
			$idpro = $value['id_produk'];
			$jumlah = $value['jumlah'];
			$subberat= $value['sub_berat'];
			$subtotal= $value['sub_total'];

			$pembelian->simpan_detail_pembelian($idpembelian, $idpro, $jumlah, $subberat, $subtotal);
		}
		
	   // email ke member
		$to=$_SESSION['member']['email'];
		$sub="Pemberitahuan Detail Pemesanan";
		$message="Kepada bpk/ibu ".$_SESSION['member']['nama_member'].",\nTerima kasih sudah melakukan pembelian di Toko Sepeda Jaya. Berikut detail pembelian anda:\n\nJumlah Produk : ".$jumlah."\nTotal Belanja : Rp. ".number_format($totalbelanja)."\nTotal Ongkir : Rp. ".number_format($ongkir)."\nTotal Biaya yang harus dibayarkan sebesar Rp. ".number_format($totalbiaya)."\n\nSilahkan anda melakukan pembayaran dalam waktu 1x24 jam ke bank berikut.\n\nNo. Rekening: 0995-01-004651-507\nA.n: Sepeda Jaya\nBank: BRI\n\nTerima kasih,\nSepeda Jaya";
		$email=mail($to,$sub,$message,'From: Sepeda Jaya');

		// email ke admin
		$to="spedajaya14@gmail.com";
		$sub="Pembelian Baru";
		$message="Pembelian baru dari ".$_SESSION['member']['nama_member'].",\nBerikut detail pembelian:\n\nJumlah Produk : ".$jml."\nTotal Belanja : Rp. ".number_format($totalbelanja)."\nTotal Ongkir : Rp. ".number_format($ongkir)."\nTotal Biaya : Rp. ".number_format($totalbiaya).".";
		$email=mail($to,$sub,$message,'From: Sepeda Jaya');
		
		unset($_SESSION['keranjang']);
		echo "<script>alert ('Pembelian Berhasil Silakan Cek Email Anda Untuk Melakukan Pembayaran') </script>";
		echo "<script>location= 'index.php?halaman=riwayat'</script>";
		}

// include('../phpmailer/class.phpmailer.php');
// include('../phpmailer/class.smtp.php');
// $mail = new PHPMailer();

// $mail->Host     = "ssl://smtp.gmail.com"; 
// $mail->Mailer   = "smtp";
// $mail->SMTPAuth = true; 

// $mail->Username = "sepedajaya14@gmail.com"; 
// $mail->Password = "sepedajaya123";
// $webmaster_email = "sepedajaya14@gmail.com"; 
// $email = "alvarokah@gmail.com";
// $name = "Barokah"; 
// $mail->From = $webmaster_email;
// $mail->FromName = "Sepeda Jaya";
// $mail->AddAddress($email,$name);
// $mail->AddReplyTo($webmaster_email,"Sepeda Jaya");
// $mail->WordWrap = 50; 
// //$mail->AddAttachment("module.txt"); // attachment
// //$mail->AddAttachment("new.jpg"); // attachment
// $mail->IsHTML(true); 
// $mail->Subject = "Ini adalah subject";
// $mail->Body = "Ini adalah isi dari email"; 
// $mail->AltBody = "This is the body when user views in plain text format"; 
// if(!$mail->Send())
// {
// echo "Mailer Error: " . $mail->ErrorInfo;
// }
// else
// {
// echo "email berhasil dikirim";
// }

	}
	

	?>
</div>

<script src="jquery-3.2.1.min.js"></script>
<!-- <script src="../asset/js/jquery.priceformat.js"></script>
<script>
	$(function(){
	$('#ongkirnya').priceFormat({
    prefix: 'Rp. ',
    thousandsSeparator: ',',
    centsLimit: 0
});
	})
</script> -->

<!-- <script type="text/javascript">
	$(document).ready(function(){
		$("#ongkirnya").on("change", function(){
			var totalbert = $("input[name=tober]").val();
			var ongkir = $("input[name=ongkir]").val();
			var totalongkir = parseInt(totalbert)*parseInt(ongkir);
			$("#totong").val(totalongkir);
		})
	})
</script> -->

<br><br><br><br><br><br><br>