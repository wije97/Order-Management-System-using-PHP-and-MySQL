<?php
	include_Once('./config.php');
	$errpw = "";

	session_start();
	$logtype = $_SESSION["type"];
  	$nics = $_SESSION["nic"];
  	$usertype = $_SESSION["usertype"];

	if ($logtype == "assistant") {
		$sql = "SELECT * FROM tbl_staff_member WHERE S_NIC = '$nics'";
		$result = mysqli_query($con,$sql);
		while($row=mysqli_fetch_assoc($result)){
			$fname = $row["S_First_Name"];
			$lname = $row["S_Last_Name"];
			$email = $row["S_email"];
			$age = $row["S_age"];
			$nic = $row["S_NIC"];
			$telephone = $row["S_phone"];
			$whCode = $row["S_WarehouseCode"];
			$address = $row["S_address"];
		}
	}

	if(isset($_POST['submit'])){

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$telephone = $_POST['telephone'];
		$age = $_POST['age'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$wCode = $_POST['w_code'];
		$staffID = $_POST['st_id'];


			$insert1 = "UPDATE `tbl_staff_member` SET S_First_Name='$fname', S_Last_Name='$lname', S_gender='$gender', S_age='$age', S_phone ='$telephone', S_WarehouseCode = '$wCode', S_address = '$address' ,S_email='$email' WHERE S_NIC='$nics'";

			$query = mysqli_query($con, $insert1) or die(mysqli_error($con));
			if($query == 1){	

				if($usertype == "assistant"){
					echo '<script type="text/javascript">
					alert("Update Successful !");
					window.location.href = "updateinfoAssistant.php";</script>';
				}else {
					echo '<script type="text/javascript">
					alert("Update Successful !");
					window.location.href = "admin/Admin_UI.php";</script>';
				}	
			}
			else{
				echo '<script>alert("Update Unsuccessful !")</script>';
			}

	        mysqli_close($con);
	}

	if(isset($_POST['back'])){
		if($usertype == "assistant"){
					echo '<script type="text/javascript">window.location.href = "assistant/Authorizer_UI.php";</script>';
				}else {
					echo '<script type="text/javascript">window.location.href = "admin/AdminManageUser.php";</script>';
				}	
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
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	
	<!-- CS Select -->
	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">
	
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
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
							
							<?php if($usertype == "admin") {?> 
								
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
							
							<?php }else {?> 
								
								<li><a href="assistant/Assistant_UI.php">Dashboard</a></li>
								<li><a href="ChangePassword.php">Change Password</a></li>
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

							<?php }  ?>
							
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

									<form action="" method="POST">
								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab"><?php if($usertype == "admin") {?> View Assistant Details <?php }else {?> Update Your Details <?php }  ?></a>
								      </li>
								      
								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											
											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">First Name:</label>
													<input type="text" class="form-control" name="fname" value="<?php echo $fname;  ?>"  required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Last Name:</label>
													<input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Gender:</label>
													<div>
													<input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
													<label class="form-check-label" >
														Male &nbsp;&nbsp;&nbsp;
													</label>
													
													<input class="form-check-input" type="radio" name="gender" id="female" value="female">
													<label class="form-check-label">
														Female
													</label>
													</div>
												</div>
											</div>	
											
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">NIC:</label>
													<input type="text" class="form-control" name="nic" maxlength="10" value="<?php echo $nic; ?>" disabled/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Age:</label>
													<input type="text" class="form-control" name="age" value="<?php echo $age; ?>" required/>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Mobile Number:</label>
													<input type="text" class="form-control" name="telephone" value="<?php echo $telephone; ?>" minlength="10" oninvalid="setCustomValidity('Please enter correct Mobile Number.')" oninput="setCustomValidity('')" maxlength="10" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Address:</label>
													<input type="text" class="form-control" name="address" value="<?php echo $address; ?>" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt alternate">
												<div class="input-field">
													<label for="date-end">Email:</label>
													<input type="text" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$" oninvalid="setCustomValidity('Please enter correct email address.')" oninput="setCustomValidity('')" class="form-control" name="email" value="<?php echo $email; ?>" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt alternate">
												<div class="input-field">
													<label for="date-end">Warehouse Code:</label>
													<!--<input type="text" class="form-control" name="w_code" value="<?php echo $whCode; ?>" minlength="10" oninvalid="setCustomValidity('Please enter correct Phone Number.')" oninput="setCustomValidity('')" maxlength="10" required/>-->
													<select class="form-control" id="w_code" name="w_code" required="">
														<option value="">Select Warehouse</option>
														<option value="Head Office" <?php if ($whCode == "Head Office") { ?> selected <?php } ?>>Head Office</option>
														
														<?php

													        $records = mysqli_query($con, "SELECT Warehouse_Code FROM tbl_warehouse");
													        if (mysqli_num_rows($records)>0) {
													        	while($data = mysqli_fetch_array($records))
													        	{
													        		?>	

													        		<option value="<?php echo $data['Warehouse_Code']?>" <?php if($data['Warehouse_Code'] == $whCode) { ?> selected <?php } ?>> <?php echo $data['Warehouse_Code']?> </option>

													        		<?php
													        	}

													        }else {
													        	echo "<option value='Not Specified'>Please Add Warehouse</option>";
													        }
													    ?> 
													</select>
												</div>
											</div>					
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<input type="submit" class="btn btn-primary1 btn-block" name ="back" value="BACK">
											</div>

											<?php if($usertype != "admin") {?> 
												<div class="col-xxs-12 col-xs-6 mt alternate">
													<input type="submit" class="btn btn-primary btn-block"  id="submit" name ="submit" value="Update">
												</div> 
											<?php } ?>
											
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
	
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>

