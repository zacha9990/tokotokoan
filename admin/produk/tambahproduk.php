<?php 
$kat= $kategori->tampil_kategori();
 ?>
<!-- <pre>
	<?php print_r($kat) ?>
</pre> -->

<h2>Tambah Produk</h2>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama Produk</label>
		<div class="col-sm-10">
			<input type="text" name="nama_produk" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Kategori</label>
		<div class="col-sm-10">
			<select class="form-control" name="id_kategori">
				<option value="">Pilih Kategori</option>
				<?php foreach ($kat as $key => $value): ?>
				<option value="<?php echo $value ['id_kategori'] ?>"><?php echo $value ['nama_kategori'] ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Deskripsi</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="deskripsi" rows="10"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-10">
			<input type="number" name="harga" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Berat</label>
		<div class="col-sm-10">
			<input type="number" name="berat" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Stok</label>
		<div class="col-sm-10">
			<input type="number" name="stok" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Foto Produk</label>
		<div class="col-sm-10">
			<input type="file" name="foto_produk" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button class="btn btn-primary" name="simpan">Simpan</button>
		</div>
	</div>
</form>

<?php 
if(isset($_POST['simpan']))
{
	$nama= $_FILES['foto_produk']['name'];
	$size = $_FILES['foto_produk']['size'];
	$format = pathinfo($nama, PATHINFO_EXTENSION);
	if($format=="jpg" || $format=="png")
	{
		if($size == 0)
		{
			echo "<div class='col-md-4 col-md-offset-2 alert alert-danger'>Maksimal ukuran foto adalah 2MB</div>";
		}
		else
		{
			$produk->tambah_produk($_POST['nama_produk'], $_POST['id_kategori'], $_POST['deskripsi'], $_POST['harga'], $_POST['berat'], $_POST['stok'], $_FILES['foto_produk']);

			echo "<script>alert ('Data Produk Berhasil Ditambahkan'); location= 'index.php?halaman=produk';</script>";
		}
	}
	else
	{
	echo "<div class='col-md-4 col-md-offset-2 alert alert-danger'>Format foto harus JPG/PNG</div>";
	}
}

 ?>