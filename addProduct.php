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

if(isset($_POST['submit'])){

	$pName = $_POST['p_name'];
	$pID = $_POST['p_id'];
	$pBrand = $_POST['p_brand'];
	$pTitle = $_POST['p_title'];
	$pType = $_POST['p_type'];
	$pCat = $_POST['p_cat'];
	$pDetails = $_POST['p_details'];
	$quantity = $_POST['p_quantity'];
	$uPrice = $_POST['u_price'];
	$pStatus = $_POST['p_status'];
	$wCode = $_POST['w_code'];

	$targetDir = "uploads/";
	$fileName = basename($_FILES["p_image"]["name"]);
	$targetFilePath = $targetDir . $fileName;
	$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

	$allowTypes = array('jpg','png','jpeg','gif');

	if(in_array($fileType, $allowTypes)){

        if(move_uploaded_file($_FILES["p_image"]["tmp_name"], $targetFilePath)){
        	
        	$insert1="INSERT INTO `tbl_product` (`Product_ID`, `P_name`, `P_brandname`, `P_title`, `P_type`, `P_category`, `P_details`, `P_quantity`, `P_unitprice`, `P_image`, `P_itemstatus`, `P_warehouse`) VALUES ('$pID','$pName','$pBrand','$pTitle','$pType','$pCat','$pDetails','$quantity', '$uPrice', '$fileName','$pStatus','$wCode')";

			$query = mysqli_query($con, $insert1) or die(mysqli_error($con));
			if($query == 1){		
					echo '<script>alert("Product Saved!")</script>';
					echo "<meta http-equiv='refresh' content='0'>";
					header("Refresh:0");
			}
			else{
				echo '<script>alert("Product Not Saved !")</script>';
			}

		    mysqli_close($con);
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
									<a href="#" class="fh5co-sub-ddown">View</a>
									<ul class="fh5co-sub-menu">
										<li><a href="ManageOrders.php">Order</a></li>
									</ul>
								</li>
								
								<li><a href="feedback.php">Feedback</a></li>
								<li><a href="logout.php" >Logout</a></li>
							
							<?php }else {?> 
								
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

									<form action="" method="POST" enctype="multipart/form-data">
								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Add Product</a>
								      </li>
								      
								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Product Name:</label>
													<input type="text" class="form-control" name="p_name" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">Product ID:</label>
													<input type="text" class="form-control" name="p_id" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">Brand Name:</label>
													<input type="text" class="form-control" name="p_brand" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-12 mt alternate">
												<div class="input-field">
													<label for="date-start">Product Title:</label>
													<input type="text" class="form-control" name="p_title" required/>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">Product Type:</label>
													<select class="form-control" id="p_type" name="p_type" required>
														<option value=" ">Select Type</option>
														<option value="Fertilizer">Fertilizer</option>
														<option value="Equipment">Equipment</option>
													</select>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">Product Category:</label>
													<select class="form-control" id="p_cat" name="p_cat" required>
														<option value=" ">Select Category</option>
													</select>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">Product Details:</label>
													<textarea type="text" id="details" name="p_details" class="form-control" cols="30" rows="5" required></textarea>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Quantity:</label>
													<input type="number" class="form-control" name="p_quantity"  required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Unit Price:</label>
													<input type="text" class="form-control" name="u_price" required/>
												</div>
											</div>
											
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Product Image:</label>
													<input type="file" class="form-control" name="p_image" onchange="previewFile(this);" required/>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Preview:</label>
													<img id="previewImg" width="150px" height="100px" src="uploads/preview.png" alt="">
												</div>
											</div>
											
											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">Product Status:</label>
													<select class="form-control" id="district" name="p_status">
														<option value="In Stock">In Stock</option>
														<option value="Out of Stock">Out of Stock</option>
													</select>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">Warehouse Code:</label>
													<select class="form-control" id="w_code" name="w_code" required="">
														<option value="">Select Warehouse</option>
														
														<?php

													        $records = mysqli_query($con, "SELECT Warehouse_Code FROM tbl_warehouse");
													        if (mysqli_num_rows($records)>0) {
													        	while($data = mysqli_fetch_array($records))
													        	{
													            echo "<option value='". $data['Warehouse_Code'] ."'>" .$data['Warehouse_Code'] ."</option>";
													        	}
													        }else {
													        	echo "<option value='Not Specified'>Please Add Warehouse</option>";
													        }
													    ?> 
													</select>
												</div>
											</div>
											
											<div class="col-xxs-12 col-xs-12 mt alternate">
												<input type="submit" class="btn btn-primary btn-block" name ="submit" value="Add Product">
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

			function previewFile(input){
		        var file = $("input[type=file]").get(0).files[0];
		 
		        if(file){
		            var reader = new FileReader();
		 
		            reader.onload = function(){
		                $("#previewImg").attr("src", reader.result);
		            }
		 
		            reader.readAsDataURL(file);
		        }
		    }

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

