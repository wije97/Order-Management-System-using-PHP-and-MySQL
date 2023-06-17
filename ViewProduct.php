<?php
	include_Once('./config.php');

	session_start();

	$usertype = $_SESSION["usertype"];

	if($usertype != "user"){

		$logtype = $_SESSION["type"];
	  	$nics = $_SESSION["nic"];
	  	
	}

	$pid = $_SESSION["pid"];

	$sql = "SELECT * FROM tbl_product WHERE Product_ID= '$pid'";
	$result = mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$pName = $row["P_name"];
		$proID = $row["Product_ID"];
		$pTitle = $row["P_title"];
		$pDetail = $row["P_details"];
		$quantity = $row["P_quantity"];
		$uPrice = $row["P_unitprice"];
		$imageURL = 'uploads/'.$row["P_image"];
		$pStatus = $row["P_itemstatus"];
		$pWouse = $row["P_warehouse"];


		if($pStatus == "Out of Stock"){
			$status = "Out of Stock";
			$value = 0;
		}else{
			$status = $quantity . " " .$pStatus;
			$value = 1;
		}
	}
?>

<!DOCTYPE html>

	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome to AgroFarm</title>

	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/icomoon.css">

	<link rel="stylesheet" href="css/bootstrap.css">
	
	<link rel="stylesheet" href="css/superfish.css">
	
	<link rel="stylesheet" href="css/magnific-popup.css">
	
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">
	
	<link rel="stylesheet" href="css/style.css">

	<script src="js/modernizr-2.6.2.min.js"></script>
	
	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="index.php">AgroFarm</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<?php if($usertype == "customer") {?> 
								
								<li class="active"><a href="customer/Customer_UI.php">Dashboard</a></li>
								<li><a href="customer/Cart.php">Cart</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
								<li>
									<a href="#" class="fh5co-sub-ddown">Profile</a>
									<ul class="fh5co-sub-menu">
										<li><a href="updateinfoCustomer.php">Update</a></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
							
							<?php }else if($usertype == "assistant") {?> 
								
								<li><a href="assistant/Assistant_UI.php">Dashboard</a></li>
								<li>
									<a href="#" class="fh5co-sub-ddown">Add</a>
									<ul class="fh5co-sub-menu">
										<li><a href="addProduct.php">Product</a></li>
									</ul>
								</li>
								<li>
									<a href="#" class="fh5co-sub-ddown">View</a>
									<ul class="fh5co-sub-menu">
										<li><a href="ManageOrders.php">Order</a></li>
									</ul>
								</li>

								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
								<li>
									<a href="#" class="fh5co-sub-ddown">Profile</a>
									<ul class="fh5co-sub-menu">
										<li><a href="updateinfoAssistant.php">Update</a></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>

							<?php }else if($usertype == "admin"){ ?>

								<li class="active"><a href="admin/Admin_UI.php">Dashboard</a></li>
								<li>
									<a href="#" class="fh5co-sub-ddown">Add</a>
									<ul class="fh5co-sub-menu">
										<li><a href="registrationAssistant.php">Assistant</a></li>
										<li><a href="addProduct.php">Product</a></li>
										<li><a href="admin/addWarehouse.php">Warehouse</a></li>
									</ul>
								</li>

								<li>
									<a href="#" class="fh5co-sub-ddown">Verify</a>
									<ul class="fh5co-sub-menu">
										<li><a href="admin/AdminAssistantApprove.php">Assistant</a></li>
									</ul>
								</li>
							
								<li>
									<a href="#" class="fh5co-sub-ddown">View</a>
									<ul class="fh5co-sub-menu">
										<li><a href="ManageProducts.php">Products</a></li>
										<li><a href="ManageOrders.php">Order</a></li>
										<li><a href="admin/ManageWarehouses.php">Warehouse</a></li>
									</ul>
								</li>
								
								<li><a href="feedback.php">Feedback</a></li>
								<li><a href="logout.php" >Logout</a></li>

							<?php }else {  ?>

								<li class="active"><a href="index.php">Home</a></li>
								<li>
									<a href="#" class="fh5co-sub-ddown">Register</a>
									<ul class="fh5co-sub-menu">
										<li><a href="registrationCustomer.php">Customer</a></li>
										<li><a href="registrationAssistant.php">Assistant</a></li>
									</ul>
								</li>
								<li><a href="login.php">Login</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="About.php">About</a></li> 
							
							<?php } ?>
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->
	

		<div id="fh5co-contact" class="fh5co-section-gray">
			<h2 align="center" style="margin-top: -70px;" ><b>Product Details</b></h2>
			<div class="container">
				<div class="row animate-box" >
					<br>
					<div class="col-md-6">
						<div class="row">
							<div style="background-color:#ebedeb; width: 1000px; height: 1000px; padding: 20px;  float:left;">
								<div class="col-md-6">
									<div class="form-group">
										<img style=" width:400px; height:300px; border: solid 5px #CCC" src="<?php echo $imageURL;  ?>" class="img-responsive" >
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<h1  placeholder="Req title" readonly=""> <a><b><?php echo $pName;  ?></b><a></h1>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<h3 type="text" readonly=""><i><?php echo $pTitle;  ?></i></h3>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<h3 type="text"  readonly=""><b>Rs: <?php echo $uPrice;  ?></b></h3>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<h4 type="text"  readonly=""><?php echo $status;  ?></h4>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<h4 type="text"  readonly="">Quantity:</h4>
									</div>
								</div>
								<form action="" method="POST">
									<div class="col-md-3">
										<div class="form-group">
											<input type="number" name="i_quantity" min="<?php echo $value;  ?>" max="<?php echo $quantity;  ?>" style="width: 50px; margin-left: -120px; margin-top: -5;" required value="<?php echo $value;  ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="col-md-2">
											<div class="form-group">
												<input type="submit" style="margin-top: 10px; margin-left: -12px;" class="btn btn-danger" value="Add to Cart " name="p_add_cart" <?php if ($value == 0) { ?> disabled <?php } ?>/>
											</div>
										</div>
									</div>
								</form>
								<div class="col-md-12">
									<div class="form-group">
										<h3 for="date-start"><b>Description</b></h3>
										<textarea name="" style="height: 500px; background-color: #ffffff" class="form-control" id="" cols="20" rows="5" maxlength = "100" wrap="hard" placeholder="Req details" readonly=""><?php echo $pDetail;  ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<br>
					</div>
				</div>
			</div>
		</div>
		
		<?php
				
			if(isset($_POST['p_add_cart'])){

				if ($usertype == "user") {
					echo '<script type="text/javascript">
					window.location.href = "registrationCustomer.php";</script>';
				}else if ($usertype == "customer"){

					$pQuantity = $_POST['i_quantity'];
					$date= date("Y-m-d");

					$insert1="INSERT INTO `tbl_cart` (`C_ProductID`, `C_quantity`, `C_CusNIC`, `C_date`) VALUES ('$pid','$pQuantity','$nics','$date')";

					$query = mysqli_query($con, $insert1) or die(mysqli_error($con));
					if($query == 1){	
						echo '<script>alert("Add to Cart Successful!")</script>';
					}
					else{
						echo '<script>alert("Add to Cart Unsuccessful !")</script>';
					}

			        mysqli_close($con);
				}else{
					
				}
				
			}

		?>
		<footer>
			<div id="footer2">
				<div class="container">
					<div class="row row-bottom-padded-md">
						
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="#"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

	<!-- jQuery -->


	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>

	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>

