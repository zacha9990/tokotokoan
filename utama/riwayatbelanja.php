<div class="container" style="margin-bottom: 300px">
	<h3>Riwayat Belanja</h3>
	<table class="table table-bordered">
		<thead>
			<tr class="label-info">
				<th class="text-center">No</th>
				<th class="text-center">Kode Pembelian</th>
				<th class="text-center">Tgl Pembelian</th>
				<th class="text-center">Status</th>
				<th class="text-center">Total Biaya</th>
				<th class="text-center">No Resi</th>
				<th class="text-center">Opsi</th>
			</tr>
		</thead>
		<?php 
				$idpel = $_SESSION['member']['id_member'];

				$riwayat = $pembelian->tampil_pembelian_member($idpel);

			// echo "<pre>";
			// print_r($riwayat);
			// echo "</pre>";

		?>
		<tbody>
			<?php if (empty($riwayat)): ?>
				<td class="text-center">--</td>
				<td class="text-center">--</td>
				<td class="text-center">------</td>
				<td class="text-center">------</td>
				<td class="text-center">Rp. 0</td>
				<td class="text-center">------</td>
				<td class="text-center">-</td>
			<?php else: ?>
				<?php foreach ($riwayat as $key => $value): ?>
					<tr>
						<td class="text-center"><?php echo $key+1 ?></td>
						<td class="text-center">KD<?php echo $value['id_pembelian'] ?></td>
						<td class="text-center"><?php $date=date_create($value['tgl_pembelian']);echo date_format($date,"d/m/Y");?></td>
						<td class="text-center">
							<?php if ($value['status_pembelian']=='Sudah Konfirmasi'): ?>
								<h4><span class="label label-warning"><?php echo $value['status_pembelian'] ?></span></h4>
							<?php endif ?>

							<?php if ($value['status_pembelian']=='Pending'): ?>
								<h4><span class="label label-danger"><?php echo $value['status_pembelian'] ?></span></h4>
							<?php endif ?>

							<?php if ($value['status_pembelian']=='Dikirim'): ?>
								<h4><span class="label label-success"><?php echo $value['status_pembelian'] ?></span></h4>
							<?php endif ?>
						</td>
						<td class="text-center">Rp. <?php echo number_format($value['total_bayar']) ?></td>
						<td class="text-center">
							<?php if ($value['status_pembelian']=="Pending"): ?>
								<?php echo "Silakan Konfirmasi Pembayaran" ?>
							<?php endif ?>
							<?php if ($value['status_pembelian']=="Sudah Konfirmasi"): ?>
								<?php echo "Sedang Dalam Proses" ?>
							<?php endif ?>
							<?php if ($value['status_pembelian']=="Dikirim"): ?>
								<?php echo $value['no_resi'] ?>
							<?php endif ?>
						</td>
						<td>
							<?php if ($value['status_pembelian']=='Dikirim'): ?>

								<a href="index.php?halaman=notabelanja&id=<?php echo $value['id_pembelian'] ?>" class="btn btn-success btn-sm">Nota</a>
								<a href="index.php?halaman=beri_review&id=<?php echo $value['id_pembelian'] ?>" class="btn btn-info btn-sm">Beri Review Produk</a>
							<?php endif ?>

							<?php if ($value['status_pembelian']=='Pending'): ?>

								<a href="index.php?halaman=konfirmasi&id=<?php echo $value['id_pembelian'] ?>" class="btn btn-warning btn-sm">Konfirmasi Pembayaran</a>
								<a href="index.php?halaman=batal_belanja&id_beli=<?php echo $value['id_pembelian'] ?>&id_member=<?php echo $idpel ?>" class="btn btn-danger btn-sm" onclick="return confirm('Batalkan Belanja?')">Batal Belanja</a>
							<?php endif ?>
							<a href="index.php?halaman=lihat_belanja&id_pembelian=<?php echo $value['id_pembelian'] ?>&id_member=<?php echo $idpel ?>" class="btn btn-default btn-sm">Lihat Daftar Belanja</a>
						</td>
					</tr>
				<?php endforeach ?>

			<?php endif ?>
		</tbody>
	</table>
	<a href="index.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Lanjut Belanja</a>
</div>