<?php 
$hitung_beli = count($pembelian->tampil_pembelian());
$hitung_produk= count($produk->tampil_produk());
$hitung_pelgg = count($member->tampil_member());
$hitung_komen = count($komentar->tampil_komentar_admin());
$hitung_konfir = count($konfirmasi->tampil_konfirmasi());
$hitung_retur = count($pembelian->tampil_retur());
 ?>

<h3><b>Dashboard</b></h3>
<hr>
<div class="col-md-3" style="border: solid; border-color: white;">
	<a href="index.php?halaman=member" title="Lihat Informasi Member">
		<div class="row" style="background: #4E8EF7;">
			<div class="col-md-6">
				<div style="padding-top: 20px;">
					<h4 style="color: white"><b><?php echo $hitung_pelgg ?></b></h4>
					<h4 style="color: #83B0F9"><b>Member</b></h4>
				</div>
			</div>
			<div class="col-md-6">
				<div style="padding-top: 10px; color: #83B0F9">
					<i class="fa fa-user fa-5x"></i>
				</div>
			</div>
		</div>
	</a>
</div>
<div class="col-md-3" style="border: solid; border-left: none; border-color: white;">
	<a href="index.php?halaman=produk" title="Lihat Informasi Produk">
		<div class="row" style="background: #68B828">
			<div class="col-md-6">
				<div style="padding-top: 20px;">
					<h4 style="color: white"><b><?php echo $hitung_produk ?></b></h4>
					<h4 style="color: #96CD69"><b>Produk</b></h4>
				</div>
			</div>
			<div class="col-md-6">
				<div style="padding-top: 10px; color: #96CD69">
					<i class="fa fa-shopping-cart fa-5x"></i>
				</div>
			</div>
		</div>
	</a>
</div>
<div class="col-md-3" style="border: solid; border-left: none; border-color: white;">
	<a href="index.php?halaman=review" title="Lihat Informasi Review">
		<div class="row" style="background: #DE1771">
			<div class="col-md-6">
				<div style="padding-top: 20px;">
					<h4 style="color: white"><b><?php echo $hitung_komen ?></b></h4>
					<h4 style="color: #E85D9C"><b>Review</b></h4>
				</div>
			</div>
			<div class="col-md-6">
				<div style="padding-top: 10px; color: #E85D9C">
					<i class="fa fa-commenting fa-5x"></i>
				</div>
			</div>
		</div>
	</a>
</div>
<div class="col-md-3" style="border: solid; border-left: none; border-color: white;">
	<a href="index.php?halaman=pembelian" title="Lihat Informasi Pembelian">
		<div class="row" style="background:#FFBA00">
			<div class="col-md-6">
				<div style="padding-top: 20px;">
					<h4 style="color: white"><b><?php echo $hitung_beli ?></b></h4>
					<h4 style="color: #FFD371"><b>Pembelian</b></h4>
				</div>
			</div>
			<div class="col-md-6">
				<div style="padding-top: 10px; color: #FFD371">
					<i class="fa fa-bars fa-5x"></i>
				</div>
			</div>
		</div>
	</a>
</div>
<div class="col-md-3" style="border: solid; border-top: none; border-color: white;">
	<a href="index.php?halaman=konfirmasi" title="Lihat Informasi Konfirmasi">
		<div class="row" style="background: #DD4250">
			<div class="col-md-6">
				<div style="padding-top: 20px;">
					<h4 style="color: white"><b><?php echo $hitung_konfir ?></b></h4>
					<h4 style=" color: #F96479"><b>Konfirmasi</b></h4>
				</div>
			</div>
			<div class="col-md-6">
				<div style="padding-top: 10px; color: #F96479">
					<i class="fa fa-check-square fa-5x"></i>
				</div>
			</div>
		</div>
	</a>
</div>
<div class="col-md-3" style="border: solid; border-left: none; border-top: none; border-color: white;">
	<a href="index.php?halaman=retur" title="Lihat Informasi Retur">
		<div class="row" style="background: #9677DE">
			<div class="col-md-6">
				<div style="padding-top: 20px;">
					<h4 style="color: white"><b><?php echo $hitung_retur ?></b></h4>
					<h4 style=" color: #B29AF4"><b>Retur</b></h4>
				</div>
			</div>
			<div class="col-md-6">
				<div style="padding-top: 10px; color: #B29AF4">
					<i class="fa fa-arrow-left fa-5x"></i>
				</div>
			</div>
		</div>
	</a>
</div>
