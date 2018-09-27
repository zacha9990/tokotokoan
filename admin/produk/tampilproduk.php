<h3><strong>Data Produk</strong></h3>

<?php 
$pro= $produk->tampil_produk();

// echo "<pre>";
// print_r($pro);
// echo "</pre>";

 ?>
<hr>
<table class="table table-bordered" id="table">
	<thead>
		<tr class="label-info">
			<th class="text-center">No</th>
			<th>Nama Produk</th>
			<th>Kategori</th>
			<th>Harga</th>
			<th class="text-center">Berat</th>
			<th class="text-center">Stok</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($pro as $key => $value): ?>
		<tr>
			<td class="text-center"><?php echo $key+1 ?></td>
			<td><?php echo $value ['nama_produk'] ?></td>
			<td><?php echo $value ['nama_kategori'] ?></td>
			<td>Rp. <?php echo number_format($value ['harga']) ?></td>
			<td class="text-center"><?php echo $value ['berat'] ?> Kg</td>
			<td class="text-center"><?php echo $value ['stok'] ?></td>
			<td>
				<a href="index.php?halaman=ubahproduk&id=<?php echo $value ['id_produk'] ?>" class="btn btn-warning btn-sm">Ubah</a>
				<a href="index.php?halaman=detail_produk&id=<?php echo $value ['id_produk'] ?>" class="btn btn-info btn-sm">Detail</a>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $value ['id_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus produk ini?')">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah</a>