<?php 
$idkon = $_GET['id_konfirmasi'];
$idbeli = $_GET['id_pembelian'];

$konfir = $konfirmasi->ambil_konfirmasi($idkon,$idbeli);
// echo "<pre>";
// print_r($komen);
// echo "</pre>";
?>
<h3><strong>Detail Konfirmasi</strong></h3>
<hr>
<div class="detail">
		<div class="row">
			<div class="col-md-4">
				<div>
					<center><img class="img-thumbnail" width="300" src="../asset/img/konfirmasi/<?php echo $konfir['bukti_transfer'] ?>"></center>
					<center><i><strong>Foto Bukti Transfer</strong></i></center>
				</div>
			</div>
			<div class="col-md-8">
				<table class="table">
					<tbody>
						<tr class="info">
							<th width="170px">Kode Pembelian : KD<?php echo $konfir['id_pembelian'] ?></th>
							<td class="text-right"><strong>Total Pembelian : <i>Rp. <?php echo number_format($konfir['total_bayar']) ?></i></strong></td>
						</tr>
						<tr>
							<th>Nama Member </th>
							<td><?php echo $konfir['nama_member'] ?></td>
						</tr>
						<tr>
							<th>Tgl Pembelian </th>
							<td><?php $date=date_create($konfir['tgl_pembelian']);echo date_format($date,"d/m/Y");?></td>
						</tr>
						<tr>
							<th>Tgl Transfer </th>
							<td><?php $date=date_create($konfir['tgl_transfer']);echo date_format($date,"d/m/Y");?></td>
						</tr>
						<tr>
							<th>No Rek. </th>
							<td><?php echo $konfir['no_rek'] ?></td>
						</tr>
						<tr>
							<th>Bank </th>
							<td><?php echo $konfir['bank'] ?></td>
						</tr>
						<tr>
							<th>Nama Pemilik Rek. </th>
							<td><?php echo $konfir['nama_pengirim'] ?></td>
						</tr>
						<tr>
							<th>Jumlah Transfer</th>
							<td>Rp. <?php echo number_format($konfir['jumlah_transfer']) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
</div>
