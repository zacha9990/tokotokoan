<link rel="stylesheet" type="text/css" href="../asset/css/pengunjung.css">
<style type="text/css">
	.login
	{
		margin-top: 130px;
		margin-bottom: 130px;
	}
</style>

<div class="login">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-user-circle"></i> Login</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								
								<input type="text" placeholder="Email / Username" name="email" class="form-control" required="">
							</div>
							<div class="form-group">
								<input type="password" placeholder="Password" name="password" class="form-control" required="">
							</div>
							<button class="btn btn-primary btn-block" name="login">Login</button>
						</form>
						<?php 
						if(isset($_POST['login']))
						{
							$hasil= $member->login_member($_POST ['email'], $_POST ['password']);
							if($hasil=="sukses")
							{
								echo "<br><div class='alert alert-info'>Anda Berhasil Masuk</div>";
								echo "<meta http-equiv='refresh' content='1;url=index.php'>";
							}
							else
							{
								echo "<br><div class='alert alert-danger'>Username atau password yang Anda masukkan salah</div>";
							}
						}


						 ?>
						 <!-- fitur lupa pswd -->
					</div>
					<div class="panel-footer">
						Belum punya akun?
						<a href="index.php?halaman=daftar"> Daftar</a>
						&nbsp; 
						&nbsp; 
						&nbsp; 
						&nbsp; 
						&nbsp; 
						&nbsp; 
						&nbsp; 
						<a href="index.php?halaman=lupa_password" class="text-right">Lupa Password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


