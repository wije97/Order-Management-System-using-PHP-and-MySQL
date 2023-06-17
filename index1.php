<?php
	include_Once('./config.php');
	$productType = '';
	$productCategory = '';
	
	session_start();

	if(empty($_SESSION)){
		$usertype = "user";
	}else {
		
		$usertype = $_SESSION["usertype"];

		if ($usertype != "user") {
			$logtype = $_SESSION["type"];
	  		$nics = $_SESSION["nic"];
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="#">AgroFarm</a></h1>
				
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
	

		<div id="fh5co-tours" class="fh5co-section-gray">
			<div class="container">
				<div class="container">
				<div class="row">
					<div style="margin-top: -70px;" class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Welcome to AgroFarm</h3>
					</div>
					<table style="margin-top: -40px;">
					<tr> 
					  <th >
					  	<form action="" method="POST">
						   <select style="width: 300px" class="form-control" id="p_type" name="p_type" required>
								<option value=" ">Select Product Type</option>
								<option value="Fertilizer">Fertilizer</option>
								<option value="Equipment">Equipment</option>
							</select>			  
					  </th>
					  <th>&nbsp</th><th>&nbsp</th><th>&nbsp</th>
					  <th>
					  	<form action="" method="POST">
						   <select style="width: 300px" class="form-control" id="p_cat" name="p_cat">
								<option value=" ">Select Category</option>
							</select>	  
					  </th>
					  <th>&nbsp</th><th>&nbsp</th><th>&nbsp</th>
					  <th><button type="Submit" class="btn btn-info"  name="search">Search</button></th>
					  <th>&nbsp</th><th>&nbsp</th><th>&nbsp</th>
					  <th><button type="Submit" class="btn btn-success"  name="all">All Products</button></th>
					</tr></form>
				</table>
				<br><br>
				</div>
				<div class="row">
					
					<?php

						

						if(isset($_POST['search'])){
							if(!empty($_POST['p_type']) && !empty($_POST['p_cat']) ){
								$productType = $_POST['p_type'];
	        					$productCategory = $_POST['p_cat'];

								echo searchRequest("WHERE P_type= '" . $productType . "' AND P_category= '" . $productCategory. "'");
							}else if (!empty($_POST['p_type'])) {
								$productType = $_POST['p_type'];
								echo searchRequest("WHERE P_type= '" . $productType . "'");
							}
						}else if(isset($_POST['all'])){
							echo searchRequest("");
						}else{
							echo searchRequest("");
						}

						function searchRequest($condition){
							include('./config.php');
							$sql = "SELECT * FROM tbl_product $condition";
							if ($result = mysqli_query($con,$sql)) {
								if(mysqli_num_rows($result)>0){
									while ($row = $result->fetch_assoc()) {

										$imageURL =  "uploads/".$row["P_image"];
										$pAStatus = $row["P_itemstatus"];

										if($pAStatus == "Out of Stock"){
											$value = 0;

										}else{
											$value = 1;
										}

										echo '<form action="" method="POST"><div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
											<div  href="#"><img style=" width:400px; height:300px; border: solid 5px #CCC" src="' .$imageURL .'" class="img-responsive">
												<div class="desc">
													<span></span>
													<h3>' . $row["P_name"] . '</h3>
													<table>
														<tr>
															<th><h3>Rs: ' . $row["P_unitprice"] . '</h3></th>
															<th><input style="width: 40px; margin-left: 70px;" type="number" value="' . $value . '" name="i_quantity" min="' . $value . '" max="' . $row["P_quantity"] . '" /></th>
														</tr>
														<tr>
															<th>
																<div class="col-md-2">
																	<div class="form-group">
																		<input type="submit" style="margin-top: 10px; margin-left: -12px;" class="btn btn-danger" value="Add to Cart " name="p_add_cart" '.($value==0 ? 'disabled ' : '').' />
																	</div>
																</div>
															</th>
															<th>
																<div class="col-md-2">
																	<div class="form-group">
																		<input type="submit" style="margin-top: 10px; margin-left: -10px;" class="btn btn-success" value="Details " name="p_details"/>
																		<input type="hidden" name="hpid" value="'. $row["Product_ID"] .'"/>
																	</div>
																</div>
															</th>
														</tr>
													</table>
													
												</div>
											</div>
										</div></form>';
									}
								}else {
									echo "<br><h3 align='center'>No Products</h3>";
									echo "</br></br></br></br></br></br>";
								}
							}	
						}
						
					?>
					
				</div>
			</div>

			</div>
		</div>

		<?php
			if(isset($_POST['p_details'])){

				if(empty($_SESSION)){
					$_SESSION["usertype"] = "user";
					$_SESSION["pid"] = $_POST['hpid'];
					//header("Location:ViewProduct.php");
					echo '<script type="text/javascript">
					window.location.href = "ViewProduct.php";</script>';
				}else{
					$_SESSION["usertype"] = $usertype;
					$_SESSION["pid"] = $_POST['hpid'];
					//header("Location:ViewProduct.php");
					echo '<script type="text/javascript">
					window.location.href = "ViewProduct.php";</script>';
				}

				
			}

			if(isset($_POST['p_add_cart'])){

				if ($usertype == "user") {
					echo '<script type="text/javascript">
					window.location.href = "registrationCustomer.php";</script>';
				}else if ($usertype == "customer"){
					$key = $_POST['hpid'];

					$pQuantity = $_POST['i_quantity'];
					
					$date= date("Y-m-d");

					$insert1="INSERT INTO `tbl_cart` (`C_ProductID`, `C_quantity`, `C_CusNIC`, `C_date`) VALUES ('$key','$pQuantity','$nics','$date')";

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

		<script type="text/javascript">
			$(document).ready(function () {
		    $("#p_type").change(function () {
		        var val = $(this).val();
		        if (val == "Fertilizer") {
		            $("#p_cat").html("<option value=''>Select Fertilizer Category</option> " + 
		            	"<option value='F1'>Paddy</option> " + 
		            	"<option value='F2'>Tea</option> " + 
		            	"<option value='F3'>Rubber</option> " + 
		            	"<option value='F4'>Vegitables</option> " + 
		            	"<option value='F5'>Fruits</option> " + 
		            	"<option value='F6'>Flowers</option> ");
		        } else if (val == "Equipment"){
		            $("#p_cat").html("<option value=''>Select Equipment Category</option> " +
		            	"<option value='E1'>Manual Weeders</option> " +
		            	"<option value='E2'>Grass Shears</option>" +
		            	"<option value='E3'>Rakes and Shovels</option>" +
		            	"<option value='E4'>Gardening Scissors</option>" +
		            	"<option value='E5'>Cultivators & Tillers</option>" );
		        }else if (val == " ") {
		            $("#p_cat").html("<option value=''>Select Category</option>");
		        }
		    });
		});

		</script>

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

