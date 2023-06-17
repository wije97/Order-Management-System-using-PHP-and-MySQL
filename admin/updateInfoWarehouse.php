<?php
	include_Once('../config.php');
	$errpw = "";

	session_start();
	$wCode = $_SESSION["wcode"];

	$sql = "SELECT * FROM tbl_warehouse WHERE Warehouse_Code= '$wCode'";
	$result = mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$wCode = $row["Warehouse_Code"];
		$wName = $row["W_name"];
		$wAddress = $row["W_address"];
		$wDist = $row["W_district"];
		$wPhone = $row["W_phone"];
	}

	if(isset($_POST['submit'])){

		$wName = $_POST["w_name"];
		$wAddress = $_POST["w_address"];
		$wDist = $_POST["w_district"];
		$wPhone = $_POST["w_phone"];


			$insert1 = "UPDATE `tbl_warehouse` SET W_name='$wName', W_address='$wAddress', W_district='$wDist', W_phone='$wPhone' WHERE Warehouse_Code='$wCode'";

			$query = mysqli_query($con, $insert1) or die(mysqli_error($con));
			if($query == 1){		
				echo '<script type="text/javascript">
				alert("Update Successful !");
				window.location.href = "updateinfoWarehouse.php";</script>';
				
			}
			else{
				echo '<script>alert("Update Unsuccessful !")</script>';
			}

	        mysqli_close($con);

	}
	
	if(isset($_POST['back'])){
		
		echo '<script type="text/javascript">window.location.href = "ManageWarehouses.php";</script>';
		
	}	

?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AgroFarm</title>
	
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	
	<link rel="shortcut icon" href="favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" href="../css/icomoon.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/superfish.css">
	<link rel="stylesheet" href="../css/magnific-popup.css">
	<link rel="stylesheet" href="../css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="../css/cs-select.css">
	<link rel="stylesheet" href="../css/cs-skin-border.css">	
	<link rel="stylesheet" href="../css/style.css">

	<script src="../js/modernizr-2.6.2.min.js"></script>	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	</head>
	
	
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">

		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="../index.php">AgroFarm</a></h1>
				
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="Admin_UI.php">Dashboard</a></li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Add</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../registrationAssistant.php">Assistant</a></li>
									<li><a href="../addProduct.php">Product</a></li>
									<li><a href="addWarehouse.php">Warehouse</a></li>
								</ul>
							</li>

							<li>
								<a href="#" class="fh5co-sub-ddown">Verify</a>
								<ul class="fh5co-sub-menu">
									<li><a href="AdminAssistantApprove.php">Assistant</a></li>
								</ul>
							</li>
						
							<li>
								<a href="#" class="fh5co-sub-ddown">View</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../ManageProducts.php">Products</a></li>
									<li><a href="../ManageOrders.php">Order</a></li>
									<li><a href="ManageWarehouses.php">Warehouse</a></li>
								</ul>
							</li>
							
							<li><a href="../feedback.php">Feedback</a></li>
							<li><a href="../logout.php" >Logout</a></li>
							
						</ul>
					</nav>
				</div>
			</div>
		</header>

		
	
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-7">
								<div class="tabulation animate-box">

									<form action="" method="POST" enctype="multipart/form-data">
								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Update Warehouse</a>
								      </li>
								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Warehouse Code:</label>
													<input type="text" class="form-control" name="w_code" value="<?php echo $wCode; ?>" disabled/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Name:</label>
													<input type="text" class="form-control" name="w_name" value="<?php echo $wName; ?>" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt alternate">
												<div class="input-field">
													<label for="date-start">Address:</label>
													<input type="text" class="form-control" name="w_address" value="<?php echo $wAddress; ?>" required/>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">District:</label>
													<select class="form-control" id="district" name="w_district" required="">
														<option value="">Select District</option>
														<option value="Ampara" <?php if($wDist == "Ampara") { ?>selected <?php ; } ?>>Ampara</option>
														<option value="Anuradhapura" <?php if($wDist == "Anuradhapura") { ?>selected <?php ; } ?>>Anuradhapura</option>
														<option value="Badulla" <?php if($wDist == "Badulla") { ?>selected <?php ; } ?>>Badulla</option>
														<option value="Batticaloa" <?php if($wDist == "Batticaloa") { ?>selected <?php ; } ?>>Batticaloa</option>
														<option value="Colombo" <?php if($wDist == "Colombo") { ?>selected <?php ; } ?>>Colombo</option>
														<option value="Galle" <?php if($wDist == "Galle") { ?>selected <?php ; } ?>>Galle</option>
														<option value="Gampaha" <?php if($wDist == "Gampaha") { ?>selected <?php ; } ?>>Gampaha</option>
														<option value="Hambantota" <?php if($wDist == "Hambantota") { ?>selected <?php ; } ?>>Hambantota</option>
														<option value="Jaffna" <?php if($wDist == "Jaffna") { ?>selected <?php ; } ?>>Jaffna</option>
														<option value="Kalutara" <?php if($wDist == "Kalutara") { ?>selected <?php ; } ?>>Kalutara</option>
														<option value="Kandy" <?php if($wDist == "Kandy") { ?>selected <?php ; } ?>>Kandy</option>
														<option value="Kegalle" <?php if($wDist == "Kegalle") { ?>selected <?php ; } ?>>Kegalle</option>
														<option value="Kilinochchi" <?php if($wDist == "Kilinochchi") { ?>selected <?php ; } ?>>Kilinochchi</option>
														<option value="Kurunegala" <?php if($wDist == "Kurunegala") { ?>selected <?php ; } ?>>Kurunegala</option>
														<option value="Mannar" <?php if($wDist == "Mannar") { ?>selected <?php ; } ?>>Mannar</option>
														<option value="Matale" <?php if($wDist == "Matale") { ?>selected <?php ; } ?>>Matale</option>
														<option value="Matara" <?php if($wDist == "Matara") { ?>selected <?php ; } ?>>Matara</option>
														<option value="Monaragala" <?php if($wDist == "Monaragala") { ?>selected <?php ; } ?>>Monaragala</option>
														<option value="Mullaitivu" <?php if($wDist == "Mullaitivu") { ?>selected <?php ; } ?>>Mullaitivu</option>
														<option value="Nuwara Eliya" <?php if($wDist == "Nuwara Eliya") { ?>selected <?php ; } ?>>Nuwara Eliya</option>
														<option value="Polonnaruwa" <?php if($wDist == "Polonnaruwa") { ?>selected <?php ; } ?>>Polonnaruwa</option>
														<option value="Puttalam" <?php if($wDist == "Puttalam") { ?>selected <?php ; } ?>>Puttalam</option>
														<option value="Ratnapura" <?php if($wDist == "Ratnapura") { ?>selected <?php ; } ?>>Ratnapura</option>
														<option value="Trincomalee" <?php if($wDist == "Trincomalee") { ?>selected <?php ; } ?>>Trincomalee</option>
														<option value="Vavuniya" <?php if($wDist == "Vavuniya") { ?>selected <?php ; } ?>>Vavuniya</option>
													</select>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Contact number:</label>
													<input type="text" class="form-control" name="w_phone" maxlength="10" minlength="10" oninvalid="setCustomValidity('Please enter correct Contact Number.')" oninput="setCustomValidity('')" value="<?php echo $wPhone; ?>" required/>
												</div>
											</div>
											
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<input type="submit" class="btn btn-primary1 btn-block" name ="back" value="BACK">
											</div>
 
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<input type="submit" class="btn btn-primary btn-block"  id="submit" name ="submit" value="Update">
											</div> 
										</div>
									 </div>

									</div>
								</form>

								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>

		</div>

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


	</div>


	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.easing.1.3.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.waypoints.min.js"></script>
	<script src="../js/sticky.js"></script>
	<script src="../js/jquery.stellar.min.js"></script>
	<script src="../js/hoverIntent.js"></script>
	<script src="../js/superfish.js"></script>
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/magnific-popup-options.js"></script>
	<script src="../js/bootstrap-datepicker.min.js"></script>
	<script src="../js/classie.js"></script>
	<script src="../js/selectFx.js"></script>
	<script src="../js/main.js"></script>

	</body>
</html>

