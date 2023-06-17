<?php
	include_Once('./config.php');
	session_start();

	$usertype = $_SESSION["usertype"];
	$whCode = $_SESSION["whCode"];
  	$oid = $_SESSION["oid"];
  	$cid = $_SESSION["cNIC"];
  	$ostatus = $_SESSION["oStatus"];

  	$sql = "SELECT C_First_Name, C_Last_Name, C_address, C_phone FROM tbl_customer WHERE C_NIC = '$cid'";
	$result = mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$fname = $row["C_First_Name"];
		$lname = $row["C_Last_Name"];
		$telephone = $row["C_phone"];
		$address = $row["C_address"];

		$fName = $fname ." " . $lname;
	}
  	
?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AgroFarm</title>

	
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

		<div class="fh5co-section-gray">
			<br>
				
				<?php
    				
		  			$sql = "SELECT tbl_order_product.OP_quantity, tbl_order_product.OP_ProductID, tbl_product.P_unitprice, tbl_product.P_name, tbl_product.P_brandname, tbl_product.P_type, tbl_product.P_category, tbl_product.P_image FROM tbl_order_product INNER JOIN tbl_product ON tbl_order_product.OP_ProductID=tbl_product.Product_ID WHERE tbl_order_product.OP_OrderID= '$oid' ";
					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo'<table class="table">
					  			<thead>
									<tr>
										<th scope="col"></th>
						  				<th scope="col">Image</th>
						  				<th scope="col">Product Name</th>
						  				<th scope="col">Brand Name</th>
						  				<th scope="col">Type</th>
						  				<th scope="col">Category</th>
						  				<th scope="col">Quantity</th>
						  				<th scope="col">Unit Price</th>
						  				<th scope="col"></th>
									</tr>
					  			</thead>
					  			<tbody>';
							while ($row = $result->fetch_assoc()) {
								$imageURL = 'uploads/'.$row["P_image"];
								$pName = $row["P_name"];
								$pType = $row["P_type"];
								$pbrand = $row["P_brandname"];
								$pCat = $row["P_category"];
								$pQuantity = $row["OP_quantity"];
								$uPrice = $row["P_unitprice"];

								echo '<form action="" method="POST">
								<tr class="danger"> 
								<td></td>
						        <td><img class="img-responsive" width="150px" height="100px" src="' . $imageURL .'" alt="" /></td> 
						        <td>'.$pName.'</td> 
						        <td>'.$pbrand.'</td> 
						        <td>'.$pType.'</td> 
						        <td>'.$pCat.'</td> 
						        <td>'.$pQuantity.'</td>
						        <td>'.$uPrice.'</td>
						        <td></td>
					  			</form>
						      </tr>';
				  			}	

				  			?>
				  				<div class="container">
									<div class="row animate-box" >
										<br>
										<div class="col-md-6">
											<div class="row">
												<table class="table-responsive">
													<tr>
														<th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th><th>&nbsp&nbsp&nbsp&nbsp&nbsp</th>
														<th>
															<div style="background-color:#ebedeb; width: 700px; height: 320px; padding: 20px;  float:left;">
																<form action="" method="POST"><table><caption><h3 align="center"><b>Customer Information</b></h3></caption>
															  		<tr>
															  			<th >
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Name:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 500px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from"><?php echo $fName;  ?></label>
																				</div>
																			</div>
															  			</th>
															  		</tr>

															  		<tr>
															  			<th >
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Address:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 500px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from"><?php echo $address;  ?></label>
																				</div>
																			</div>
															  			</th>
															  		</tr>

															  		<tr>
															  			<th >
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Mobile Number:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 500px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from"><?php echo $telephone;  ?></label>
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  	</table>
														</th>
														<th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
														<th>
															<div style="background-color:#ebedeb; width: 700px; height: 320px; padding: 20px;  float:left;">
																<table><caption><h3 align="center"><b>Warehoue Details</b></h3></caption>
															  		<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Pickup At:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 500px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<select class="form-control" id="w_code" name="w_code" required="">
																						<option value="">Select Warehouse</option>
																						
																						<?php

																					        $records = mysqli_query($con, "SELECT Warehouse_Code, W_name, W_address FROM tbl_warehouse");
																					        if (mysqli_num_rows($records)>0) {
																					        	while($data = mysqli_fetch_array($records))
																					        	{
																					        		?>	

																					        		<option value="<?php echo  $data['W_name'] ." - " .$data['W_address'] ?>" <?php if($data['Warehouse_Code'] == $whCode) { ?> selected <?php } ?>> <?php echo $data['Warehouse_Code']?> </option>

																					        		<?php
																					        	}

																					        }else {
																					        	echo "<option value='Not Specified'>Please Add Warehouse</option>";
																					        }
																					    ?> 
																					</select>  
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		<tr>
															  			<th></th>
															  			<th>
															  				<?php if($ostatus == "Pending") {?> 
																  				<div class="col-xxs-12 col-xs-12 mt alternate">
																					<input type="submit" class="btn btn-success btn-block" name ="ready" value="Ready To PickUp">
																				</div>
																			<?php } ?>
															  			</th>
															  		</tr>
															  	</table></form>

															</div>
														</th>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
				  			<?php
				  		}else {
							echo "<br><h3 align='center'>No Data</h3>";
						}
			  		}
				  	echo '</tbody>';
				 echo'</table></br></br>';
    					
		?>

	</div>
	<?php 

			if (isset($_POST['ready'])) {

				$wCode =  $_POST['w_code'];
				
				$update = "UPDATE `tbl_order` SET O_status='Ready', O_pickupat='$wCode' WHERE Order_ID='$oid'";

				$query = mysqli_query($con, $update) or die(mysqli_error($con));
				if($query == 1){		
		
					$insert3="INSERT INTO `tbl_notification`(`OrderID`, `Description`, `CusNIC`, `CusStatus`, `AuthStatus`) VALUES ('$oid','You Order (Order ID = $oid) is Ready. Pickup it at $wCode. Thank you!','$cid','1', '0')";
					$query = mysqli_query($con, $insert3) or die(mysqli_error($con));

					$update2 = "UPDATE `tbl_notification` SET AuthStatus='0' WHERE OrderID='$oid'";

					$query = mysqli_query($con, $update2) or die(mysqli_error($con));

					echo '<script type="text/javascript">
					alert("Order Marked as Ready!");
					window.location.href = "ManageOrders.php";</script>';
					
				}
				else{
					echo '<script>alert("Update Unsuccessful !")</script>';
				}

		        mysqli_close($con);

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


	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
