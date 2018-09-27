<?php 
$iddet = $_GET['id'];
$datapro = $produk->ambil_produk($iddet);

// echo "<pre>";
// print_r($datapro);
// echo "</pre>";

?>
<h3><strong>Detail Produk</strong></h3>
<hr>
<div class="detail">
	<div class="row">
		<div class="col-md-6">
			<div>
				<img class="img-thumbnail" width="510" src="../asset/img/produk/<?php echo $datapro['foto_produk'] ?>" ">
			</div>
		</div>
		<div class="col-md-6">
			<table class="table">
				<tbody>
					<tr>
						<th width="120px">Kategori </th>
						<td><?php echo $datapro['nama_kategori'] ?></td>
					</tr>
					<tr>
						<th>Nama Produk </th>
						<td><?php echo $datapro['nama_produk'] ?></td>
					</tr>
					<tr>
						<th>Berat </th>
						<td><?php echo $datapro['berat'] ?> kg</td>
					</tr>
					<tr>
						<th>Harga </th>
						<td>Rp. <?php echo number_format($datapro['harga']) ?></td>
					</tr>
					<tr>
						<th>Stok </th>
						<td>
							<?php if ($datapro['stok']==0): ?>
								<span class="label label-danger">Kosong</span>
							<?php else: ?>
								<?php echo number_format($datapro['stok']) ?>
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<th>Deskripsi </th>
						<td><?php echo $datapro['deskripsi'] ?></td>
					</tr>
				</tbody>
			</table>
			<div class="pull-right"><a href="index.php?halaman=ubahproduk&id=<?php echo $datapro ['id_produk'] ?>" class="btn btn-warning btn-sm">Ubah Informasi Produk</a></div>
		</div>
	</div>
</div>