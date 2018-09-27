<style>
	/*show more*/
	.read-more-state {
		display: none;
	}

	.read-more-target {
		opacity: 0;
		max-height: 0;
		font-size: 0;
		transition: .25s ease;
	}

	.read-more-state:checked ~ .read-more-wrap .read-more-target {
		opacity: 1;
		font-size: inherit;
		max-height: 999em;
	}

	.read-more-state ~ .read-more-trigger:before {
		content: 'Show more';
	}

	.read-more-state:checked ~ .read-more-trigger:before {
		content: 'Show less';
	}

	.read-more-trigger {
		cursor: pointer;
		display: inline-block;
		padding: 0 .5em;
		color: #666;
		font-size: .9em;
		line-height: 2;
		border: 1px solid orange;
		border-radius: .25em;
	}
	/*end read more*/
</style>


<?php 
$iddet = $_GET['id'];
$datapro = $produk->ambil_produk($iddet);

// echo "<pre>";
// print_r($datapro);
// echo "</pre>";

?>



<div class="detail">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div>
					<img class="img-thumbnail" width="510" src="../asset/img/produk/<?php echo $datapro['foto_produk'] ?>" ">
					<br>
					<strong>Bagikan :</strong>
					<!-- AddToAny BEGIN -->
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
						<a class="a2a_button_google_plus"></a>
						<a class="a2a_button_whatsapp"></a>
						<a class="a2a_button_line"></a>
					</div>
					<script async src="https://static.addtoany.com/menu/page.js"></script>
					<!-- AddToAny END -->
				</div>
			</div>
			<div class="col-md-6">
				<table class="table">
					<tbody>
						<tr class="warning">
							<th width="120px">Kategori </th>
							<td><?php echo $datapro['nama_kategori'] ?></td>
						</tr>
						<tr class="warning">
							<th>Nama Produk </th>
							<td><?php echo $datapro['nama_produk'] ?></td>
						</tr>
						<tr class="warning">
							<th>Berat </th>
							<td><?php echo $datapro['berat'] ?> kg</td>
						</tr>
						<tr class="warning">
							<th>Harga </th>
							<td>Rp. <?php echo number_format($datapro['harga']) ?></td>
						</tr>
						<tr class="warning">
							<th>Stok </th>
							<td>
								<?php if ($datapro['stok']==0): ?>
									<span class="label label-danger">Kosong</span>
								<?php else: ?>
									<?php echo number_format($datapro['stok']) ?>
								<?php endif ?>
							</td>
						</tr>
						<tr class="warning">
							<th>Deskripsi </th>
							<td><?php echo $datapro['deskripsi'] ?></td>
						</tr>
					</tbody>
				</table>
				<form method="post">
					<div class="form-group">
						<label>Jumlah Beli:</label>
						<!-- pake <option> -->
						<div class="input-group">
							<input type="number" name="jumlah" min="1" class="form-control" required="">
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Beli</button>
							</div>
						</div>
					</div>
				</form>
				<?php if(isset($_POST['beli'])) 
				{
					if($datapro['stok']==0)
					{
						echo "<script>alert ('Maaf Stok Kosong')</script>";
					}
					else
					{
						if($_POST['jumlah']>$datapro['stok'])
						{
							echo "<script>alert ('Jumlah Yang Anda Inputkan Terlalu Banyak')</script>";
						}
						else
						{
							$keranjang->masukkan_keranjang($_POST['jumlah'], $_GET['id']);
							if ($_SESSION['keranjang'][$_GET['id']]['jumlah']>$datapro['stok']) 
							{
								$keranjang->buang_keranjang($_POST['jumlah'], $_GET['id']);
								$sisa = $datapro['stok']-$_SESSION['keranjang'][$_GET['id']]['jumlah']; 
								if($sisa==0)
								{
									echo "<script>alert ('Stok Kosong')</script>";
								}
								else
								{
									echo "<script>alert ('Stok tidak cukup, poduk tersisa $sisa buah')</script>";
								}
							}
							else
							{
								echo "<script>alert ('Produk ditambahkan ke keranjang')</script>";
								echo "<script>location= 'index.php?halaman=keranjang'</script>";	
							}
						}
					}
				}

				?>
			</div>
		</div>
	</div>

	<br><br>

	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				<h3>Review Pembeli</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<?php $komen = $komentar->tampil_komentar_produk($_GET['id']) ?>

						<?php foreach ($komen as $key => $value): ?>

							<div class="row">
								<div class="col-md-3">
									<img src="../asset/img/member/<?php echo $value['foto'] ?>" alt="gambar" class="img-responsive" style="border-radius: 100%">
								</div>
								<div class="col-md-9">
									<h4><b><?php echo $value['nama_member'] ?></b></h4>


									<?php if ($value['rating']==5): ?>

										<i class="fa fa-star" style="color: #0091ea; text-shadow: 0 0 20px #952;"></i>
										<i class="fa fa-star" style="color: #0091ea; text-shadow: 0 0 20px #952;"></i>
										<i class="fa fa-star" style="color: #0091ea; text-shadow: 0 0 20px #952;"></i>
										<i class="fa fa-star" style="color: #0091ea; text-shadow: 0 0 20px #952;"></i>
										<i class="fa fa-star" style="color: #0091ea; text-shadow: 0 0 20px #952;"></i>

									<?php endif ?>

									<?php if ($value['rating']==4): ?>
										<i class="fa fa-star" style="color: lime; "></i>
										<i class="fa fa-star" style="color: lime; "></i>
										<i class="fa fa-star" style="color: lime; "></i>
										<i class="fa fa-star" style="color: lime; "></i>
										<i class="fa fa-star-o" style="border-color: lime; "></i>
									<?php endif ?>

									<?php if ($value['rating']==3): ?>
										<i class="fa fa-star" style="color: #ffea00; "></i>
										<i class="fa fa-star" style="color: #ffea00; "></i>
										<i class="fa fa-star" style="color: #ffea00; "></i>
										<i class="fa fa-star-o" ></i>
										<i class="fa fa-star-o" ></i>
									<?php endif ?>

									<?php if ($value['rating']==2): ?>
										<i class="fa fa-star" style="color: #ff9800; "></i>
										<i class="fa fa-star" style="color: #ff9800; "></i>
										<i class="fa fa-star-o"></i>
										<i class="fa fa-star-o"></i>
										<i class="fa fa-star-o"></i>

									<?php endif ?>

									<?php if ($value['rating']==1): ?>
										<i class="fa fa-star" style="color: #d50000; "></i>
										<i class="fa fa-star-o"></i>
										<i class="fa fa-star-o"></i>
										<i class="fa fa-star-o"></i>
										<i class="fa fa-star-o"></i>

									<?php endif ?>



									<div class="caption text-justify isi-read-more">

										<p class="read-more-wrap comment" style="padding: 2%; color: #ad9b70; border: 1px solid orange; border-radius: .25em;"><?php echo $value['isi_komentar'] ?>
										</p>
										<!-- <label for="post-1" class="read-more-trigger"></label> --> 

									</div>
								<!-- <div>
									<input type="checkbox" class="read-more-state" id="post-2" />
								</div> -->
							</div>
						</div>
						<br>
					<?php endforeach ?>
				</div>
				
			</div>
			
		</div>
	</div>
</div>

</div>