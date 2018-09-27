<?php 
$idretur=$_GET['id'];
$tampil=$pembelian->ambil_retur($idretur);
 ?>

<div class="col-md-6">
	<img style="max-width: 400px" class="center-block img-thumbnail" src="../asset/img/ongkos/<?php echo $tampil['bukti_ongkos'] ?>" alt="">
<center><strong><i>Foto Bukti Ongkos Pengiriman Retur</i></strong></center>
</div>

<div class="col-md-6">
	<img style="max-width: 400px" class="center-block img-thumbnail" src="../asset/img/retur/<?php echo $tampil['bukti_retur'] ?>" alt="">
<center><strong><i>Foto Bukti Retur</i></strong></center>
</div>

