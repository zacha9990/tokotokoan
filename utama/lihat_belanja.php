<?php 
$idpel = $_GET['id_member'];
$idpembelian = $_GET['id_pembelian'];

$detail_beli = $pembelian->ambil_detail_pembelian($idpembelian);
$beli = $pembelian->ambil_pembelian($idpembelian);
?>
<!-- <pre><?php print_r($detail_beli) ?></pre> -->
<div class="container">
	<table class="table table-bordered">
		<thead>
			<tr class="label-info">
				<th class="text-center">No</th>
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Kuantitas</th>
				<th class="text-center">Berat</th>
				<th class="text-center">Harga</th>
				<th class="text-center">Subberat</th>
				<th class="text-center">Subtotal</th>
				<!-- <th class="text-center">Status</th> -->
				<?php if ($beli['status_pembelian']=="Dikirim"): ?>
				<th class="text-center">Aksi</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($detail_beli as $key => $value): ?>
				<tr>
					<td class="text-center"><?php echo $key+1 ?></td>
					<td><?php echo $value ['nama_produk'] ?></td>
					<td class="text-center"><?php echo $value ['jumlah_produk'] ?></td>
					<td class="text-center"><?php echo $value ['berat'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value ['harga']) ?></td>
					<td class="text-center"><?php echo $value ['subberat_produk'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value ['subtotal_produk']) ?></td>
					
					<td>
						<?php if ($pembelian->cek_retur($value["id_detail_pembelian"])==1): ?>
							<a class="btn btn-info btn-sm" href="index.php?halaman=detail_retur&id=<?php echo $value['id_detail_pembelian'] ?>">Detail Retur</a>
						<?php endif ?>
						<?php if($pembelian->cek_retur($value["id_detail_pembelian"])!==1 and $beli["status_pembelian"]=="Dikirim"): ?>
						<a href="index.php?halaman=kembalikan&id=<?php echo $value['id_detail_pembelian'] ?>" class="btn btn-danger btn-sm">Retur Produk</a>
						
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>

		<?php if ($beli['status_pembelian']=="Dikirim"): ?>
			
		<?php else: ?>
			<tfoot>
			<tr>
				<th colspan="6">Total Belanja</th>
				<th class="text-center">Rp. <?php echo number_format($beli['total_belanja']) ?></th>
			</tr>
			<tr>
				<th colspan="6">Total Ongkir</th>
				<th class="text-center">Rp. <?php echo number_format($beli['total_ongkir']) ?></th>
			</tr>
			<tr class="warning">
				<th colspan="6">Total Biaya</th>
				<th class="text-center">Rp. <?php echo number_format($beli['total_bayar']) ?></th>
			</tr>
		</tfoot>
		<?php endif ?>
		
	</table>
	<a href="index.php?halaman=riwayat&id=<?php echo $idpel ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>