<?php $plgg = $member->ambil_member($_SESSION['member']['id_member']); ?>
<div class="container">

	<form action="" method="post" class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-2 control-label">Password Lama</label>
		<div class="col-sm-10">
			<input type="Password" name="pass" class="form-control" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Password Baru</label>
		<div class="col-sm-10">
			<input type="Password" name="passbaru" class="form-control" required="">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Konfirmasi Password</label>
		<div class="col-sm-10">
			<input type="Password" name="passkonf" class="form-control" required="">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<button class="btn btn-primary" name="ubah">Simpan</button>
			<a href="index.php?halaman=profil" class="btn btn-default">Batal</a>
		</div>
	</div>
</form>
</div>


<?php 
if(isset($_POST['ubah']))
{
	$cek = $member->cek_login($_POST['pass']);
	if ($cek=="gagal") 
	{
		echo "<script>alert ('Password Lama Anda Salah'); </script>";
	}
	elseif ($_POST['passbaru']!=$_POST['passkonf']) 
	{
		echo "<script>alert ('Password Baru dan Konfirmasi Anda Tidak Cocok'); </script>";
	}
	elseif ($_POST['passbaru']==$_POST['passkonf']) {
		$member->ganti_password($_POST['passbaru'], $_SESSION['member']['id_member']);

		echo "<script>alert ('Password Anda berhasil diubah'); </script>";
		echo "<script>location='index.php?halaman=profil'</script>";
	}
}
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>