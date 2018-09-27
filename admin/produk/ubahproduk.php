<?php 
$idubah= $_GET ['id'];

$ubah= $produk->ambil_produk($idubah);

// echo "<pre>";
// print_r($ubah);
// echo "</pre>";

 ?>

<h3><strong>Ubah Data Produk</strong></h3>
<hr>
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Produk</label>
		<div class="col-sm-10">
			<input type="text" name="nama" class="form-control" value="<?php echo $ubah ['nama_produk'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Kategori</label>
		<div class="col-sm-10">
			<select name="id_kategori" class="form-control">
				<option value="">Pilih Kategori</option>
				<?php $kat= $kategori->tampil_kategori(); ?>
				<?php foreach ($kat as $key => $value): ?>
					
				<option value="<?php echo $value ['id_kategori'] ?>" <?php if($value ['id_kategori']==$ubah['id_kategori']) {echo "selected";} ?>><?php echo $value ['nama_kategori'] ?></option>
				<?php endforeach ?>
			</select> 
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Deskripsi</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="deskripsi" rows="15"><?php echo $ubah ['deskripsi'] ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-10">
			<input type="number" name="harga" class="form-control" value="<?php echo $ubah ['harga'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Berat</label>
		<div class="col-sm-10">
			<input type="number" name="berat" class="form-control" value="<?php echo $ubah ['berat'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Stok</label>
		<div class="col-sm-10">
			<input type="number" name="stok" class="form-control" value="<?php echo $ubah ['stok'] ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Foto</label>
		<div class="col-sm-offset-2 col-sm-10">
			<img src="../asset/img/produk/<?php echo $ubah ['foto_produk'] ?>" alt="" width="130">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="file" name="foto" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button class="btn btn-primary" name="ubah">Ubah</button>
		</div>
	</div>
</form>

<?php 
if(isset($_POST ['ubah']))
{
	$produk->ubah_produk($_POST ['nama'], $_POST ['id_kategori'], $_POST ['deskripsi'], $_POST ['harga'], $_POST ['berat'], $_POST ['stok'], $_FILES ['foto'], $idubah);
	echo "<script>alert ('Data Produk Berhasil Diubah'); location= 'index.php?halaman=produk';</script>";
}

 ?>