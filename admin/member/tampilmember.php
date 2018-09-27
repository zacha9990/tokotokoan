<?php 
$tampilmember= $member->tampil_member();
// echo "<pre>";
// print_r($tampilmember);
// echo "</pre>";
?>

<h3><strong>Data Member</strong></h3>
<hr>
<table class="table table-bordered" id="table">
	<thead>
		<tr class="label-info">
			<th>No</th>
			<th>Nama Member</th>
			<th>Email</th>
			<th>Telepon</th>
			<th>Alamat</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tampilmember as $key => $value): ?>
			<tr>
				<td><?php echo $key+1 ?></td>
				<td><?php echo $value ['nama_member'] ?></td>
				<td><?php echo $value ['email'] ?></td>
				<td><?php echo $value ['telepon'] ?></td>
				<td><?php echo $value ['alamat'] ?></td>
				<td>
					<a href="index.php?halaman=hapusmember&id=<?php echo $value ['id_member'] ?>" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus member ini?')">Hapus</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
