<?php
	include_Once('./config.php');
	$errpw = "";

	session_start();

	if(empty($_SESSION)){
		$usertype = "user";
	}else{
		$logtype = $_SESSION["type"];
	  	$nics = $_SESSION["nic"];
	  	$usertype = $_SESSION["usertype"];
	}

	$tbl = null;

	if ($logtype == "assistant") {
    	$sql = "SELECT S_password fROM tbl_staff_login WHERE SL_StaffID = '$nics'";
    	$tbl = "tbl_staff_login";
    }
    elseif ($logtype == "customer") {
    	$sql = "SELECT C_password FROM tbl_customer_login WHERE CL_CusNIC = '$nics'";
    	$tbl = "tbl_customer_login";
    }

    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);

	if ($logtype == "assistant") {
		$old_pw = $row['S_password'];
	}else{
		$old_pw = $row['C_password'];
	}
	

	if(isset($_POST['submit'])){

		$old_pw_frm_user = $_POST['o_password'];
		$password = $_POST['n_password'];
		$Cpassword = $_POST['cn_password'];

		if($old_pw != $old_pw_frm_user){

			echo '<script>alert("Old Password Not Matched!")</script>';
		}
		else{
			
			if($password != $Cpassword){

				echo '<script>alert("Passwords Not Matched!")</script>';
			}
			else{
				
				if ($logtype == "assistant"){
					$qupdate = mysqli_query($con,"UPDATE $tbl SET S_password = '$password' WHERE SL_StaffID = '$nics'");

				}else{
					$qupdate = mysqli_query($con,"UPDATE $tbl SET C_password = '$password' WHERE CL_CusNIC = '$nics'");
				}
				if($qupdate ==1){
					echo '<script>alert("Password Change Successful!")</script>';
				}else{
					echo '<script>alert("Password Change Failed!")</script>';

				}

			}
			

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
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Change Password</a>
								      </li>
								      
								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Old Password:</label>
													<input type="password" class="form-control" minlength="8" name="o_password" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="date-end">New Password:</label>
													<input type="password" class="form-control" minlength="8" name="n_password" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="date-end">Confirm New Password:</label>
													<input type="password" class="form-control" minlength="8" name="cn_password" required/>
												</div>
											</div>
											
											<div class="col-xxs-12 col-xs-12 mt alternate">
												<input type="submit" class="btn btn-primary btn-block" name ="submit" value="Change">
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
		
		<script>
			$("#email").keyup(function(){
			     var email = $("#email").val();
			     var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			     if (!filter.test(email)) {
			       //alert('Please provide a valid email address');
			       $("#error_email").text(email+" is not a valid email");
			       email.focus;
			       //return false;
			    } else {
			        $("#error_email").text("");
			    }
			});
		</script>
		
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

