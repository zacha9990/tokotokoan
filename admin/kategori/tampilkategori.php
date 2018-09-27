<?php 
$tampil= $kategori->tampil_kategori();

// echo "<pre>";
// print_r($tampil);
// echo "</pre>";
 ?>

<h3><strong>Data Kategori</strong></h3>
<hr>
<table class="table table-bordered">
	<thead>
		<tr class="label-info">
			<th class="text-center">No</th>
			<th>Nama Kategori</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($tampil as $key => $value): ?>
		<tr>
			<td class="text-center"><?php echo $key+1 ?></td>
			<td><?php echo $value ['nama_kategori'] ?></td>
			<td>
				<a href="index.php?halaman=ubahkategori&id=<?php echo $value ['id_kategori'] ?>" class="btn btn-warning btn-sm" name="ubah">Ubah</a>
				<a href="index.php?halaman=hapuskategori&id=<?php echo $value ['id_kategori'] ?>" class="btn btn-danger btn-sm" name="hapus" onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini?')">Hapus</a>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<a href="index.php?halaman=tambahkategori" class="btn btn-primary" name="tambah">Tambah</a>