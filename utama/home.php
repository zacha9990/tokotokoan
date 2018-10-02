<?php 
$pro = $produk->tampil_produk();
// echo "<pre>";
// print_r($pro);
// echo "</pre>";

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
	.hero1
	{
		width: 100%;
		height: 100%;
		margin-top: -20px;
	}
</style>

<link rel="stylesheet" href="../asset/css/slide.css">
<link rel="stylesheet" type="text/css" href="../asset/css/pengunjung.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">

<div class="hero">
	<div class="hero1">
		<img src="../asset/img/header/foto.jpg" class="hero1">

	</div>
</div>
<div class="produk">
	<div class="container">
		<div class="row">
			<?php $i=1; foreach ($pro as $key => $value): ?>
				<div class="col-md-3">
					<div class="my-list">
						<div>
							<img height="150" class="text-center" src="../asset/img/produk/<?php echo $value['foto_produk'] ?>" alt="" />
						</div>
						<h1><?php echo $value['nama_produk'] ?></h1>
						<span>
							Stok: <?php $sisa_stok= $value['stok'];
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
			<?php if ($i%4 == 0){
				echo "</div><div class='row'>";
			} $i++; ?>
			<?php endforeach ?>
		</div>
	</div>
</div>
