<?php 
$tampil = $tarif->tampil_tarif();

 ?>

<h3><strong>Data Ongkir</strong></h3>
<hr>
<table class="table table-bordered" id="table">
	<thead>
		<tr class="label-info">
			<th>No</th>
			<th>Provinsi</th>
			<th>Kota/Kabupaten</th>
			<th>Biaya/Kg</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
			<?php foreach ($tampil as $key => $value): ?>
		<tr>
			<td><?php echo $key+1?></td>
			<td><?php echo $value['nama_provinsi'] ?></td>
			<td><?php echo $value['nama_kota'] ?></td>
			<td>Rp. <?php echo number_format($value['biaya']) ?></td>
			<td>
				<a class="btn btn-warning btn-sm btn-block" href="index.php?halaman=ubah_tarif&id=<?php echo $value['id_tarif_bus'] ?>">Ubah</a>
			</td>
		</tr>
			<?php endforeach ?>
	</tbody>
</table>
<a href="index.php?halaman=tambah_tarif" class="btn btn-primary">Tambah</a>