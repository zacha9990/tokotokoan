<?php 
$idtarif = $_GET['id'];
$tampiltarif = $tarif->ambil_tarif_admin($idtarif);
// echo "<pre>";
// print_r($tampiltarif);
// echo "</pre>";
 ?>
<h3><strong>Ubah Data Ongkir</strong></h3>
<hr>
<form class="form-horizontal" method="post">
	<div class="form-group">
		<div class="col-md-6">
			<label>Tarif</label>
			<input type="number" name="tarif" class="form-control" value="<?php echo $tampiltarif['biaya'] ?>">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6">
			<button class="btn btn-primary" name="ubah">Ubah</button>
		</div>
	</div>
</form>
<?php 
if(isset($_POST['ubah']))
{
	$tarif->ubah_tarif($_POST['tarif'], $idtarif);
	echo "<script>alert('Data data berhasil diubah'); location='index.php?halaman=tampil_tarif';</script>";
}

 ?>