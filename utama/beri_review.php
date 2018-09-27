<?php 
$idbeli = $_GET['id'];

$belanja = $pembelian->ambil_detail_pembelian($idbeli);
// echo "<pre>";
// print_r($belanja);
// echo "</pre>";

?>

<div class="container">

	<table class="table table-bordered">
		<thead>
			<tr class="label-info">
				<th width="30px" class="text-center">No</th>
				<!-- <th class="text-center">Produk</th> -->
				<th class="text-center">Nama Produk</th>
				<th class="text-center">Opsi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($belanja as $key => $value): ?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<!-- <td>
						<img src="../asset/img/produk/<?php echo $value['id_produk'] ?>" alt="" width="100">
					</td> -->
					<td><?php echo $value['nama_produk'] ?></td>
					<td>

							<a href="index.php?halaman=rating&id_produk=<?php echo $value['id_produk'] ?>&idbeli=<?php echo $_GET['id'] ?>" class="btn btn-info btn-sm btn-block">Beri Review Produk</a>
							
							
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- validasi komentar, 1x komen di produk tertentu maka tidak bisa lagi komen di produk yg sama
solusi: table pembelian di join komentar, supaya kalau mau beli lagi dengan pembeli yg sama bisa melakukan komen di produk yg sama karena id pembeliannya sudah berbeda -->

						
						<!-- <?php if ($value['status_komentar']!=="Pending" || $value['status_komentar']!=="Publish"): ?> -->

						<!-- <?php else: ?> -->
						
						<!-- <?php endif ?> -->