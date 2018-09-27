<div class="container">
	<?php 
	$idbeli = $_GET['id'];

	$detailbeli = $pembelian->ambil_pembelian($idbeli);

	$produkbeli = $pembelian->ambil_detail_pembelian($idbeli);

	// echo "<pre>";
	// print_r($detailbeli);
	// echo "</pre>";
	// echo "<pre>";
	// print_r($produkbeli);
	// echo "</pre>";


	?>
	<h1>Nota Belanja</h1>

	<div class="row">
		<div class="col-md-4">
			<h3>Sepeda Jaya</h3>
			<p>
				Alamat	: Pasar 2 Kotagajah, Kec. Kotagajah, Kab. Lampung Tengah - 34153 <br>
				Email	: sepedajaya@gmail.com <br>
				SMS/WA	: 081379634664 <br>
				BBM	: 5BE1B230
			</p>
		</div>
		<div class="col-md-4">
			<h3>Detail Member</h3>
			<p>
				Nama: <?php echo $detailbeli['nama_member'] ?><br>
				Email: <?php echo $detailbeli['email'] ?><br>
				Telepon: <?php echo $detailbeli['telepon'] ?><br>
				Alamat: <?php echo $detailbeli['alamat'] ?><br>
			</p>
		</div>
		<div class="col-md-4">
		<h3>Detail Pengiriman</h3>
			<p>
				Kurir: <?php echo $detailbeli['nama_kurir'] ?><br>
				Paket: <?php echo $detailbeli['nama_paket'] ?><br>
				Nama Penerima: <?php echo $detailbeli['nama_penerima'] ?><br>
				Telepon Penerima: <?php echo $detailbeli['telp_penerima'] ?><br>
				Alamat Penerima: <?php echo $detailbeli['alamat_penerima'] ?><br>
				Kota/Kabupaten: <?php echo $detailbeli['kota'] ?><br>
				Kodepos: <?php echo $detailbeli['kode_pos'] ?>
			</p>
		</div>
	</div>
	<br>
	<!-- <pre><?php print_r($produkbeli) ?></pre> -->
	<table class="table table-bordered table-hover table-striped">
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
			<?php foreach ($produkbeli as $key => $value): ?>
				<tr>
					<td class="text-center"><?php echo $key+1 ?></td>
					<td><?php echo $value['nama_produk'] ?></td>
					<td class="text-center"><?php echo $value['jumlah_produk'] ?></td>
					<td class="text-center"><?php echo $value['berat'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value['harga']) ?></td>
					<td class="text-center"><?php echo $value['subberat_produk'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value['subtotal_produk']) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<div class="row">
		<div class="col-md-6">
			<h4><i>Kode Pembelian: KD<?php echo $detailbeli ['id_pembelian'] ?></i></h4>
			<!-- <div class="alert alert-info">Silahkan melakukan pembayaran ke Bank xxx</div> -->
		</div>
		<div class="col-md-6">
			<table class="table">
				<tr>
				<th>Total Belanja</th>
					<th class="text-center">Rp. <?php echo number_format($detailbeli['total_belanja']) ?></th>
				</tr>
				<tr>
					<th>Total Ongkir</th>
					<th class="text-center">Rp. <?php echo number_format($detailbeli['total_ongkir']) ?></th>
				</tr>
				<tr class="warning">
					<th>Total Biaya</th>
					<th class="text-center">Rp. <?php echo number_format($detailbeli['total_bayar']) ?></th>
				</tr>
			</table>
		</div>
	</div>
</div>