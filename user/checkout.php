<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//jika belum login
if(!isset($_SESSION["pelanggan"])){
	echo "<script>alert('Please login first');</script>";
	echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Nike Shoes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

		<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light ftco-navbar-light-2" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Nike Shoes</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="shop.php">Shop</a>
                <a class="dropdown-item" href="cart.php">Cart</a>
                <a class="dropdown-item" href="checkout.php">Checkout</a>
              </div>
            </li>
	          <li class="nav-item"><a href="#" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="#" class="nav-link">Blog</a></li>
						<li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
						<!--jika sudah login(ada session pelanggan)-->
						<?php if (isset($_SESSION["pelanggan"])): ?>
                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
              <!--jika belum login-->
              <?php else: ?>
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
              <?php endif ?>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
		
		<div class="hero-wrap hero-bread" style="background-image: url('images/bg_4.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Checkout</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span></p>
          </div>
        </div>
      </div>
    </div>
		
		<section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
										<th> </th>
						        <th>Product</th>
						        <th>Price</th>
						        <th>Quantity</th>
                    <th>Subtotal</th>
						      </tr>
						    </thead>
						    <tbody>
									<?php $totalbelanja=0; ?>
									<?php foreach ($_SESSION["cart"] as $id_produk => $jumlah): ?>
									<!--menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
									<?php
									$ambil = $koneksi->query("SELECT * FROM produk
									WHERE id_produk='$id_produk'");
									$pecah=$ambil->fetch_assoc();
									$subharga=$pecah["harga_produk"]*$jumlah;

									?>

						      <tr class="text-center">

										<td><img class="img-fluid" src="../admin/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100"></td>

						        <td class="product-name">
						        	<h3><?php echo $pecah["nama_produk"]; ?></h3>
						        	<p>All Size For Adult</p>
						        </td>
						        
						        <td class="price">Rp<?php echo number_format($pecah["harga_produk"]); ?></td>
						        
						        <td class="quantity"><?php echo $jumlah; ?></td>
						        
                    <td class="total">Rp<?php echo number_format($subharga); ?></td>
									</tr><!-- END TR-->
									<?php $totalbelanja+=$subharga; ?>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4"><b>Total</b></th>
										<th><b>Rp<?php echo number_format($totalbelanja) ?><b></th>
									</tr>
								</tfoot>
							</table>
							<form method="post">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="id_ongkir">
											<option value="">Choose Shipping Cost</option>
											<?php
											$ambil=$koneksi->query("SELECT * FROM ongkir");
											while($perongkir=$ambil->fetch_assoc()){ ?>
											<option value="<?php echo $perongkir["id_ongkir"] ?>">
												<?php echo $perongkir['nama_kota'] ?>
												( Rp<?php echo number_format($perongkir['tarif']) ?> )
											</option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label>Shipping Address</label>
									<textarea class="form-control" name="alamat_pengiriman" placeholder="write down the shipping address in detail"></textarea>
								</div>
									<button class="btn btn-primary btn-block" name="checkout" width="100">Checkout</button>
							</form>

							<?php
							if (isset($_POST["checkout"])){
								$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
								$id_ongkir=$_POST["id_ongkir"];
								$tanggal_pembelian=date("Y-m-d");
								$alamat_pengiriman=$_POST['alamat_pengiriman'];

								$ambil=$koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
								$arrayongkir=$ambil->fetch_assoc();
								$nama_kota=$arrayongkir['nama_kota'];
								$tarif=$arrayongkir['tarif'];

								$total_pembelian = $totalbelanja + $tarif;

								//menyimpan data ke tabel pembelian
								$koneksi->query("INSERT INTO pembelian(id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman)
								VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

								//mendapatkan id_pembelian yang barusan terjadi
								$id_pembelian_barusan= $koneksi->insert_id;
								
								foreach ($_SESSION["cart"] as $id_produk => $jumlah){
									$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah)
									VALUES ('$id_pembelian_barusan','$id_produk','$jumlah') ");
								}

								//mengkosongkan keranjang belanja
								unset($_SESSION["cart"]);

								//tampilan dialihkan ke halaman nota, nota dari pembelian yang barusan
								echo "<script>alert('Product Purchased!');</script>";
								echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
							}
						?>
					  </div>
    			</div>
    		</div>
		</section>

		<pre><?php print_r($_SESSION['pelanggan']) ?></pre>
		<pre><?php print_r($_SESSION['cart']) ?></pre>
		

    <footer class="ftco-footer bg-light ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Nike Shoes</h2>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Shop</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Journal</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                <li><a href="#" class="py-2 d-block">Contact</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Indonesia</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">(012)3456789</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">nikeshoes@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
    
  </body>
</html>