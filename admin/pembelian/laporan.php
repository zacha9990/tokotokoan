<?php 
$bulan['01']="Januari";
$bulan['02']="Februari";
$bulan['03']="Maret";
$bulan['04']="April";
$bulan['05']="Mei";
$bulan['06']="Juni";
$bulan['07']="Juli";
$bulan['08']="Augustus";
$bulan['09']="September";
$bulan['10']="Oktober";
$bulan['11']="November";
$bulan['12']="Desember";
?>
<h1 class="hidden-print">Laporan Penjualan</h1>
<form method="post" class="form-inline hidden-print">
	<div class="form-group">
		<select class="form-control" name="bulan">
			<option value="">-- Pilih Bulan --</option>
			<?php foreach ($bulan as $key => $value): ?>
				<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
			<?php endforeach ?>		
		</select>
	</div>
	<div class="form-group">
		<select class="form-control" name="tahun">
			<option value="">-- Pilih Tahun --</option>
			<?php for ($tahun = 2017; $tahun <=date("Y"); $tahun++): ?>
				<option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
			<?php endfor ?>		
		</select>
	</div>
	<button class="btn btn-info" name="cari" type="submit">Cari</button>
</form>
<?php
if (isset($_POST['cari'])) 
{
	$data_pembelian = $pembelian->laporan_pembelian($_POST['bulan'],$_POST['tahun']);
}
else
{
	$data_pembelian = array();
}

?>
<hr class="hidden-print">
<?php if ($data_pembelian==array()):?>
<?php else: ?>


<?php if ($_POST['bulan']=='01'): ?>
	<?php $bln="Januari" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='02'): ?>
	<?php $bln="Februari" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='03'): ?>
	<?php $bln="Maret" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='04'): ?>
	<?php $bln="April" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='05'): ?>
	<?php $bln="Mei" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='06'): ?>
	<?php $bln="Juni" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='07'): ?>
	<?php $bln="Juli" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='08'): ?>
	<?php $bln="Augustus" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='09'): ?>
	<?php $bln="September" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='10'): ?>
	<?php $bln="Oktober" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='11'): ?>
	<?php $bln="November" ?>
<?php endif ?>
<?php if ($_POST['bulan']=='12'): ?>
	<?php $bln="Desember" ?>
<?php endif ?>


	<h2>Data Pembelian <?php if ($_POST['bulan']=="") {}else{echo "Bulan ".($bln);} ?> <?php if ($_POST['tahun']=="") {}else{echo "Tahun ".$_POST['tahun'];} ?></h2>
<?php endif ?>
	<table class="table table-bordered">
		<thead class="label-info">
			<tr>
				<th class="text-center">No</th>
				<th class="text-center">Kode</th>
				<th class="text-center">Tgl Beli</th>
				<th class="text-center">Nama Member</th>
				<th class="text-center">Jml Produk</th>
				<th class="text-center">Total Belanja</th>
				<th class="text-center">Total Ongkir</th>
				<th class="text-center">Total Biaya</th>
				<th class="text-center">No Resi</th>
				<th class="text-center">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data_pembelian as $key => $value): ?>
				<tr>
					
					<td class="text-center"><?php echo $key+1; ?></td>
					<td class="text-center">KD<?php echo $value['id_pembelian'] ?></td>
					<td class="text-center"><?php $date=date_create($value ['tgl_pembelian']);echo date_format($date,"d/m/Y") ?></td>
					<td class="text-center"><?php echo $value['nama_member'] ?></td>
					<td class="text-center"><?php echo $value['jumlah_beli'] ?></td>
					<td class="text-center">Rp. <?php echo number_format($value['total_belanja']) ?></td>
					<td class="text-center">Rp. <?php echo number_format($value['total_ongkir']) ?></td>
					<td class="text-center">Rp. <?php echo number_format($value['total_bayar']) ?></td>
					<td class="text-center">
						<?php if ($value['no_resi']==""): ?>
							---
						<?php else: ?>
							<?php echo $value['no_resi'] ?>
						<?php endif ?>
					</td>
					<td class="text-center"><?php echo $value['status_pembelian']; ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
<?php if ($data_pembelian==array()):?>
<?php else: ?>
	<a onclick="window.print()" class="btn btn-info hidden-print">Print</a>
<?php endif ?>
