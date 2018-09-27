<?php 
$dataprov = $tarif->tampil_provinsi();


if (isset($_POST['id_prov'])) 
{
	$id_prov = $_POST['id_prov'];
}
else
{
	$id_prov="";
}

$datakota = $tarif->tampil_kota_prov($id_prov);

 ?>

<h3><strong>Tambah Data Ongkir</strong></h3>
<hr>
<form action="" method="post">
	<div class="form-group">
	<label for="">Provinsi</label>
		<select name="id_prov" id="" class="form-control" onchange="submit()" required="">
		<option value="">Pilih Provinsi</option>	
		<?php foreach ($dataprov as $key => $value): ?>
			
		<option value="<?php echo $value['id_provinsi'] ?>" <?php if($id_prov==$value['id_provinsi']){echo "selected";} ?>><?php echo $value['nama_provinsi'] ?> </option>
		<?php endforeach ?>
	</select>

	</div>

	<div class="form-group">
	<label for="">Kota</label>
		<select name="id_kota" id="" class="form-control" required="">
		<option value="">Pilih Kota</option>
		<?php foreach ($datakota as $key => $value): ?>
			<option value="<?php echo $value['id_kota'] ?>"><?php echo $value['nama_kota'] ?></option>
		<?php endforeach ?>
	</select>
	</div>
	<div class="form-group">
		<label for="">Tarif</label>
		<input type="number" min="0" class="form-control" name="tarif" required="">
	</div>
	<button name="simpan" class="btn btn-primary"> Simpan </button>
</form>
<?php 
if (isset($_POST['simpan'])) 
{
	$tarif->simpan_tarif( $_POST['id_kota'], $_POST['tarif']);
	echo "<script>location='index.php?halaman=tampil_tarif'</script>";
}



 ?>