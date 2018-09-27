<?php 
include "../config/class.php";

$tampil = $kategori->tampil_kategori();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sepeda Jaya</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../asset/font-awesome/css/font-awesome.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Sepeda Jaya</a>
			</div>
			<div class="collapse navbar-collapse" id="menu">
				<ul class="nav navbar-nav" style="padding-top: 5px">
					<li><a href="index.php">Home</a></li>
					<li><a href="index.php?halaman=keranjang">Keranjang</a></li>
					<li class="c2 dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">Kategori<span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php foreach ($tampil as $key => $value): ?>
							<li><a href="index.php?halaman=kategori&id=<?php echo $value['id_kategori'] ?>"><?php echo $value['nama_kategori'] ?></a></li>
						<?php endforeach ?>
							
						</ul>
					</li>
					<li class="c2 dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">Menu<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?halaman=cara_pesan">Cara Pemesanan</a></li>
							<li><a href="index.php?halaman=hubungi_kami">Hubungi Kami</a></li>
							<li><a href="index.php?halaman=Kebijakan_retur">Kebijakan Retur</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<div>
							<div class="form-group" style="padding-top: 12px">
								<form action="" class="form-inline" method="post">
									<input type="text" name="keyword" class="form-control" required="" placeholder="cari produk">
									<button class="btn btn-default" name="cari">cari</button>
								</form>
								<?php if (isset($_POST['cari'])): ?>
									<script>
										location='index.php?halaman=cari&keyword=<?php echo $_POST['keyword'] ?>'
									</script>
								<?php endif ?>
							</div>
						</div>
					</li>
					<?php if (isset($_SESSION['member'])): ?>
						<?php $idpel = $_SESSION['member']['id_member']; ?>
						<li style="padding-top: 5px"><a href='index.php?halaman=profil'>Profil</a></li>
						<li style="padding-top: 5px"><a href='index.php?halaman=riwayat&id=<?php echo $idpel ?>'>Riwayat</a></li>
						<li style="padding-top: 5px"><a href='index.php?halaman=logout' onclick="return confirm('Apakah anda yakin ingin logout?')">Logout</a></li>
					<?php else: ?>
						<li style="padding-top: 5px"><a href='index.php?halaman=login'>Login</a></li>
						<li style="padding-top: 5px"><a href='index.php?halaman=daftar'>Daftar</a></li>
					<?php endif ?>
					
				</ul>
			</div>
		</div>
	</nav>

	<?php 
	if(!isset($_GET['halaman']))
	{
		include "home.php";
	}
	elseif($_GET['halaman']=="keranjang")
	{
		include "keranjang.php";
	}
	elseif($_GET['halaman']=="checkout")
	{
		include "checkout.php";
	}
	elseif($_GET['halaman']=="beli")
	{
		include "beli.php";
	}
	elseif($_GET['halaman']=="detail")
	{
		include "detail.php";
	}
	elseif($_GET['halaman']=="daftar")
	{
		include "daftar.php";
	}
	elseif($_GET['halaman']=="login")
	{
		include "login.php";
	}
	elseif($_GET['halaman']=="hapuskeranjang")
	{
		include "hapuskeranjang.php";
	}
	elseif($_GET['halaman']=="daftar")
	{
		include "daftar.php";
	}
	elseif($_GET['halaman']=="profil")
	{
		include "profil.php";
	}
	elseif($_GET['halaman']=="ubahinformasi")
	{
		include "ubahinformasi.php";
	}
	elseif($_GET['halaman']=="ubahpassword")
	{
		include "ubahpassword.php";
	}
	elseif($_GET['halaman']=="notabelanja")
	{
		include "notabelanja.php";
	}
	elseif($_GET['halaman']=="riwayat")
	{
		include "riwayatbelanja.php";
	}
	elseif($_GET['halaman']=="konfirmasi")
	{
		include "konfirmasi.php";
	}
	elseif($_GET['halaman']=="cari")
	{
		include "cari.php";
	}
	elseif($_GET['halaman']=="batal_belanja")
	{
		include "batal_belanja.php";
	}
	elseif($_GET['halaman']=="logout")
	{
		include "logout.php";
	}
	elseif($_GET['halaman']=="lupa_password")
	{
		include "lupa_password.php";
	}
	elseif($_GET['halaman']=="reset_password")
	{
		include "reset_password.php";
	}
	elseif($_GET['halaman']=="lihat_belanja")
	{
		include "lihat_belanja.php";
	}
	elseif($_GET['halaman']=="beri_review")
	{
		include "beri_review.php";
	}
	elseif($_GET['halaman']=="rating")
	{
		include "rating.php";
	}
	elseif($_GET['halaman']=="cara_pesan")
	{
		include "cara_pesan.php";
	}
	elseif($_GET['halaman']=="hubungi_kami")
	{
		include "hubungi_kami.php";
	}
	elseif($_GET['halaman']=="kategori")
	{
		include "kategori.php";
	}
	elseif($_GET['halaman']=="checkout_esl")
	{
		include "checkout_esl.php";
	}
	elseif($_GET['halaman']=="checkout_jne")
	{
		include "checkout_jne.php";
	}
	elseif ($_GET["halaman"]=="kembalikan")
	{
		include 'kembalikan.php';
	}
	elseif ($_GET["halaman"]=="Kebijakan_retur")
	{
		include 'Kebijakan_retur.php';
	}
	elseif ($_GET["halaman"]=="detail_retur")
	{
		include 'detail_retur.php';
	}

	?>
	<hr>
	<footer>
		<div class="container">
			<p class="text-center">Copyright &copy; <strong>SepedaJaya</strong>. All Right Reserved</p>
		</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../asset/js/bootstrap.min.js"></script>
	<script src="../asset/js/bootstrap.js"></script>
	<script>
		$(document).ready(function(){
			$(".dropdown").hover(            
				function() {
					$('.dropdown-menu', this).stop( true, true ).slideDown("fast");
					$(this).toggleClass('open');        
				},
				function() {
					$('.dropdown-menu', this).stop( true, true ).slideUp("fast");
					$(this).toggleClass('open');       
				}
				);
		});
	</script>
	<!-- <script>
		
		(function($) {
			$.fn.shorten = function(settings) {
				"use strict";

				var config = {
					showChars: 100,
					minHideChars: 10,
					ellipsesText: "........",
					moreText: "<h4><span class='label label-info' >Selengkapnya</span></h4>",
					lessText: "<h4><span class='label label-warning'>Sembunyikan</span></h4>",
					onLess: function() {},
					onMore: function() {},
					errMsg: null,
					force: false
				};

				if (settings) {
					$.extend(config, settings);
				}

				if ($(this).data('jquery.shorten') && !config.force) {
					return false;
				}
				$(this).data('jquery.shorten', true);

				$(document).off("click", '.morelink');

				$(document).on({
					click: function() {

						var $this = $(this);
						if ($this.hasClass('less')) {
							$this.removeClass('less');
							$this.html(config.moreText);
							$this.parent().prev().animate({'height':'0'+'%'}, function () { $this.parent().prev().prev().show(); }).hide('fast', function() {
								config.onLess();
							});

						} else {
							$this.addClass('less');
							$this.html(config.lessText);
							$this.parent().prev().animate({'height':'100'+'%'}, function () { $this.parent().prev().prev().hide(); }).show('fast', function() {
								config.onMore();
							});
						}
						return false;
					}
				}, '.morelink');

				return this.each(function() {
					var $this = $(this);

					var content = $this.html();
					var contentlen = $this.text().length;
					if (contentlen > config.showChars + config.minHideChars) {
						var c = content.substr(0, config.showChars);
                if (c.indexOf('<') >= 0) // If there's HTML don't want to cut it
                {
                    var inTag = false; // I'm in a tag?
                    var bag = ''; // Put the characters to be shown here
                    var countChars = 0; // Current bag size
                    var openTags = []; // Stack for opened tags, so I can close them later
                    var tagName = null;

                    for (var i = 0, r = 0; r <= config.showChars; i++) {
                    	if (content[i] == '<' && !inTag) {
                    		inTag = true;

                            // This could be "tag" or "/tag"
                            tagName = content.substring(i + 1, content.indexOf('>', i));

                            // If its a closing tag
                            if (tagName[0] == '/') {


                            	if (tagName != '/' + openTags[0]) {
                            		config.errMsg = 'ERROR en HTML: the top of the stack should be the tag that closes';
                            	} else {
                                    openTags.shift(); // Pops the last tag from the open tag stack (the tag is closed in the retult HTML!)
                                }

                            } else {
                                // There are some nasty tags that don't have a close tag like <br/>
                                if (tagName.toLowerCase() != 'br') {
                                    openTags.unshift(tagName); // Add to start the name of the tag that opens
                                }
                            }
                        }
                        if (inTag && content[i] == '>') {
                        	inTag = false;
                        }

                        if (inTag) { bag += content.charAt(i); } // Add tag name chars to the result
                        else {
                        	r++;
                        	if (countChars <= config.showChars) {
                                bag += content.charAt(i); // Fix to ie 7 not allowing you to reference string characters using the []
                                countChars++;
                            } else // Now I have the characters needed
                            {
                                if (openTags.length > 0) // I have unclosed tags
                                {
                                    //console.log('They were open tags');
                                    //console.log(openTags);
                                    for (j = 0; j < openTags.length; j++) {
                                        //console.log('Cierro tag ' + openTags[j]);
                                        bag += '</' + openTags[j] + '>'; // Close all tags that were opened

                                        // You could shift the tag from the stack to check if you end with an empty stack, that means you have closed all open tags
                                    }
                                    break;
                                }
                            }
                        }
                    }
                    c = $('<div/>').html(bag + '<span class="ellip">' + config.ellipsesText + '</span>').html();
                }else{
                	c+=config.ellipsesText;
                }

                var html = '<div class="shortcontent">' + c +
                '</div><div class="allcontent">' + content +
                '</div><span><a href="javascript://nop/" class="morelink">' + config.moreText + '</a></span>';

                $this.html(html);
                $this.find(".allcontent").hide(); // Hide all text
                $('.shortcontent p:last', $this).css('margin-bottom', 0); //Remove bottom margin on last paragraph as it's likely shortened
            }
        });

};

})(jQuery);

$(document).ready(function() {

	$(".comment").shorten();
	
	$(".comment-small").shorten({showChars: 10});

});

</script> -->
</body>
</html>