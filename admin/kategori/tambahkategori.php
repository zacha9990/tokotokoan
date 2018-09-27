<h3><strong>Tambah Data Kategori</strong></h3>
<hr>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<div class="col-sm-6">
		<label>Nama Kategori</label>
			<input type="text" name="nama" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-6">
			<button class="btn btn-primary" name="simpan">Simpan</button>
		</div>
	</div>
</form>
<?php 
if(isset($_POST['simpan']))
{
	$kategori->tambah_kategori($_POST['nama']);

	echo "<script>location= 'index.php?halaman=kategori';</script>";
}
 ?>
