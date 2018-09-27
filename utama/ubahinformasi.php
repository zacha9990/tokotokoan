<?php $plgg = $member->ambil_member($_SESSION['member']['id_member']); ?>

<?php if (!isset($_SESSION['member'])): ?>
	<div class="alert text-center" style="background: #ff4f4f; height: 500px; padding-top: 200px;"><h1 style="color: #fff">Halaman Tidak Ditemukan</h1>
		<a href="index.php" class="btn btn-default" style="color: #ff4f4f"><i class="fa fa-arrow-left" style="color: #ff4f4f"></i> Kembali</a>
	</div>
<?php else: ?>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
 	<div class="form-group">
 		<label class="col-sm-4 control-label">Nama</label>
 		<div class="col-sm-5">
 			<input type="text" name="nama" class="form-control" value="<?php echo $plgg['nama_member'] ?>">
 		</div>
 	</div>
 	<div class="form-group">
 		<label class="col-sm-4 control-label">Email</label>
 		<div class="col-sm-5">
 			<input type="text" name="email" class="form-control" value="<?php echo $plgg['email'] ?>">
 		</div>
 	</div>
 	<div class="form-group">
 		<label class="col-sm-4 control-label">Telepon</label>
 		<div class="col-sm-5">
 			<input type="number" name="telepon" class="form-control" value="<?php echo $plgg['telepon'] ?>">
 		</div>
 	</div>
 	<div class="form-group">
 		<label class="col-sm-4 control-label">Alamat</label>
 		<div class="col-sm-5">
 			<textarea class="form-control" name="alamat""><?php echo $plgg['alamat'] ?></textarea>
 		</div>
 	</div>
 	<div class="form-group">
 		<label class="col-sm-4 control-label">Foto</label>
 		<br>
 		<div class="col-sm-5">
 			<img src="../asset/img/member/<?php echo $plgg['foto'] ?>" alt="" width="100">
 			<br>
 			<br>
 			<input type="file" name="foto" class="form-control">
 		</div>
 	</div>
	 <div class="form-group">
	 	<div class="col-sm-offset-4 col-sm-5">
	 		<button class="btn btn-primary" name="ubah">Ubah</button>
	 	</div>
	 </div>
</form>
<?php endif ?>

<?php 
if(isset($_POST['ubah']))
{
	// $size = $_FILES['foto']['size'];
	// if($size == 0)
	// {
	// 	echo "<div class='col-sm-3 col-sm-offset-4 alert alert-danger'>Maksimal ukuran foto adalah 2MB</div><br><br>";
	// }
	// else
	// {
	$member->ubah_member($_POST['nama'], $_POST['email'], $_POST['telepon'], $_POST['alamat'], $_FILES['foto'], $_SESSION['member']['id_member']);
	//$update = $member->update_profil($_POST['nama'], $_POST['email'], $_POST['telepon'], $_POST['alamat'], $_FILES['foto'], $_SESSION['member']['id_member']);
	echo "<script>alert ('Informasi Anda berhasil diubah'); </script>";
	echo "<script>location='index.php?halaman=profil'</script>";
// echo "<pre>";
// print_r($update);
// echo "</pre>";
	// }
}

 ?>
<br>