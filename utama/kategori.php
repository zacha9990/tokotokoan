<?php 
$tampil = $kategori->tampil_kategori_produk($_GET['id']);
$ambil = $kategori->ambil_kategori($_GET['id']);
 ?>

<style>
	.row
	{
		margin-right: 1px;
		margin-top: 15px;
	}
	img{max-width:100%;}
	*{transition: all .5s ease;-moz-transition: all .5s ease;-webkit-transition: all .5s ease}
	.my-list 
	{
		width: 100%;
		padding: 10px;
		border: 1px solid #f5efef;
		float: left;
		margin: 15px 0;
		border-radius: 5px;
		box-shadow: 2px 3px 0px #e4d8d8;
		position:relative;
		overflow:hidden;
	}
	.my-list h1
	{
		text-align: left;
		font-size: 14px;
		font-weight: 600;
		line-height: 21px;
		margin: 0px;
		padding: 0px;
		border-bottom: 1px solid #ccc4c4;
		margin-bottom: 5px;
		padding-bottom: 5px;
	}
	.my-list span{float:left;font-weight: bold;}
	.my-list span:last-child{float:right;}
	.my-list .offer
	{
		width: 100%;
		float: left;
		margin: 5px 0;
		border-top: 1px solid #ccc4c4;
		margin-top: 5px;
		padding-top: 5px;
		color: #afadad;
	}
</style>
<!-- <pre><?php print_r($tampil) ?></pre> -->

<div class="produk">
	<div class="container">
		<h4>Kategori Produk : <?php echo $ambil['nama_kategori'] ?></h4>
		<hr>
		<div class="row">
			<?php foreach ($tampil as $key => $value): ?>
				<div class="col-md-3">
					<div class="my-list">
						<div>
							<img height="150" class="text-center" src="../asset/img/produk/<?php echo $value['foto_produk'] ?>" alt="" />
						</div>
						<h1><?php echo $value['nama_produk'] ?></h1>
						<span>
							Stok: <?php $sisa_stok=  $value['stok'];
							if (isset($_SESSION['keranjang'][$value['id_produk']]))
							{
								$jml_keranjang = $_SESSION['keranjang'][$value['id_produk']]['jumlah'];
								$sisa_stok = $sisa_stok-$jml_keranjang;
								if($sisa_stok<1)
								{

									echo "<span class='label label-danger' style='font-size:12px;'>";
									echo "Kosong";
									echo "</span>";
								}
								else
								{
									echo "<span class='label label-success' style='font-size:12px;'>";
									echo "Tersedia";
									echo "</span>";
								}
							}
							else
							{
								if($sisa_stok>0)
								{
									echo "<span class='label label-success' style='font-size:12px;'>";
									echo "Tersedia";
									echo "</span>";
								}
								else
								{
									echo "<span class='label label-danger' style='font-size:12px;'>";
									echo "Kosong";
									echo "</span>";
								}
							}
							?>
						</span>
						<span class="pull-right">Rp. <?php echo number_format($value['harga']) ?></span>
						<div class="offer">Kategori: <?php echo $value['nama_kategori'] ?>
						</div>
						<a href="index.php?halaman=keranjang&id=<?php echo $value['id_produk'] ?>" class="btn btn-info <?php if ($sisa_stok<1){echo "disabled";} ?>">Tambah ke Keranjang</a>
						<a href="index.php?halaman=detail&id=<?php echo $value['id_produk'] ?>" class="btn btn-info">Detail</a>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<br><br><br><br><br><br><br>