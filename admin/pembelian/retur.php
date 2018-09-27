<h3><strong>Data Retur</strong></h3>
<hr>
<table class="table table-bordered" id="table">
	<thead>
		<tr class="label-info">
			<th>No</th>
			<th>Kode</th>
			<th>Member</th>
			<th>Produk</th>
			<th>Tanggal</th>
			<th>Alasan</th>
			<th>Rekening</th>
			<th>Status</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $dataret = $pembelian->tampil_retur(); ?>
		<?php foreach ($dataret as $key => $value): ?>
			
		<tr>
			<td><?php echo $key+1; ?></td>
			<td>KD<?php echo $value['id_pembelian'] ?></td>
			<td><?php echo $value['nama_member'] ?></td>
			<td><?php echo $value["nama_produk"]; ?></td>
			<td><?php $date=date_create($value["tanggal_retur"]);echo date_format($date,"d/m/Y");?></td>
			<td><?php echo $value["alasan_retur"]; ?></td>
			<td><?php echo $value["rekening_retur"]; ?></td>
			<td class="text-center">
				<?php if ($value["status_retur"]=='Pending'): ?>
					<h5><span class="label label-danger"><?php echo $value["status_retur"]; ?></span></h5>
				<?php endif ?>
				<?php if ($value["status_retur"]=='Retur ditolak'): ?>
					<h5><span class="label label-warning"><?php echo $value["status_retur"]; ?></span></h5>
				<?php endif ?>
				<?php if ($value["status_retur"]=='Pengiriman'): ?>
					<h5><span class="label label-success"><?php echo $value["status_retur"]; ?></span></h5>
				<?php endif ?>
				<?php if ($value["status_retur"]=='Stok kosong'): ?>
					<h5><span class="label label-default"><?php echo $value["status_retur"]; ?></span></h5>
				<?php endif ?>
			</td>
			<td>
				<a class="btn btn-info btn-sm btn-block" href="index.php?halaman=bukti_retur&id=<?php echo $value['id_retur'] ?>">Lihat Foto</a>
				<a class="btn btn-warning btn-sm btn-block" href="index.php?halaman=ubah_status&id_retur=<?php echo $value['id_retur'] ?>">Ubah</a>
				<a class="btn btn-danger btn-sm btn-block" href="index.php?halaman=hapus_retur&id=<?php echo $value['id_retur'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini?')">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>