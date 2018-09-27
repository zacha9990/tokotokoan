<?php 
if(!isset($_SESSION['member']))
{
	echo "<script>alert('silakan login dulu')</script>";
	echo "<script>location='index.php?halaman=login'</script>";
	exit();
}

$data_provinsi = $ongkir->tampil_provinsi();

if (isset($_POST['provinsi'])) 
{
	$provinsi = $_POST['provinsi'];
}
else
{
	$provinsi = '';
}

if (isset($_POST['kota'])) 
{
	$kota = $_POST['kota'];
}
else
{
	$kota = '';
}

if (isset($_POST['ekspedisi'])) 
{
	$ekspedisi = $_POST['ekspedisi'];
}
else
{
	$ekspedisi = '';
}

if (isset($_POST['ongkir'])) 
{
	$ongkos = $_POST['ongkir'];
}
else
{
	$ongkos = '';
}
$data_kota = $ongkir->tampil_kota($provinsi);
$hasil = explode(".", $ongkos);
$hslkota = explode(".", $kota);


if(isset($_POST['jasa']))
{
	$jasa = $_POST['jasa'];	
	echo "<script>location='index.php?halaman=checkout_$jasa'</script>";
}
else
{
	$jasa="";
}
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
			<?php $ongkirnya = 0; ?>
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
				<?php $jml+=$value ['jumlah'] ?>
				<?php $totalberat+=$value['sub_berat'];  ?>
				<?php $totalbelanja+=$value['sub_total'];  ?>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6">Total Belanja</th>
				<th class="text-center">Rp. <?php echo number_format($totalbelanja) ?></th>
			</tr>
			<tr>
				<th colspan="6">Total Ongkir</th>
				<th class="text-center"><?php if ($ongkos==""){echo "";} else {echo "Rp. ".number_format($ongkirnya=$hasil[0]*$totalberat);}?></th>
			</tr>
			<?php $bayarnya=$totalbelanja+$ongkirnya;  ?>
			<tr class="warning">
				<th colspan="6">Total Biaya</th>
				<th class="text-center"><?php if($ongkos==""){echo "";} else {echo "Rp. ".number_format($bayarnya);} ?></th>
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
				<div class="col-md-3">
						<div class="form-group">
							<label>Provinsi</label>
							<select class="form-control" name="provinsi" onchange="submit()" required="">
								<option value="">Pilih Provinsi</option>
								<?php foreach ($data_provinsi as $key => $value): ?>
									<option value="<?php echo $value['province_id']; ?>" <?php if ($provinsi==$value['province_id']){echo "selected";} ?>>
										<?php echo $value['province']; ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kota/Kabupaten</label>
								<select class="form-control" name="kota" onchange="submit()" required="">
									<option value="">Pilih Kota/Kabupaten</option>
									<?php if ($provinsi==""): ?>

									<?php else: ?>
										<?php foreach ($data_kota as $key => $value): ?>
											<option value="<?php echo $value['city_id'].".".$value['city_name']; ?>"
												<?php if ($kota==$value['city_id'].".".$value['city_name']) {echo "selected";} ?>>
												<?php echo $value['city_name'] ?>
											</option>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Ekspedisi</label>
								<select class="form-control" name="ekspedisi" onchange="submit()" required="">
									<option value="">Pilih Ekspedisi</option>
									<option value="jne" <?php if ($ekspedisi=="jne") {echo "selected";} ?>>JNE</option>
									<option value="tiki" <?php if ($ekspedisi=="tiki") {echo "selected";} ?>>TIKI</option>
									<option value="pos" <?php if ($ekspedisi=="pos") {echo "selected";} ?>>POS</option>
								</select>
							</div>
						</div>
						<?php $data_ongkir = $ongkir->tampil_ongkir($kota, $totalberat,$ekspedisi); ?>
						<!-- <pre><?php print_r($data_ongkir) ?></pre> -->
						<div class="col-md-3">
							<div class="form-group">
								<label>Paket</label>
								<select class="form-control" name="ongkir" required="" onchange="submit()">
									<option value="">Pilih Paket</option>
									<?php if ($ekspedisi==""): ?>

									<?php else: ?>
										<?php foreach ($data_ongkir as $key => $value): ?>
											<option value="<?php echo $value['cost']['0']['value'].".".$value['service']; ?>" <?php if($ongkos==$value['cost']['0']['value'].".".$value['service']) {echo "selected";} ?>><?php echo $value['service']." - Rp ".number_format($value['cost']['0']['value']); ?></option>
										<?php endforeach ?>
									<?php endif ?>
								</select>
							</div>
						</div>
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
			<div style="display: none;">
				<?php 
				if($ekspedisi=='jne')
				{
					$kurir='JNE';
				}
				

				if($ekspedisi=='tiki')
				{
					$kurir='TIKI';
				}
				

				if($ekspedisi=='pos')
				{
					$kurir='POS';
				}
				
				?>
				<input type="text" name="kurir" value="<?php echo $kurir ?>">
				<input type="text" name="nama_paket" value="<?php echo $hasil[1] ?>">
				<input type="text" name="nama_kota" value="<?php echo $hslkota[1] ?>">
			</div>
		</form>
	<?php 

	$status = "Pending";
	$tgl = date("Y-m-d");
	$id_pel = $_SESSION['member']['id_member'];
	if(isset($_POST['selesai']))
	{
		$idpembelian = $pembelian->tambah_pembelian($id_pel, $tgl, $jml, $totalbelanja, $totalberat, $ongkirnya, $bayarnya, $status, $_POST['nama_penerima'], $_POST['telp_penerima'], $_POST['alamat_penerima'], $_POST['nama_kota'], $_POST['nama_paket'], $_POST['kode_pos'], $_POST['kurir']);

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
		$message="Kepada bpk/ibu ".$_SESSION['member']['nama_member'].",\nTerima kasih sudah melakukan pembelian di Toko Sepeda Jaya. Berikut detail pembelian anda:\n\nJumlah Produk : ".$jml."\nTotal Belanja : Rp. ".number_format($totalbelanja)."\nTotal Ongkir : Rp. ".number_format($ongkirnya)."\nTotal Biaya yang harus dibayarkan sebesar Rp. ".number_format($bayarnya)."\n\nSilahkan anda melakukan pembayaran dalam waktu 1x24 jam ke bank berikut.\n\nNo. Rekening: 0995-01-004651-507\nA.n: Sepeda Jaya\nBank: BRI\n\nTerima kasih,\nSepeda Jaya";
		$email=mail($to,$sub,$message,'From: Sepeda Jaya');

		// email ke admin
		$to="spedajaya14@gmail.com";
		$sub="Pembelian Baru";
		$message="Pembelian baru dari ".$_SESSION['member']['nama_member'].",\nBerikut detail pembelian:\n\nJumlah Produk : ".$jml."\nTotal Belanja : Rp. ".number_format($totalbelanja)."\nTotal Ongkir : Rp. ".number_format($ongkirnya)."\nTotal Biaya : Rp. ".number_format($bayarnya).".";
		$email=mail($to,$sub,$message,'From: Sepeda Jaya');

		unset($_SESSION['keranjang']);
		echo "<script>alert ('Pembelian Berhasil Silakan Cek Email Anda Untuk Melakukan Pembayaran') </script>";
		echo "<script>location= 'index.php?halaman=riwayat'</script>";
	}
	

	?>
</div>

<!-- <script src="jquery-3.2.1.min.js"></script> -->
<!-- <script src="../asset/js/jquery.priceformat.js"></script> -->


<!-- <script>
	$(function(){
	$('#iii').priceFormat({
    prefix: 'Rp. ',
    thousandsSeparator: ',',
    centsLimit: 0
})
	});
</script> -->
