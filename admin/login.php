<!DOCTYPE html>
<html>
<head>
	<title>Login Administrator</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../asset/font-awesome/css/font-awesome.css">
	<style>
		body
		{
			background: #2e2e2e;
		}
		.kotak-login
		{
			margin-top: 200px;
			border: 1px solid #f8f8f8;
			border-radius: 5px;
			box-shadow: 0px 3px 3px 0px #f4f4f4;
			padding: 10px;
			background: #fff;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="kotak-login">
				<form method="post">
					<legend class="text-center"><i class="fa fa-lock"></i> Login Administrator</legend>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required="">
					</div>
					<button class="btn btn-primary" name="login">Login</button>
				</form>

				<?php 
				include "../config/class.php";
				if(isset($_POST ['login']))
				{
					$hasil= $admin->login_admin($_POST ['username'], $_POST ['password']);
					if($hasil=="sukses")
					{
						echo "<div class='alert alert-info'>Selamat, Anda Berhasil Masuk Halaman Admin</div>";
						echo "<meta http-equiv='refresh' content='1;url=index.php'>";
					}
					else
					{
						echo "<div class='alert alert-danger'>Username atau password yang Anda masukkan salah</div>";
					}
				}

				 ?>

			</div>
		</div>
	</div>
</div>

</body>
</html>