<div class="container">
<h2 class="text-center">Daftar Member</h2><br>
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="col-sm-2 control-label">Nama Lengkap</label>
			<div class="col-sm-8">
				<input type="text" name="nama" class="form-control" required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Username</label>
			<div class="col-sm-8">
				<input type="text" name="user" class="form-control" required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Email</label>
			<div class="col-sm-8">
				<input type="text" name="email" class="form-control" required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Password</label>
			<div class="col-sm-8">
				<input type="Password" name="pass" class="form-control" required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">No Hp</label>
			<div class="col-sm-8">
				<input type="number" name="telepon" class="form-control" required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Alamat</label>
			<div class="col-sm-8">
				<textarea class="form-control" name="alamat" required=""></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Foto</label>
			<div class="col-sm-8">
				<input type="file" name="foto" class="form-control" required="">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-primary" name="simpan">Simpan</button>
			</div>
		</div>
	</form>
</div>

<?php 
if(isset($_POST['simpan']))
{
	$nama= $_FILES['foto']['name'];
	$size = $_FILES['foto']['size'];
	$format = pathinfo($nama, PATHINFO_EXTENSION);

	if($format=="jpg" || $format=="png")
	{
		if($size == 0)
		{
			echo "<div class='col-sm-4 col-sm-offset-2 alert alert-danger'>Maksimal ukuran foto adalah 2MB</div>";
		}
		else
		{
			$member->tambah_member($_POST['nama'], $_POST['user'], $_POST['email'], $_POST['pass'], $_POST['telepon'], $_POST['alamat'], $_FILES['foto']);
			echo "<script>alert ('Anda Telah Berhasil Menjadi Member')</script>";
			echo "<script>location='index.php?halaman=login'</script>";
		}
	}
	else
	{
		echo "<div class='col-sm-4 col-sm-offset-2 alert alert-danger'>Format foto harus JPG/PNG</div>";
	}
}


?>