<?php 
if(!isset($_SESSION['member']))
{
	echo "<script>alert('silakan login dulu')</script>";
	echo "<script>location='index.php?halaman=login'</script>";
	exit();
}

$dataprov = $tarif->tampil_provinsi();

if(isset($_POST['jasa']))
{
	$jasa = $_POST['jasa'];	
	echo "<script>location='index.php?halaman=checkout_$jasa'</script>";
}
else
{
	$jasa="";
}
if (isset($_POST['id_prov'])) 
{
	$id_prov = $_POST['id_prov'];
}
else
{
	$id_prov="";
}
if (isset($_POST['id_kota'])) 
{
	$id_kota = $_POST['id_kota'];
}
else
{
	$id_kota="";
}
$kotaprov = $tarif->tampil_kota_prov($id_prov);
?>

<?php $isikeranjang = $keranjang->tampil_keranjang(); ?>
<!-- <pre><?php print_r($isikeranjang) ?></pre> -->

<?php 

?>

<div class="container">
	<h3>Data Belanja</h3>
	<table class="table table-bordered">
		<thead>
			<tr class="label-info">
				<th class="text-center">No</th>
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Kuantitas</th>
				<th class="text-center">Berat</th>
				<th class="text-center">Harga</th>
				<th class="text-center">Subberat</th>
				<th class="text-center">Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php $totalbayar = 0; ?>
			<?php $totalberat = 0; ?>
			<?php $totalbelanja = 0; ?>
			<?php $jml = 0; ?>
			<?php foreach ($isikeranjang as $key => $value): ?>
				<tr>
					<td class="text-center"><?php echo $key+1 ?></td>
					<td><?php echo $value ['nama_produk'] ?></td>
					<td class="text-center"><?php echo $value ['jumlah'] ?></td>
					<td class="text-center"><?php echo $value ['berat'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value ['harga']) ?></td>
					<td class="text-center"><?php echo $value ['sub_berat'] ?> kg</td>
					<td class="text-center">Rp. <?php echo number_format($value ['sub_total']) ?></td>
				</tr>
				<?php $jml+=$value ['jumlah'] ?>
				<?php $totalberat+=$value['sub_berat'];  ?>

				<?php $totalbelanja+=$value['sub_total'];  ?>
			<?php endforeach ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6">Total Belanja</th>
				<th class="text-center">Rp. <?php echo number_format($totalbelanja) ?></th>
			</tr>
			<tr>
				<th colspan="6">Total Ongkir</th>
				<th class="text-center" id="ongkirnya"></th>
			</tr>
			<tr class="warning">
				<th colspan="6">Total Biaya</th>
				<th class="text-center" id="bayarnya"></th>
			</tr>
		</tfoot>
	</table>
	<br>
	<form method="post">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Jasa Pengiriman</label>
					<select class="form-control" name="jasa" onchange="submit()">
						<option>Pilih Jasa Pengiriman</option>
						<option value="jne" <?php if($jasa=='jne'){echo "selected";} ?>>JNE / TIKI / POS</option>
						<option value="esl" <?php if($jasa=='esl'){echo "selected";} ?>>ESL (Eka Sari Lorena)</option>
					</select>
				</div>
			</div>
		</div>
	</form>
</div>
<br><br><br><br><br><br>