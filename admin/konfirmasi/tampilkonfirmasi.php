<?php 
$datakonfirmasi = $konfirmasi->tampil_konfirmasi();
// echo "<pre>";
// print_r($datakonfirmasi);
// echo "</pre>";
?>
<h3><strong>Data Konfirmasi</strong></h3>

<hr>

<table class="table table-bordered" id="table">
	<thead>
		<tr class="label-info">
			<th class="text-center">No</th>
			<th>Nama Member</th>
			<th class="text-center">Kode</th>
			<th class="text-center">Tanggal Transfer</th>
			<th class="text-center">No Rekening</th>
			<th class="text-center">Bank</th>
			<th class="text-center">Jumlah Transfer</th>
			<th class="text-center">Opsi</th>
		</tr>		
	</thead>
	<tbody>
	<?php foreach ($datakonfirmasi as $key => $value): ?>
		
		<tr>
			<td class="text-center"><?php echo $key+1 ?></td>
			<td><?php echo $value['nama_member'] ?></td>
			<td class="text-center">KD<?php echo $value['id_pembelian'] ?></td>
			<td class="text-center"><?php $date=date_create($value['tgl_transfer']);echo date_format($date,"d/m/Y");?></td>
			<td><?php echo $value['no_rek'] ?></td>
			<td class="text-center"><?php echo $value['bank'] ?></td>
			<td class="text-center">Rp. <?php echo number_format($value['jumlah_transfer']) ?></td>
			<td>
				<a href="index.php?halaman=detail_konfirmasi&id_konfirmasi=<?php echo $value['id_konfirmasi'] ?>&id_pembelian=<?php echo $value['id_pembelian'] ?>" class="btn btn-info btn-sm btn-block">Detail</a>
				<a href="index.php?halaman=hapus_konfirmasi&id_konfirmasi=<?php echo $value['id_konfirmasi'] ?>&id_pembelian=<?php echo $value['id_pembelian'] ?>" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</a>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>