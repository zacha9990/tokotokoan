<?php 
if(isset($_GET['id']))
{
	$jumlah=1;
	$keranjang->masukkan_keranjang($jumlah, $_GET['id']);
	echo "<script>alert('Produk Ditambahkan ke Keranjang')</script>";	
	echo "<script>location= 'index.php?halaman=keranjang'</script>";	
}
// 	$idpro = $_GET['id'];
// 	// jika sudah pernah beli barang
// 	if(isset($_SESSION['keranjang'][$idpro]))
// 	{
// 		$_SESSION['keranjang'][$idpro]+=1;
// 		echo "<script>location= 'index.php?halaman=keranjang'</script>";
// 	}
// 	// jika belum pernah beli baarang
// 	else
// 	{
// 		$_SESSION['keranjang'][$idpro]=1;
// 	}
// }

$data = $keranjang->tampil_keranjang();
// echo "<pre>";
// print_r($data);
// echo "</pre>";

?>
<div class="container" style="margin-bottom: 300px">
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
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($_SESSION['keranjang'])): ?>
				
			<?php foreach ($data as $key => $value): ?>
				
				<tr class="text-center">
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['nama_produk'] ?></td>
					<td><?php echo $value['jumlah'] ?></td>
					<td><?php echo $value['berat'] ?> kg</td>
					<td>Rp. <?php echo number_format($value['harga']) ?></td>
					<td><?php echo $value['sub_berat'] ?> kg</td>
					<td>Rp. <?php echo number_format($value['sub_total']) ?></td>
					<td>
						<a class="btn btn-danger btn-block" href="index.php?halaman=hapuskeranjang&id=<?php echo $value['id_produk'] ?>"><i class="fa fa-trash"></i> Hapus Item</a>
					</td>
				</tr>
			<?php endforeach ?>
		
			<?php else: ?>
				<td class="text-center">--</td>
				<td class="text-center">----</td>
				<td class="text-center">0</td>
				<td class="text-center">0 Kg</td>
				<td class="text-center">Rp. 0</td>
				<td class="text-center">0 Kg</td>
				<td class="text-center">Rp. 0</td>
				<td class="text-center">-</td>
			<?php endif ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6" class="warning">Total Belanja</th>
				<?php if (!empty($_SESSION['keranjang'])): ?>
					
				<th class="text-center warning">Rp. <?php echo number_format($value['total_belanja']) ?></th>
				<th>
					<form action="" method="post">
						<button class="btn btn-default btn-block" name="kosong">Kosongkan Keranjang</button>
					</form>
				</th>
				<?php else: ?>
					<th class="text-center warning">Rp. 0</th>
				<?php endif ?>
			</tr>
		</tfoot>
	</table>
	<a href="index.php" class="btn btn-default">Lanjut belanja</a>
	<?php if (!empty($_SESSION['keranjang'])): ?>
		<a href="index.php?halaman=checkout" class="btn btn-primary">Check Out</a>
	<?php endif ?>
	<br>
	<br>
	<?php if (!empty($_SESSION['keranjang'])): ?>
	<div class="alert alert-warning"><p><strong>Catatan:</strong></p>
	<p>> Pilih menu checkout jika anda sudah merasa yakin dengan produk belanjaan anda untuk melengkapi data pengiriman</p><p>> Pilih menu lanjut belanja jika anda ingin menambahkan produk yang lain</p>
	<?php endif ?>
	</div>
	<?php 
	if(isset($_POST['kosong']))
	{
		unset($_SESSION['keranjang']);
		echo "<script>alert ('Keranjang Belanja Telah dikosongkan')</script>";
		echo "<script>location='index.php';</script>";
	}

	 ?>
</div>
</div>


