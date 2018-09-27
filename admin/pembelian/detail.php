<h3><strong>Detail Pembelian</strong></h3>

<hr>

<?php 
// mengambil detail pembelian yg id nya dari url
$datapembelian = $pembelian->ambil_pembelian($_GET['id']);
// echo "<pre>";
// print_r($datapembelian);
// echo "</pre>";
?>

<h4>Tanggal Pembelian : <?php $date=date_create($datapembelian ['tgl_pembelian']);echo date_format($date,"d/m/Y");?> <div class="pull-right">Kode Pembelian : <i>KD<?php echo $datapembelian ['id_pembelian'] ?></i></div></h4>

<table class="table table-bordered">
	<tr>
		<td width="50%">
			<strong>Member :</strong>
			<br>
			<?php echo $datapembelian ['nama_member'] ?> - <?php echo $datapembelian ['telepon'] ?> 
			<br>
			Alamat : <?php echo $datapembelian ['alamat'] ?>
		</td>
		<td width="50%">
			<strong>Penerima :</strong>
			<br>
			Nama : <?php echo $datapembelian ['nama_penerima'] ?> - <?php echo $datapembelian ['telp_penerima'] ?>
			<br>
			Alamat : <i><?php  echo $datapembelian ['alamat_penerima'] ?> - <?php echo $datapembelian ['kode_pos'] ?></i>
			<br>
			Kota/Kabupaten : <?php echo $datapembelian['kota'] ?>
			<br>
			Status : <span class="label label-success"><?php echo $datapembelian['status_pembelian'] ?></span>
			<br>
			Kurir : <i><?php echo $datapembelian['nama_kurir'] ?></i> - <i><?php echo $datapembelian['nama_paket'] ?></i>
			<br>
			No Resi : <i><?php echo $datapembelian['no_resi'] ?></i>
		</td>
	</tr>
</table>
<table class="table table-striped">
	<thead>
		<tr class="label-info">
			<th>Nama Produk</th>
			<th>Kuantitas</th>
			<th>Total Berat</th>
			<th>Harga</th>
			<th>Sub Total</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$detailpembelian = $pembelian->ambil_detail_pembelian($datapembelian ['id_pembelian']);
	 ?>
	 <?php foreach ($detailpembelian as $key => $dataproduk): ?>
	 	
		<tr>
			<td><?php echo $dataproduk['nama_produk'] ?></td>
			<td><?php echo $dataproduk ['jumlah_produk'] ?></td>
			<td><?php echo $dataproduk['subberat_produk'] ?> Kg</td>
			<td>Rp. <?php echo number_format($dataproduk['harga']) ?></td>
			<td>Rp. <?php echo number_format($dataproduk['subtotal_produk']) ?></td>
		</tr>
	 <?php endforeach ?>
		 <tr>
		 	<th colspan="4">Total Belanja</th>
		 	<th>Rp. <?php echo number_format($datapembelian['total_belanja']) ?></th>
		 </tr>
		 <tr>
		 	<th colspan="4">Total Ongkir</th>
		 	<th>Rp. <?php echo number_format($datapembelian['total_ongkir']) ?></th>
		 </tr>
		 <tr class="warning">
		 	<th colspan="4">Total Bayar</th>
		 	<td><strong>Rp. <?php echo number_format($datapembelian['total_bayar']) ?></strong></td>
		 </tr>
	</tbody>
</table>

<!-- <table class="table table-bordered">
	<tr>
		<th>Status Pembelian</th>
		<td>
			<?php if ($datapembelian['status_pembelian']=="Pending"): ?>
				<span class="label label-danger"><?php echo $datapembelian['status_pembelian'] ?></span>
			<?php else: ?>
				<span class="label label-success"><?php echo $datapembelian['status_pembelian'] ?></span>
				
			<?php endif ?>
		</td>
	</tr>
	<tr>
	<th>Resi Pengiriman</th>
	<td>
	<?php 
	$resi = $pembelian->ambil_resi($_GET['id']);
	 ?>
		<form action="" method="post">
			<input type="text" name="resi" class="form-control" value="<?php echo $resi ?>">
	</td>
	</tr>
</table> -->
		<!-- <button class="btn btn-primary" name="simpan">Simpan Resi</button>
		</form> -->

<!-- <?php 
if (isset($_POST['simpan'])) {
	$pembelian->simpan_resi($_POST['resi'], $_GET['id']);
	echo "<script>alert ('No Resi Tersimpan')</script>";
	echo "<script>location = 'index.php?halaman=pembelian'</script>";
}


 ?> -->