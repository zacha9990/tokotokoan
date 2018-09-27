<?php 
$id_komen = $_GET['id_komentar'];
$idpro = $_GET['id_produk'];
$komen = $komentar->ambil_review($id_komen, $idpro);
// echo "<pre>";
// print_r($komen);
// echo "</pre>";
?>
<h3><strong>Detail Review</strong></h3>
<hr>
<div class="detail">
		<div class="row">
			<div class="col-md-6">
				<div>
					<img class="img-thumbnail" width="510" src="../asset/img/produk/<?php echo $komen['foto_produk'] ?>" ">
				</div>
			</div>
			<div class="col-md-6">
				<table class="table">
					<tbody>
						<tr>
							<th width="120px">Nama Member </th>
							<td><?php echo $komen['nama_member'] ?></td>
						</tr>
						<tr>
							<th>Nama Produk </th>
							<td><?php echo $komen['nama_produk'] ?></td>
						</tr>
						<tr>
							<th>Review Member </th>
							<td><?php echo $komen['isi_komentar'] ?></td>
						</tr>
						<tr>
							<th>Rating </th>
							<td>
								<?php if ($komen['rating']==5): ?>
									<i class="fa fa-star" style="color: #0091ea;"></i>
									<i class="fa fa-star" style="color: #0091ea;"></i>
									<i class="fa fa-star" style="color: #0091ea;"></i>
									<i class="fa fa-star" style="color: #0091ea;"></i>
									<i class="fa fa-star" style="color: #0091ea;"></i>
								<?php endif ?>

								<?php if ($komen['rating']==4): ?>
									<i class="fa fa-star" style="color: lime; "></i>
									<i class="fa fa-star" style="color: lime; "></i>
									<i class="fa fa-star" style="color: lime; "></i>
									<i class="fa fa-star" style="color: lime; "></i>
									<i class="fa fa-star-o" style="border-color: lime; "></i>
								<?php endif ?>

								<?php if ($komen['rating']==3): ?>
									<i class="fa fa-star" style="color: #ffea00; "></i>
									<i class="fa fa-star" style="color: #ffea00; "></i>
									<i class="fa fa-star" style="color: #ffea00; "></i>
									<i class="fa fa-star-o" ></i>
									<i class="fa fa-star-o" ></i>
								<?php endif ?>

								<?php if ($komen['rating']==2): ?>
									<i class="fa fa-star" style="color: #ff9800; "></i>
									<i class="fa fa-star" style="color: #ff9800; "></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								<?php endif ?>

								<?php if ($komen['rating']==1): ?>
									<i class="fa fa-star" style="color: #d50000; "></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<th>Status </th>
							<td>
								<?php if ($komen['status_komentar']=="Pending"): ?>
									<span class="label label-danger"><?php echo $komen['status_komentar'] ?></span>
								<?php else: ?>
									<span class="label label-success"><?php echo $komen['status_komentar'] ?></span>
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<th></th>
							<td class="text-right">
								<a href="index.php?halaman=hapus_review&id=<?php echo $komen['id_komentar'] ?>" class="btn btn-danger btn-sm" name="hapus" onclick="return confirm('Apakah anda yakin ingin menghapus komentar ini?')">Hapus Review</a>
								<?php if ($komen['status_komentar']=="Pending"): ?>
									<a href="index.php?halaman=publish&id=<?php echo $komen['id_komentar'] ?>" class="btn btn-primary btn-sm" name="publish" onclick="return confirm('Apakah anda yakin ingin publish komentar ini?')">Publish Review</a>
								<?php endif ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
</div>
