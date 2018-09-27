<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Lupa Password</h3>
				</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<input type="email" placeholder="Masukkan email anda" class="form-control" name="email" required="">
						</div>
						<button class="btn btn-primary" name="submit">Submit</button>
					</form>
					<?php 
					if(isset($_POST['submit']))
					{
						$email=$_POST['email'];
						$cek=$member->ngecek_email($email);
						if($cek==1)
						{
							$pass= rand();
							$pass=sha1($pass);
							$pass1=substr($pass, 0,6);
							$password=$pass1;
							$member->ubah_pass($password, $email);

							$to=$email;
							$sub="Lupa Password";
							$message="Silahkan anda login dengan password berikut.\n\nPassword: ".$password."\n\nTerima kasih,\nSepeda Jaya";
							$email=mail($to,$sub,$message,'From: Sepeda Jaya');

							echo "<script>alert('Password telah dikirim ke email anda');
							location='index.php?halaman=login';</script>";
						}
						else
						{
							echo "<br><div class='alert alert-danger'><center>Maaf email yang anda inputkan tidak terdaftar</center></div>";
						}
					}

					?>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>


