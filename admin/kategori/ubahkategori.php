<?php 
$ubahid= $_GET['id'];

$ambil= $kategori->ambil_kategori($ubahid);
// echo "<pre>";
// print_r($ambil);
// echo "</pre>";
 ?>

<h3><strong>Ubah Data Kategori</strong></h3>
<hr>
 <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
 	<div class="form-group">
 		<div class="col-sm-6">
 		<label>Nama Kategori</label>
 			<input type="text" name="nama" class="form-control" value="<?php echo $ambil ['nama_kategori'] ?>">
 		</div>
 	</div>
 	<div class="form-group">
 		<div class="col-sm-6">
 			<button class="btn btn-primary" name="ubah">Ubah</button>
 		</div>
 	</div>
 </form>

 <?php 
if(isset($_POST['ubah']))
{
	$kategori->ubah_kategori($_POST['nama'], $ubahid);
	echo "<script>alert ('Data Berhasil Diubah'); location='index.php?halaman=kategori';</script>";
}

  ?>