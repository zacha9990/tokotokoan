<style type="text/css">
	
	img{max-width:100%;}
	*{transition: all .5s ease;-moz-transition: all .5s ease;-webkit-transition: all .5s ease
	}
	.my-list {
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
	.my-list h1{
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
	.my-list .offer{
		width: 100%;
		float: left;
		margin: 5px 0;
		border-top: 1px solid #ccc4c4;
		margin-top: 5px;
		padding-top: 5px;
		color: #afadad;
	}
</style>


<?php 
$keyword = $_GET['keyword'];
$cari_produk = $produk->cari_produk($keyword);

?>
<!-- <pre><?php print_r($cari_produk) ?></pre> -->

<div class="container">
	<h4>Hasil pencarian "<?php echo $keyword ?>"</h4>
	<?php foreach ($cari_produk as $key => $value): ?>
		<div class="col-md-3">
			<div class="my-list">
				<div>
					<img height="150" class="text-center" src="../asset/img/produk/<?php echo $value['foto_produk'] ?>" alt="" />
				</div>
				<h1><?php echo $value['nama_produk'] ?></h1>
				<span>
					Stok: <?php $stok=  $value['stok'];
					if ($stok > 0)
					{
						echo "<a class='btn-success'>";
						echo "Tersedia";
						echo "</a>";
					}
					else
					{
						echo "<a class='btn-danger'>";
						echo "Kosong";
						echo "</a>";
					}

					?>

				</span>
				<span class="pull-right">Rp. <?php echo number_format($value['harga']) ?></span>
				<div class="offer">Kategori: <?php echo $value['nama_kategori'] ?></div>
				<a href="index.php?halaman=keranjang&id=<?php echo $value['id_produk'] ?>" class="btn btn-info">Tambah ke Keranjang</a>
				<a href="index.php?halaman=detail&id=<?php echo $value['id_produk'] ?>" class="btn btn-info">Detail</a>
			</div>
		</div>
	<?php endforeach ?>
</div>
<?php if (empty($cari_produk)): ?>
	<div class="alert text-center" style="background: white; height: 500px; padding-top: 200px;"><h1 style="color: black;">Produk Tidak Ditemukan</h1>
		<a href="index.php" class="btn btn-default" style="color: black"><i class="fa fa-arrow-left" style="color: black"></i> Kembali</a>
	</div>
<?php endif ?>
<br><br><br><br><br>
