<?php 
session_start();

$database= new mysqli("localhost","root","123456","toko");


// CLASS member

class member
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}
	function tampil_member()
	{
		$semuadata= array();
		$ambil= $this->koneksi->query("SELECT * FROM member ORDER BY id_member DESC");

		while ($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function ngecek_email($email)
	{
		$cek=$this->koneksi->query("SELECT * FROM member WHERE email='$email'");
		return $cek->num_rows;
	}
	function ubah_pass($password,$email)
	{
		$pass=sha1($password);
		$this->koneksi->query("UPDATE member SET password='$pass' WHERE email='$email'");
	}
	function tambah_member($nama, $user, $email, $pass, $telepon, $alamat, $foto)
	{
		$namafoto= $foto['name'];

		$waktu = date("Y-m-d-H-i-s");

		$fotobaru= $waktu."_".$namafoto;

		$lokasi= $foto['tmp_name'];

		move_uploaded_file($lokasi, "../asset/img/member/$fotobaru");
		$pw = sha1($pass);
		$this->koneksi->query("INSERT INTO member (nama_member, username, email, password, telepon, alamat, foto) VALUES ('$nama','$user', '$email','$pw','$telepon','$alamat','$fotobaru')") or die (mysqli_error($this->koneksi));
	}
	function ambil_member($id)
	{
		$ambilid= $this->koneksi->query("SELECT * FROM member WHERE id_member='$id'");
		$pecah= $ambilid->fetch_assoc();
		return $pecah;
	}
	function ubah_member($nama, $email, $telepon, $alamat, $foto, $ubahid)
	{
		$namafoto= $foto['name'];

		$waktu = date("Y-m-d-H-i-s");

		$fotobaru= $waktu."_".$namafoto;

		$lokasi= $foto['tmp_name'];

		if(!empty($lokasi))
		{
			$ambil= $this->ambil_member($ubahid);
			$fotohapus= $ambil['foto'];

			if(file_exists("../asset/img/member/$fotohapus"))
			{
				unlink("../asset/img/member/$fotohapus");
			}
			move_uploaded_file($lokasi, "../asset/img/member/$fotobaru");

			// mengubah semua termasuk foto
			$this->koneksi->query("UPDATE member SET nama_member='$nama', email='$email', telepon='$telepon', alamat='$alamat', foto='$fotobaru' WHERE id_member='$ubahid'") or die (mysqli_error($this->koneksi));
		}
		else
		{
			// tanpa mengubah foto
			$this->koneksi->query("UPDATE member SET nama_member='$nama', email='$email', telepon='$telepon', alamat='$alamat' WHERE id_member='$ubahid'") or die (mysqli_error($this->koneksi));
		}
	}
	function hapus_member($idhapus)
	{
		$ambil= $this->ambil_member($idhapus);
		$fotohapus= $ambil['foto'];

		if(file_exists("../asset/img/member/$fotohapus"))
		{
			unlink("../asset/img/member/$fotohapus");
		}
		$this->koneksi->query("DELETE FROM member WHERE id_member='$idhapus'") or die (mysqli_error($this->koneksi));
	}
	function login_member($user, $pass)
	{
		$passw = sha1($pass);
			// mengambil data member berdasarkan input login
		$ambil= $this->koneksi->query("SELECT * FROM member WHERE email='$user' AND password='$passw' OR username='$user' AND password='$passw'");
			// mengecek / menghitung data yg cocok
		$cek= $ambil->num_rows;
			// jika $cek == 1 maka
		if($cek==1)
		{
				// memecah ke array
			$akun= $ambil->fetch_assoc();
				// menyimpan akun ke session
			$_SESSION ['member'] = $akun;
			return "sukses";
		}
		else
		{
			return "gagal";
		}
	}
	function cek_login($pass)
	{
		$pasw = sha1($pass);

		$ambil= $this->koneksi->query("SELECT * FROM member WHERE password='$pasw'");
		// mengecek / menghitung data yg cocok
		$cek = $ambil->num_rows;
		// jika $cek == 1 maka
		if($cek==1)
		{
			return "sukses";
		}
		else
		{
			return "gagal";
		}
	}
	function ganti_password($pass, $id)
	{
		$pasw=sha1($pass);
		$this->koneksi->query("UPDATE member SET password='$pasw' WHERE id_member='$id'");
	}
	function cek_email($email)
	{
		$ambil = $this->koneksi->query("SELECT * FROM member WHERE email='$email'");

		$cek = $ambil->num_rows;
		if ($cek==0) 
		{
			return "tidak ada";	
		}
		else
		{
			return "ada";	
		}
	}
	function reset_password($pass, $email)
	{
		$pasw = sha1($pass);
		$this->koneksi->query("UPDATE member SET password='$pasw' WHERE email='$email'");
	}

}
$member = new member($database);


// CLASS KATEGORI

class kategori
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}

	function tampil_kategori()
	{
		$semuadata= array();
		$ambil= $this->koneksi->query("SELECT * FROM kategori ORDER BY nama_kategori DESC");

		while ($pecah= $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function tampil_kategori_produk($id)
	{
		$semuadata = array();
		$ambil= $this->koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE produk.id_kategori='$id'");

		while ($pecah= $ambil->fetch_assoc())
		{
			$semuadata [] = $pecah;
		}
		return $semuadata;
	}
	function tambah_kategori($nama)
	{
		$this->koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')") or die (mysqli_error($this->koneksi));
	}
	function ambil_kategori($ubahid)
	{
		$ambilid= $this->koneksi->query("SELECT * FROM kategori WHERE id_kategori='$ubahid'");

		$pecah= $ambilid->fetch_assoc();

		return $pecah;
	}
	function ubah_kategori($nama, $ubahid)
	{
		$this->koneksi->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$ubahid'") or die (mysqli_error($this->koneksi));
	}
	function hapus_kategori($idhapus)
	{
		$this->koneksi->query("DELETE FROM kategori WHERE id_kategori='$idhapus'") or die (mysqli_error($this->koneksi));
	}
}
$kategori= new kategori($database);


// CLASS PRODUK

class produk
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi= $database;
	}
	
	function tampil_produk()
	{
		$semuadata= array();
		$ambil= $this->koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori ORDER BY nama_kategori DESC");

		while ($pecah= $ambil->fetch_assoc())
		{
			$semuadata [] = $pecah;
		}
		return $semuadata;
	}
	function tambah_produk($nama, $idkat, $desk, $hrg, $berat, $stok, $foto, $format)
	{
		$namafoto= $format;
		$waktu= date("Y-m-d-H-i-s");
		$namabaru= $waktu.".".$namafoto;
		$lokasi= $foto [tmp_name];
		move_uploaded_file($lokasi, "../asset/img/produk/$namabaru");
		$this->koneksi->query("INSERT INTO produk (nama_produk, id_kategori, deskripsi, harga, berat, stok, foto_produk) VALUES ('$nama', '$idkat','$desk', '$hrg', '$berat', '$stok', '$namabaru')")or die (mysqli_error($this->koneksi));
	}
	function ambil_produk($idhapus)
	{
		$ambil= $this->koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE id_produk='$idhapus'");
		$pecah= $ambil->fetch_assoc();
		return $pecah;
	}
	function hapus_produk($idhapus)
	{
		$ambil= $this->ambil_produk($idhapus);
		$fotohapus= $ambil ['foto_produk'];
		if(file_exists("../asset/img/produk/$fotohapus"))
		{
			unlink ("../asset/img/produk/$fotohapus");
		}

		$this->koneksi->query("DELETE FROM produk WHERE id_produk='$idhapus'");
	}
	function ubah_produk($nama, $idkat, $deskripsi, $harga, $berat, $stok, $foto, $idubah)
	{
		$namafoto= $foto ['name'];
		$waktu= date("Y-m-d-H-i-s");
		$namabaru= $waktu."_".$namafoto;
		$lokasi= $foto ['tmp_name'];

		if(!empty($lokasi))
		{
			$ambil= $this->ambil_produk($idubah);
			$fotohapus= $ambil ['foto_produk'];
			if(file_exists("../asset/img/produk/$fotohapus"))
			{
				unlink("../asset/img/produk/$fotohapus");
			}
			move_uploaded_file($lokasi, "../asset/img/produk/$namabaru");
			$this->koneksi->query("UPDATE produk SET nama_produk='$nama', id_kategori='$idkat', deskripsi='$deskripsi', harga='$harga', berat='$berat', stok='$stok', foto_produk='$namabaru' WHERE id_produk='$idubah'")or die (mysqli_error($this->koneksi));
		}
		else
		{
			$this->koneksi->query("UPDATE produk SET nama_produk='$nama', id_kategori='$idkat', deskripsi='$deskripsi', harga='$harga', berat='$berat', stok='$stok' WHERE id_produk='$idubah'")or die (mysqli_error($this->koneksi));
		}
	}
	function cari_produk($keyword)
	{
		$semuadata = array();
		$ambil = $this->koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE nama_produk LIKE '%$keyword%' OR nama_kategori LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'")or die (mysqli_error($this->koneksi));
		while ($pecah = $ambil->fetch_assoc())
		{
		$semuadata[] = $pecah;
		}
		return $semuadata;
	}
}
$produk = new produk($database);


// FUNGSI KOMENTAR

class komentar
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}
	function simpan_komentar($idpel, $idproduk, $isi, $rating)
	{
		$status = "Pending";
		$tgl = date("Y-m-d");
		$this->koneksi->query("INSERT INTO komentar (id_member, id_produk, tgl_komentar, isi_komentar, rating, status_komentar) VALUES ('$idpel','$idproduk','$tgl','$isi','$rating','$status')");
	}
	function tampil_komentar_produk($idproduk)
	{
		$semuadata = array();
		$ambil = $this->koneksi->query("SELECT * FROM komentar JOIN member ON komentar.id_member=member.id_member WHERE id_produk='$idproduk' AND status_komentar='Publish'");
		while ($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function ambil_review($idkom, $idpro)
	// untuk menampilkan produk di review dibutuhkan id_produk dan id_komentar melalui $_GET
	{
		$ambil = $this->koneksi->query("SELECT * FROM komentar JOIN member JOIN produk ON komentar.id_member=member.id_member AND komentar.id_produk=produk.id_produk WHERE id_komentar='$idkom' AND komentar.id_produk='$idpro'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function hapus_komentar($idhapus)
	{
		$this->koneksi->query("DELETE FROM komentar WHERE id_komentar='$idhapus'");
	}
	function tampil_komentar_admin()
	{
		$semuadata = array();
		$ambil = $this->koneksi->query("SELECT * FROM komentar JOIN member ON komentar.id_member=member.id_member ORDER BY id_komentar DESC");
		while ($pecah = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function publish($id)
	{
		$status="Publish";
		$this->koneksi->query("UPDATE komentar SET status_komentar='$status' WHERE id_komentar='$id'");
	}
	function hitung_komentar_baru()
	{
		$semuadata = array();
		$status = "Pending";
		$ambil = $this->koneksi->query("SELECT * FROM komentar WHERE status_komentar='$status'");
		while ($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
}
$komentar = new komentar($database);


// FUNGSI ADMIN

class admin
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}
	function login_admin($user, $pass)
	{
			// mengambil data admin berdasarkan input login
		$ambil= $this->koneksi->query("SELECT * FROM admin WHERE username='$user' AND password='$pass'");
			// mengecek / menghitung data yg cocok
		$cek= $ambil->num_rows;
			// jika $cek == 1 maka
		if($cek==1)
		{
				// memecah ke array
			$akun= $ambil->fetch_assoc();
				// menyimpan akun ke session
			$_SESSION ['admin'] = $akun;
			return "sukses";
		}
		else
		{
			return "gagal";
		}
	}
}
$admin = new admin($database);


class auto
{
	public $koneksi; 

	function __construct($database)
	{
		$this->koneksi = $database;
	}

	function cek_expired()
	{
		$status='Pending';
		$semuadata=array();
		$ambil = $this->koneksi->query("SELECT * FROM pembelian JOIN detail_pembelian ON pembelian.id_pembelian=detail_pembelian.id_pembelian WHERE pembelian.tgl_expired < CURDATE() AND pembelian.status_pembelian='$status'");
		while ($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}

	function auto_delete_pembelian($idpro, $jumlah,$idbeli)
	{
		$ambil = $this->koneksi->query("SELECT * FROM produk WHERE id_produk='$idpro'");
		$pecah = $ambil->fetch_assoc();

		$stok_lama = $pecah['stok'];
		$stok_baru = $stok_lama + $jumlah;

		$this->koneksi->query("UPDATE produk SET stok='$stok_baru' WHERE id_produk='$idpro' ");

		//$today=date("Y-m-d");
		$status='Pending';

		
		$this->koneksi->query("DELETE FROM detail_pembelian WHERE id_pembelian='$idbeli' ");

		$this->koneksi->query("DELETE FROM pembelian WHERE status_pembelian='$status' AND tgl_expired < CURDATE() ");

	}
}
$auto = new auto($database);

$cek_expired = $auto->cek_expired();
if(!empty($cek_expired))
{
	foreach ($cek_expired as $key => $value) 
	{
		$idbeli = $value['id_pembelian'];
		$idpro = $value['id_produk'];
		$jumlah = $value['jumlah_produk'];
		$auto->auto_delete_pembelian($idpro, $jumlah, $idbeli);
	}
}



// FUNCTION ONGKIR

class ongkir
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}

	function tampil_provinsi()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/province?id=",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 17e03f62ba7ed304563b7864f5dd85fc"
				),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$provinsi = json_decode($response, TRUE);
			$data_provinsi = $provinsi['rajaongkir']['results'];

			return $data_provinsi;
		}
	}

	function tampil_kota($id_provinsi="")
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=&province=$id_provinsi",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 17e03f62ba7ed304563b7864f5dd85fc"
				),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$kota = json_decode($response, TRUE);
			$data_kota = $kota['rajaongkir']['results'];

			return $data_kota;
		}
	}

	function tampil_ongkir($kota_tujuan, $berat, $kurir)
	{
		// untuk mengganti asal kota yang diganti adalah nilai originnya dengan city_id, city_id bisa di lihat di http://localhost/project/APLIKASI/data_ongkir.php
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=283&destination=$kota_tujuan&weight=$berat&courier=$kurir",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: 17e03f62ba7ed304563b7864f5dd85fc"
				),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$ongkir = json_decode($response, TRUE);

			if (!isset($ongkir['rajaongkir']['results']['0']['costs']))
			{
				$data_ongkir="";
			}
			else
			{
				$data_ongkir = $ongkir['rajaongkir']['results']['0']['costs'];
			}

			return $data_ongkir;
		}
	}

}
$ongkir= new ongkir($database);


// FUNCTION PEMBELIAN

class pembelian extends produk
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}
	function tampil_pembelian()
	{
		$semuadata= array();
		$tampil = $this->koneksi->query("SELECT * FROM pembelian JOIN member ON pembelian.id_member=member.id_member ORDER BY id_pembelian DESC");
		while ($pecah = $tampil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function laporan_pembelian($bulan, $tahun)
	{
		

		if(empty($bulan))
		{
			$semuadata = array();

			$ambil = $this->koneksi->query("SELECT * FROM pembelian JOIN member ON pembelian.id_member=member.id_member WHERE YEAR(tgl_pembelian)='$tahun'")or die(mysqli_error($this->koneksi));

			while ($pecah = $ambil->fetch_assoc()) 
			{
				$semuadata[] = $pecah;
			}

			return $semuadata;
		}
		elseif(empty($tahun))
		{
			$semuadata = array();

			$ambil = $this->koneksi->query("SELECT * FROM pembelian JOIN member ON pembelian.id_member=member.id_member WHERE MONTH(tgl_pembelian)='$bulan'")or die(mysqli_error($this->koneksi));

			while ($pecah = $ambil->fetch_assoc()) 
			{
				$semuadata[] = $pecah;
			}

			return $semuadata;
		}
		else
		{
			$semuadata = array();

			$ambil = $this->koneksi->query("SELECT * FROM pembelian JOIN member ON pembelian.id_member=member.id_member WHERE MONTH(tgl_pembelian)='$bulan' AND YEAR(tgl_pembelian)='$tahun'")or die(mysqli_error($this->koneksi));

			while ($pecah = $ambil->fetch_assoc()) 
			{
				$semuadata[] = $pecah;
			}

			return $semuadata;
		}
	}
	function tampil_pembelian_member($idpel)
	{
		$semuadata=array();
		$tampil = $this->koneksi->query("SELECT * FROM pembelian WHERE id_member='$idpel' ORDER BY id_pembelian DESC");
		while ($pecah = $tampil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function ambil_pembelian($idpembelian)
	{
		$ambil = $this->koneksi->query("SELECT * FROM pembelian JOIN member ON pembelian.id_member=member.id_member WHERE id_pembelian='$idpembelian'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function ambil_detail_pembelian($idpembelian)
	{
		$semuadata=array();
		$ambil = $this->koneksi->query("SELECT * FROM detail_pembelian JOIN pembelian ON detail_pembelian.id_pembelian=pembelian.id_pembelian JOIN produk ON detail_pembelian.id_produk=produk.id_produk WHERE detail_pembelian.id_pembelian='$idpembelian'")or die(mysqli_error($this->koneksi));
		while ($pecah = $ambil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function detail_detail_pembelian($iddp)
	{
		$ambil = $this->koneksi->query("SELECT * FROM detail_pembelian JOIN produk ON 
			detail_pembelian.id_produk=produk.id_produk JOIN pembelian ON detail_pembelian.id_pembelian=pembelian.id_pembelian
			WHERE id_detail_pembelian='$iddp'")or die(mysqli_error($this->koneksi));
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function retur_pembelian($id_detail_pembelian,$alasan,$rekening,$bukti1,$bukti2)
	{
		$tanggal = date("Y-m-d");
		$status="Pending";
		$namabukti1 = $bukti1["name"];
		$lokasibukti1 = $bukti1["tmp_name"];
		$namabukti2 = $bukti2["name"];
		$lokasibukti2 = $bukti2["tmp_name"];

		$namafiks1 = date("Y_m_d_H_i_s").$namabukti1;
		move_uploaded_file($lokasibukti1, "../asset/img/ongkos/$namafiks1");
		$namafiks2 = date("Y_m_d_H_i_s").$namabukti2;
		move_uploaded_file($lokasibukti2, "../asset/img/retur/$namafiks2");

		$this->koneksi->query("INSERT INTO retur 
			(id_detail_pembelian,alasan_retur,tanggal_retur,status_retur,bukti_ongkos,bukti_retur,rekening_retur)
			VALUES ('$id_detail_pembelian','$alasan','$tanggal','$status','$namafiks1','$namafiks2','$rekening') ") or die(mysqli_error($this->koneksi));
	}
	function tampil_retur()
	{
		$semuadata = array();
		$status="Dikirim";
		$ambil = $this->koneksi->query("SELECT * FROM retur JOIN detail_pembelian 
			ON retur.id_detail_pembelian=detail_pembelian.id_detail_pembelian
			JOIN produk ON detail_pembelian.id_produk=produk.id_produk JOIN pembelian ON pembelian.id_pembelian=detail_pembelian.id_pembelian JOIN member ON member.id_member=pembelian.id_member ORDER BY id_retur DESC");
		while ($pecah = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function ambil_retur($idretur)
	{
		$ambil = $this->koneksi->query("SELECT * FROM retur WHERE id_retur='$idretur'");
		return $pecah = $ambil->fetch_assoc();
	}
	function email_ubah_retur($idretur)
	{
		$ambil = $this->koneksi->query("SELECT * FROM retur JOIN detail_pembelian 
			ON retur.id_detail_pembelian=detail_pembelian.id_detail_pembelian
			JOIN produk ON detail_pembelian.id_produk=produk.id_produk JOIN pembelian ON pembelian.id_pembelian=detail_pembelian.id_pembelian JOIN member ON member.id_member=pembelian.id_member WHERE id_retur='$idretur'");
		return $pecah = $ambil->fetch_assoc();
	}
	function ambil_retur_member($iddet)
	{
		$ambil = $this->koneksi->query("SELECT * FROM retur JOIN detail_pembelian ON retur.id_detail_pembelian=detail_pembelian.id_detail_pembelian JOIN produk ON detail_pembelian.id_produk=produk.id_produk WHERE retur.id_detail_pembelian='$iddet'");
		return $pecah = $ambil->fetch_assoc();
	}
	function ubah_status_retur($status, $id)
	{
		$this->koneksi->query("UPDATE retur SET status_retur='$status' WHERE id_retur='$id'");
	}
	function cek_retur($iddp)
	{
		$ambil = $this->koneksi->query("SELECT * FROM retur WHERE id_detail_pembelian='$iddp'");
		return $ambil->num_rows;
	}
	function hapus_retur($idhapus)
	{
		$this->koneksi->query("DELETE FROM retur WHERE id_retur='$idhapus'");
	}
	function tambah_pembelian($id_pel, $tgl, $jmlbeli, $totalbelanja, $totalberat, $ongkir, $totalbayar, $status, $nama, $telp, $alamat, $kota, $paket, $kodepos, $kurir)
	{
		$expired = date('y-m-d', strtotime("+1 day"));
		$this->koneksi->query("INSERT INTO pembelian (id_member, tgl_pembelian, tgl_expired, jumlah_beli, total_belanja, total_berat, total_ongkir, total_bayar, status_pembelian, nama_penerima, telp_penerima, alamat_penerima, kota, nama_paket, kode_pos, nama_kurir) VALUES ('$id_pel','$tgl','$expired','$jmlbeli','$totalbelanja','$totalberat','$ongkir','$totalbayar','$status','$nama','$telp','$alamat','$kota','$paket','$kodepos','$kurir')")or die(mysqli_error($this->koneksi));

		return $idpembelian = mysqli_insert_id($this->koneksi);
		// echo "<pre>";
		// print_r($isikeranjang);
		// echo "</pre>";

		
	}

	function simpan_detail_pembelian($idpembelian, $idpro, $jumlah, $subberat, $subtotal)
	{
		
			$this->koneksi->query("INSERT INTO detail_pembelian (id_pembelian, id_produk,  jumlah_produk, subberat_produk, subtotal_produk) VALUES ('$idpembelian','$idpro','$jumlah','$subberat','$subtotal')");
			
			$ambil = $this->ambil_produk($idpro);
			$stok = $ambil['stok'];
			$stok_baru = $stok-$jumlah;

			$this->koneksi->query("UPDATE produk SET stok = '$stok_baru' WHERE id_produk='$idpro'");
	}
	function batal_beli($idpro, $jumlah, $idbeli)
	{
		$ambilpro = $this->ambil_produk($idpro);
		$stok_lama = $ambilpro['stok'];
		$stok_baru = $stok_lama+$jumlah;

		$this->koneksi->query("UPDATE produk SET stok='$stok_baru' WHERE id_produk='$idpro'");
		$this->koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$idbeli'");
		$this->koneksi->query("DELETE FROM detail_pembelian WHERE id_pembelian='$idbeli'");
	}
	function simpan_resi($resi, $id)
	{
		$status="Dikirim";
		$this->koneksi->query("UPDATE pembelian SET no_resi='$resi', status_pembelian='$status' WHERE id_pembelian='$id'")or die(mysqli_error($this->koneksi));
	}
	function ambil_resi($id)
	{
		$ambil = $this->koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id'");
		$pecah = $ambil->fetch_assoc();
		$resi = $pecah['no_resi'];
		return $resi;
	}
	function hitung_pembelian_baru()
	{
		$semuadata = array();
		$status="Dikirim";
		$ambil = $this->koneksi->query("SELECT * FROM pembelian WHERE status_pembelian!='$status'");
		while ($pecah = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function hitung_retur_baru()
	{
		$semuadata = array();
		$status="Pending";
		$ambil = $this->koneksi->query("SELECT * FROM retur WHERE status_retur='$status'");
		while ($pecah = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
}

$pembelian = new pembelian($database);

// FUNCTION KONFIRMASI

class konfirmasi
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}
	function tampil_konfirmasi()
	{
		$semuadata=array();
		$status1="Dikirim"; 
		$status2="Sudah Konfirmasi";
		$tampil = $this->koneksi->query("SELECT * FROM konfirmasi JOIN pembelian ON konfirmasi.id_pembelian=pembelian.id_pembelian JOIN member ON pembelian.id_member=member.id_member  WHERE pembelian.status_pembelian='$status1' OR pembelian.status_pembelian='$status2' ORDER BY konfirmasi.id_pembelian DESC");
		while ($pecah = $tampil->fetch_assoc())
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function ambil_konfirmasi($idkon, $idbeli)
	{
		// $status="Dikirim" OR "Sudah Konfirmasi";
		$tampil = $this->koneksi->query("SELECT * FROM konfirmasi JOIN pembelian JOIN member ON pembelian.id_member=member.id_member AND konfirmasi.id_pembelian=pembelian.id_pembelian WHERE id_konfirmasi='$idkon' AND konfirmasi.id_pembelian='$idbeli'");
		$pecah = $tampil->fetch_assoc();
		return $pecah;
	}
	function simpan_konfirmasi($idbeli, $nama, $bank, $rek, $jumlah, $foto)
	{
		$tgl= date("Y-m-d-H-i-s");
		$namafoto = date("Y-m-d-H-i-s")."_".$foto['name'];
		$lokasi = $foto['tmp_name'];
		move_uploaded_file($lokasi, "../asset/img/konfirmasi/$namafoto");

		$this->koneksi->query("INSERT INTO konfirmasi (id_pembelian, tgl_transfer, no_rek, jumlah_transfer, nama_pengirim, bank, bukti_transfer) VALUES ('$idbeli','$tgl','$rek','$jumlah','$nama','$bank','$namafoto')");

		$status='Sudah Konfirmasi';
		$this->koneksi->query("UPDATE pembelian SET status_pembelian='$status' WHERE id_pembelian='$idbeli'");
	}
	function hapus_konfirmasi($idhapuskon, $idhapuspem)
	{
		$this->koneksi->query("DELETE FROM konfirmasi WHERE id_konfirmasi='$idhapuskon'");
		$this->koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$idhapuspem'");
	}
	function hitung_konfirmasi_baru()
	{
		$semuadata = array();
		$status="Sudah Konfirmasi";
		$ambil = $this->koneksi->query("SELECT * FROM konfirmasi JOIN pembelian ON konfirmasi.id_pembelian=pembelian.id_pembelian WHERE pembelian.status_pembelian='$status'");
		while ($pecah = $ambil->fetch_assoc()) 
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
}
$konfirmasi = new konfirmasi($database);

class keranjang
{
 public $koneksi;
	function __construct($database)
	{
		$this->koneksi= $database;
	}

//------------------------------masukkan keranjang---------------------
	function masukkan_keranjang($jumlah, $id)
	{
		if (isset($_SESSION['keranjang'][$id])) 
		{
			$_SESSION['keranjang'][$id]['id_produk']=$id;
			$_SESSION['keranjang'][$id]['jumlah']+=$jumlah;		
		}
		else
		{
			$_SESSION['keranjang'][$id]['id_produk']=$id;
			$_SESSION['keranjang'][$id]['jumlah']=$jumlah;
		}
	}
	function tampil_keranjang()
	{
		if (isset($_SESSION['keranjang'])) 
		{
			$semuadata = array();
			$totalbelanja= 0;
			$totalberat = 0;

			foreach ($_SESSION['keranjang'] as $idproduk => $perproduk) 
			{
				$ambil = $this->koneksi->query("SELECT * FROM produk WHERE id_produk='$idproduk'");
				
				$pecah = $ambil->fetch_assoc();
				$pecah["jumlah"] = $perproduk['jumlah'];
				$pecah['sub_total']= $pecah['harga'] * $pecah['jumlah'];
				$pecah['sub_berat']= $pecah['jumlah'] * $pecah['berat'];
				$pecah['total_belanja'] = $totalbelanja+=$pecah['sub_total'];
				$pecah['total_berat'] = $totalberat+=$pecah['sub_berat'];
				$semuadata[] = $pecah;
			}
			
			return $semuadata;
		}
		else
		{
			return array();
		}
	}
	function hapus_keranjang($id)
	{
		unset($_SESSION['keranjang'][$id]);
	}
	function buang_keranjang($jumlah, $id)
	{
		$_SESSION['keranjang'][$id]['id_produk']=$id;
		$_SESSION['keranjang'][$id]['jumlah']-=$jumlah;
	}

}
$keranjang = new keranjang($database);


class tarif
{
	public $koneksi;

	function __construct($database)
	{
		$this->koneksi = $database;
	}
	function tampil_provinsi()
	{
		$ambil = $this->koneksi->query("SELECT * FROM provinsi");
		while ($pecah = $ambil->fetch_assoc())
		{
			$semuadata[]= $pecah;
		}
		return $semuadata;
	}

	function tampil_kota_prov($idprov)
	{
		$semuadata=array();
		$ambil = $this->koneksi->query("SELECT * FROM kota WHERE id_provinsi='$idprov'");
		while ($pecah= $ambil->fetch_assoc()) 
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function tampil_kota_member($idprov)
	{
		$semuadata=array();
		$ambil = $this->koneksi->query("SELECT * FROM tarif_bus WHERE id_provinsi='$idprov'");
		while ($pecah= $ambil->fetch_assoc()) 
		{
			$semuadata[] = $pecah;
		}
		return $semuadata;
	}
	function simpan_tarif($idkota, $biaya)
	{
		$this->koneksi->query("INSERT INTO tarif_bus (id_kota, biaya) VALUES ('$idkota','$biaya')");
	}
	function tampil_tarif()
	{
		$ambil = $this->koneksi->query("SELECT * FROM tarif_bus JOIN kota ON tarif_bus.id_kota=kota.id_kota JOIN provinsi ON provinsi.id_provinsi=kota.id_provinsi");
		while ($pecah=$ambil->fetch_assoc()) 
		{
			$semuadata[]=$pecah;
		}
		return $semuadata;
	}

	function ambil_tarif($idkota)
	{
		$ambil = $this->koneksi->query("SELECT * FROM tarif_bus JOIN kota ON tarif_bus.id_kota=kota.id_kota WHERE tarif_bus.id_kota='$idkota'");
		return $ambil->fetch_assoc();
	}
	function ambil_tarif_admin($id)
	{
		$ambil=$this->koneksi->query("SELECT * FROM tarif_bus WHERE id_tarif_bus='$id'");
		return $ambil->fetch_assoc();
	}
	function ubah_tarif($biaya, $id)
	{
		$this->koneksi->query("UPDATE tarif_bus SET biaya='$biaya' WHERE id_tarif_bus='$id'");
	}
}
$tarif = new tarif($database);
?>