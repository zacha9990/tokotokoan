<?php 
if(!isset($_SESSION['member']))
{
	echo "<script>alert ('Anda harus login dahulu'); location= 'index.php?halaman=login';</script>";
	exit();
}

$plgg = $member->ambil_member($_SESSION['member']['id_member']);

 ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-4">
		<div class="img-thumbnail">
			<img src="../asset/img/member/<?php echo $plgg['foto'] ?>" width="400">
			<table class="table">
				<tbody>
					<tr class="warning">
						<th>Nama: </th>
						<td><?php echo $plgg['nama_member'] ?></td>
					</tr>
					<tr class="warning">
						<th>Username: </th>
						<td><?php echo $plgg['username'] ?></td>
					</tr>
					<tr class="warning">
						<th>Email: </th>
						<td><?php echo $plgg['email'] ?></td>
					</tr>
					<tr class="warning">
						<th>Telepon: </th>
						<td><?php echo $plgg['telepon'] ?></td>
					</tr>
					<tr class="warning">
						<th>Alamat: </th>
						<td><?php echo $plgg['alamat'] ?></td>
					</tr>
				</tbody>
			</table>
			<div class="text-center">
				<a href="index.php?halaman=ubahinformasi" class="btn btn-primary">Ubah Informasi</a>
				<a href="index.php?halaman=ubahpassword" class="btn btn-warning">Ubah Password</a>
			</div>
			<br>
		</div>
		</div>
	</div>
</div>
