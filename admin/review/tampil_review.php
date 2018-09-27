<?php 
$tampilkomen = $komentar->tampil_komentar_admin();

?>
<h3><strong>Data Review</strong></h3>
<hr>
<table class="table table-bordered" id="table">
	<thead>
		<tr class="label-info">
			<th class="text-center">No</th>
			<th class="text-center">Nama Member</th>
			<th class="text-center">Rating</th>
			<th class="text-center">Status</th>
			<th class="text-center">Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tampilkomen as $key => $value): ?>
			
			<tr>
				<td class="text-center"><?php echo $key+1 ?></td>
				<td><?php echo $value['nama_member'] ?></td>
				<td class="text-center">
				<p style="display: none;"><?php echo $value['rating'] ?></p>
				<?php if ($value['rating']==5): ?>
					<i class="fa fa-star" style="color: #0091ea;"></i>
					<i class="fa fa-star" style="color: #0091ea;"></i>
					<i class="fa fa-star" style="color: #0091ea;"></i>
					<i class="fa fa-star" style="color: #0091ea;"></i>
					<i class="fa fa-star" style="color: #0091ea;"></i>
				<?php endif ?>

				<?php if ($value['rating']==4): ?>
					<i class="fa fa-star" style="color: lime; "></i>
					<i class="fa fa-star" style="color: lime; "></i>
					<i class="fa fa-star" style="color: lime; "></i>
					<i class="fa fa-star" style="color: lime; "></i>
					<i class="fa fa-star-o" style="border-color: lime; "></i>
				<?php endif ?>

				<?php if ($value['rating']==3): ?>
					<i class="fa fa-star" style="color: #ffea00; "></i>
					<i class="fa fa-star" style="color: #ffea00; "></i>
					<i class="fa fa-star" style="color: #ffea00; "></i>
					<i class="fa fa-star-o" ></i>
					<i class="fa fa-star-o" ></i>
				<?php endif ?>

				<?php if ($value['rating']==2): ?>
					<i class="fa fa-star" style="color: #ff9800; "></i>
					<i class="fa fa-star" style="color: #ff9800; "></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
				<?php endif ?>

				<?php if ($value['rating']==1): ?>
					<i class="fa fa-star" style="color: #d50000; "></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
				<?php endif ?>
				</td>
				<td class="text-center">
					<?php if ($value['status_komentar']=="Pending"): ?>
						<span class="label label-danger"><?php echo $value['status_komentar'] ?></span>
					<?php else: ?>
						<span class="label label-success"><?php echo $value['status_komentar'] ?></span>
					<?php endif ?>
				</td>
				<td>
					<a href="index.php?halaman=detail_review&id_komentar=<?php echo $value['id_komentar'] ?>&id_produk=<?php echo $value['id_produk'] ?>" class="btn btn-info btn-sm">Detail</a>
					<a href="index.php?halaman=hapus_review&id=<?php echo $value['id_komentar'] ?>" class="btn btn-danger btn-sm" name="hapus" onclick="return confirm('Apakah anda yakin ingin menghapus komentar ini?')">Hapus</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

