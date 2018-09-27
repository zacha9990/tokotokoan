<style>
	
	div.stars 
	{
		width: 270px;
		display: inline-block;
		/*float: left;*/
		margin-top: -15px;
	}

	input.star { display: none; }

	label.star 
	{
		float: right;
		padding: 10px;
		font-size: 36px;
		color: #444;
		transition: all .2s;
	}

	input.star:checked ~ label.star:before 
	{
		content: '\f005';
		color: #FD4;
		transition: all .25s;
	}


	input.star-1:checked ~ label.star:before { color: #d50000; }
	input.star-2:checked ~ label.star:before { color: #ff9800; }
	input.star-3:checked ~ label.star:before { color: #ffea00; }
	input.star-4:checked ~ label.star:before { color: lime; }
	input.star-5:checked ~ label.star:before 
	{
		/*warna asli*/
		/*color: #FE7;*/
		color: #0091ea;


		text-shadow: 0 0 20px #952;
	}

	label.star:hover 
	{ 
		transform: rotate(-30deg) scale(1.2); 
		//transition: 1.5s;
	}

	label.star:before 
	{
		content: '\f006';
		font-family: FontAwesome;
	}



</style>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-primary">
		<div class="panel-heading text-center">
			<h4>Silakan Beri Review</h4>
		</div>
		<div class="panel-body">
			<form  method="post" class="form-horizontal">

		<div class="form-group">
			<label for="" class="col-sm-2 ">
				Review Anda
			</label>
			<div class="col-sm-10">
				<textarea name="isi" id="" cols="30" class="form-control" rows="5" required=""></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-2 ">Rating Anda</label>
			<div class="col-sm-10">
				
				<div class="stars">
					<input class="star star-5" id="star-5" type="radio" name="star" required="" value="5" />
					<label class="star star-5" for="star-5"></label>
					<input class="star star-4" id="star-4" type="radio" name="star" required="" value="4" />
					<label class="star star-4" for="star-4"></label>
					<input class="star star-3" id="star-3" type="radio" name="star" required="" value="3" />
					<label class="star star-3" for="star-3"></label>
					<input class="star star-2" id="star-2" type="radio" name="star" required="" value="2" />
					<label class="star star-2" for="star-2"></label>
					<input class="star star-1" id="star-1" type="radio" name="star" required="" value="1" />
					<label class="star star-1" for="star-1"></label>
				</div>
			</div>
		</div>
		

		<button class="btn btn-primary" name="submit">submit</button>
		<a href="index.php?halaman=beri_review&id=<?php echo $_GET['idbeli'] ?>" class='btn btn-danger'>Kembali</a>
	</form>
		</div>
	</div>
		</div>
		<div class="col-md-4">
			<?php $detpro = $produk->ambil_produk($_GET['id_produk']) ?>
			<h4><?php echo $detpro['nama_produk'] ?></h4>
			<br>
			<img src="../asset/img/produk/<?php echo $detpro['foto_produk'] ?>" alt="ini gambarnya" width="100%" class="img-responsive">
		</div>
	</div>
</div>
<?php 
if(isset($_POST['submit']))
{
	$idpel = $_SESSION['member']['id_member'];
	$komentar->simpan_komentar($idpel, $_GET['id_produk'],$_POST['isi'], $_POST['star']);
	echo "<script>alert('terimakasih atas komentar anda')</script>";
	echo "<script>location='index.php?halaman=beri_review&id=$_GET[idbeli]'</script>";
}

 ?>
<br><br><br><br><br><br>