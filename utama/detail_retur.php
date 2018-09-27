<?php 
$iddet=$_GET['id'];
$tampil=$pembelian->ambil_retur_member($iddet);
 ?>
<!-- <pre><?php print_r($tampil) ?></pre> -->
<div class="container">
	<table class="table table-bordered">
	<thead>
		<tr class="label-info">
			<th class="text-center">Tanggal Retur</th>
			<th class="text-center">Produk</th>
			<th class="text-center">Alasan</th>
			<th class="text-center">Rekening</th>
			<th class="text-center">Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="text-center"><?php $date=date_create($tampil["tanggal_retur"]);echo date_format($date,"d/m/Y");?></td>
			<td class="text-center"><?php echo $tampil["nama_produk"]; ?></td>
			<td class="text-center"><?php echo $tampil["alasan_retur"]; ?></td>
			<td class="text-center"><?php echo $tampil["rekening_retur"]; ?></td>
			<td class="text-center">
				<?php if ($tampil["status_retur"]=='Pending'): ?>
					<h4><span class="label label-danger"><?php echo $tampil["status_retur"]; ?></span></h4>
				<?php endif ?>
				<?php if ($tampil["status_retur"]=='Retur ditolak'): ?>
					<h4><span class="label label-warning"><?php echo $tampil["status_retur"]; ?></span></h4>
				<?php endif ?>
				<?php if ($tampil["status_retur"]=='Pengiriman'): ?>
					<h4><span class="label label-success"><?php echo $tampil["status_retur"]; ?></span></h4>
				<?php endif ?>
				<?php if ($tampil["status_retur"]=='Stok kosong'): ?>
					<h4><span class="label label-default"><?php echo $tampil["status_retur"]; ?></span></h4>
				<?php endif ?>
			</td>
		</tr>
	</tbody>
</table>
<a href="index.php?halaman=lihat_belanja&id_pembelian=<?php echo $tampil['id_pembelian'] ?>&id_member=<?php echo $idpel ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
<br><br>
<div class="alert alert-info col-md-5">
		<p><strong>Catatan:</strong></p>
		<p>Perubahan status retur akan dikirimkan melalui email anda</p>
</div>
</div>
<br><br><br><br><br><br><br>
<br><br><br>