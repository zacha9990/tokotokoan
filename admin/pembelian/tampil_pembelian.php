<h3>
	<strong>Data Pembelian</strong>
	<a href="index.php?halaman=laporan" class="btn btn-warning pull-right">Laporan</a>
</h3>
<hr>
<table class="table table-bordered" id="table">
	<thead>
		<tr class="label-info">
			<th class="text-center">No</th>
			<th>Tgl Beli</th>
			<th>Kode</th>
			<th>Nama Member</th>
			<th>Total Biaya</th>
			<th>Alamat Tujuan</th>
			<th>Status</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$datapembelian = $pembelian->tampil_pembelian();
	// echo "<pre>";
	// print_r($datapembelian);
	// echo "</pre>";
	 ?>
	<?php foreach ($datapembelian as $key => $value): ?>
		<tr>
			<td class="text-center"><?php echo $key+1 ?></td>
			<td><?php $date=date_create($value ['tgl_pembelian']);echo date_format($date,"d/m/Y");?></td>
			<td class="text-center">KD<?php echo $value ['id_pembelian'] ?></td>
			<td><?php echo $value ['nama_member'] ?></td>
			<td>Rp. <?php echo number_format($value ['total_bayar']) ?></td>
			<td><?php echo $value ['alamat_penerima'] ?></td>
			<td class="text-center">

			<?php if ($value['status_pembelian']=="Pending"): ?>
				<span class="label label-danger"><?php echo $value['status_pembelian'] ?></span>
			<?php endif ?>

			<?php if($value['status_pembelian']=='Sudah Konfirmasi'): ?>
				<span class="label label-warning"><?php echo $value['status_pembelian'] ?></span>
			<?php endif ?>

			<?php if($value['status_pembelian']=='Dikirim'): ?>
				<span class="label label-success"><?php echo $value['status_pembelian'] ?></span>
			<?php endif ?>
			</td>

			<td>
				<?php if ($value['status_pembelian']=='Sudah Konfirmasi'): ?>
				<a href="index.php?halaman=input_resi&id=<?php echo $value ['id_pembelian'] ?>" class="btn btn-warning btn-sm btn-block">Input Resi</a>
				<?php endif ?>

				<?php if ($value['status_pembelian']=='Dikirim'): ?>
				<a href="index.php?halaman=detail&id=<?php echo $value ['id_pembelian'] ?>" class="btn btn-success btn-sm btn-block">Detail</a>
				<!-- <a href="index.php?halaman=hapuspembelian" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a> -->
				<?php endif ?>
				<!-- <a href="index.php?halaman=hapus_pembelian&id=<?php echo $value['id_pembelian'] ?>" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus data pembelian ini?')">Hapus</a> -->
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>