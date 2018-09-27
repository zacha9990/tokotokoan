<?php include "../config/class.php"; 

// jika tidak ada session admin maka harus login dulu

if(!isset($_SESSION ['admin']))
{
	echo "<script>alert ('Anda Harus Login Dahulu'); location = 'login.php';</script>";
	exit();
}

$hitung = $komentar->hitung_komentar_baru();
$itung = $pembelian->hitung_pembelian_baru();
$hitungkon = $konfirmasi->hitung_konfirmasi_baru();
$hitungretur = $pembelian->hitung_retur_baru();

if(empty($hitung))
{
	$hitung_komen=0;
	$title_komen="Tidak Ada Komentar Baru";
}
else
{
	$hitung_komen= count($hitung);
	$title_komen= $hitung_komen." Komentar Baru";
}

if(empty($itung))
{
	$hitung_pembelian=0;
	$title_pembelian="Tidak Ada Pembelian Baru";
}
else
{
	$hitung_pembelian= count($itung);
	$title_pembelian= $hitung_pembelian." Pembelian Baru";
}
if(empty($hitungkon))
{
	$hitung_konfirmasi=0;
	$title_konfirmasi="Tidak Ada Konfirmasi Baru";
}
else
{
	$hitung_konfirmasi= count($hitungkon);
	$title_konfirmasi= $hitung_konfirmasi." Konfirmasi Baru";
}
if(empty($hitungretur))
{
	$hitung_retur=0;
	$title_retur="Tidak Ada Retur Baru";
}
else
{
	$hitung_retur= count($hitungretur);
	$title_retur= $hitung_retur." Retur Baru";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Sepeda Jaya</title>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="../asset/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../asset/css/admin2.css">
</head>
<body>
	<div id="pembungkus">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".sidebar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="color: black">Admin Sepeda Jaya</a>
			</div>
		</nav>
		<nav class="navbar-default navbar-side">
			<div class="sidebar-collapse hidden-print">
				<ul class="nav" id="menu-utama">
					<li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
					<li><a href="index.php?halaman=kategori"><i class="fa fa-tag"></i> Kategori</a></li>
					<li><a href="index.php?halaman=member"><i class="fa fa-user"></i> Member</a></li>
					<li><a href="index.php?halaman=tampil_tarif"><i class="fa fa-truck"></i> Ongkir</a></li>
					<li><a href="index.php?halaman=produk"><i class="fa fa-shopping-cart"></i> Produk</a></li>
					<li><a href="index.php?halaman=review"><i class="fa fa-commenting"></i> Review</a></li>
					<li><a href="index.php?halaman=pembelian"><i class="fa fa-bars"></i> Pembelian</a></li>
					<li><a href="index.php?halaman=konfirmasi"><i class="fa fa-check-square"></i> Konfirmasi</a></li>
					<li><a href="index.php?halaman=retur"><i class="fa fa-undo"></i> Retur</a></li>
					<li><a href="index.php?halaman=logout" onclick="return confirm('Apakah anda yakin ingin logout?')"><i class="fa fa-sign-out"></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<div id="bungkus-page">
			<div id="bg-page">
				<!-- jika tidak ada parameter halaman / cuma index.php -->

				<?php 
				if(!isset($_GET['halaman']))
				{
					include "home.php";
				}
				// selain itu jika ada parameter halamn
				else
				{
					// member
					if($_GET['halaman']=="member")
					{
						include "member/tampilmember.php";
					}
					elseif($_GET ['halaman']=="tambahmember")
					{
						include "member/tambahmember.php";
					}
					elseif($_GET['halaman']=="ubahmember")
					{
						include "member/ubahmember.php";
					}
					elseif($_GET ['halaman']=="hapusmember")
					{
						include "member/hapusmember.php";
					}

					// KATEGORI
					elseif($_GET['halaman']=="kategori")
					{
						include "kategori/tampilkategori.php";
					}
					elseif($_GET ['halaman']=="tambahkategori")
					{
						include "kategori/tambahkategori.php";
					}
					elseif($_GET['halaman']=="ubahkategori")
					{
						include "kategori/ubahkategori.php";
					}
					elseif($_GET ['halaman']=="hapuskategori")
					{
						include "kategori/hapuskategori.php";
					}

					// PRODUK
					elseif($_GET['halaman']=="produk")
					{
						include "produk/tampilproduk.php";
					}
					elseif($_GET ['halaman']=="tambahproduk")
					{
						include "produk/tambahproduk.php";
					}
					elseif($_GET['halaman']=="ubahproduk")
					{
						include "produk/ubahproduk.php";
					}
					elseif($_GET ['halaman']=="hapusproduk")
					{
						include "produk/hapusproduk.php";
					}
					elseif($_GET ['halaman']=="detail_produk")
					{
						include "produk/detail_produk.php";
					}
					elseif($_GET ['halaman']=="logout")
					{
						include "logout.php";
					}
					// PEMBELIAN
					elseif($_GET ['halaman']=="pembelian")
					{
						include "pembelian/tampil_pembelian.php";
					}
					elseif($_GET['halaman']=="input_resi")
					{
						include "pembelian/input_resi.php";
					}
					elseif ($_GET['halaman']=="nota") 
					{
						include "pembelian/nota.php";
					}
					elseif ($_GET['halaman']=="detail") 
					{
						include "pembelian/detail.php";
					}
					elseif ($_GET['halaman']=="laporan") 
					{
						include "pembelian/laporan.php";
					}
					elseif ($_GET["halaman"]=="retur")
					{
						include 'pembelian/retur.php';
					}
					elseif ($_GET["halaman"]=="bukti_retur")
					{
						include 'pembelian/bukti_retur.php';
					}
					elseif ($_GET["halaman"]=="ubah_status")
					{
						include 'pembelian/ubah_status.php';
					}
					elseif ($_GET["halaman"]=="hapus_retur")
					{
						include 'pembelian/hapus_retur.php';
					}
					elseif ($_GET["halaman"]=="hapus_pembelian")
					{
						include 'pembelian/hapus_pembelian.php';
					}

					// KONFIRMASI
					elseif ($_GET['halaman']=="konfirmasi") 
					{
						include "konfirmasi/tampilkonfirmasi.php";
					}
					elseif ($_GET['halaman']=="detail_konfirmasi") 
					{
						include "konfirmasi/detail_konfirmasi.php";
					}
					elseif ($_GET['halaman']=="hapus_konfirmasi") 
					{
						include "konfirmasi/hapus_konfirmasi.php";
					}

					// review
					elseif ($_GET['halaman']=="review") 
					{
						include "review/tampil_review.php";
					}
					elseif ($_GET['halaman']=="hapus_review") 
					{
						include "review/hapus_review.php";
					}
					elseif ($_GET['halaman']=="publish") 
					{
						include "review/publish.php";
					}
					elseif ($_GET['halaman']=="detail_review") 
					{
						include "review/detail_review.php";
					}

					// Tarif
					elseif ($_GET['halaman']=="tampil_tarif") 
					{
						include "tarif/tampil_tarif.php";
					}
					elseif ($_GET['halaman']=="tambah_tarif") 
					{
						include "tarif/tambah_tarif.php";
					}
					elseif ($_GET['halaman']=="ubah_tarif") 
					{
						include "tarif/ubah_tarif.php";
					}
				}
				?>
			</div>
		</div>
	</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="../asset/js/bootstrap.min.js"></script>
		<script src="../asset/js/admin.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
		<script>
			$(document).ready(function() {
		    $('#table').DataTable();
			} );
		</script>
		<script src="../asset/ckeditor/ckeditor.js"></script>
		<script>
			CKEDITOR.replace("theeditor");
		</script>
</body>
</html>

<!-- <li><a href="index.php?halaman=review" data-toggle="tooltip" data-placement="right" title="<?php echo $title_komen ?>"><i class="fa fa-commenting"></i> Review <span class="badge pull-right" style="background: white; color: black"><?php echo $hitung_komen ?> </span></a></li>
<li><a href="index.php?halaman=pembelian" data-toggle="tooltip" data-placement="right" title="<?php echo $title_pembelian ?>"><i class="fa fa-bars"></i> Pembelian <span class="badge pull-right" style="background: white; color: black"><?php echo $hitung_pembelian ?></span></a></li>
<li><a href="index.php?halaman=konfirmasi"><i class="fa fa-check-square"></i> Konfirmasi</a></li>
<li><a href="index.php?halaman=retur" data-toggle="tooltip" data-placement="right" title="<?php echo $title_retur ?>"><i class="fa fa-arrow-left"></i> Retur <span class="badge pull-right" style="background: white; color: black"><?php echo $hitung_retur ?> </span></a></li> -->