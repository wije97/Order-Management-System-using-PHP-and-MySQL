<?php
	include_Once('../config.php');
	$bStatus = "";
	$subTotal = 0.0;
	session_start();

	$logtype = $_SESSION["type"];
  	$nics = $_SESSION["nic"];
  	$usertype = $_SESSION["usertype"];


?>
<!DOCTYPE html>

<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AgroFarm</title>

	
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
							
							<li class="active"><a href="Customer_UI.php">Dashboard</a></li>
							<li><a href="../index.php">Buy Products</a></li>
							<li><a href="../contact.php">Contact</a></li>
							<li><a href="../About.php">About</a></li> 
							<li>
								<a href="#" class="fh5co-sub-ddown">Profile</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../updateinfoCustomer.php">Update</a></li>
									<li><a href="../logout.php">Logout</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<div class="fh5co-section-gray">
			<br>
				<?php
    				
		  			$sql = "SELECT tbl_cart.Cart_ID, tbl_cart.C_ProductID, tbl_cart.C_quantity AS qCart, tbl_product.P_name, tbl_product.P_brandname, tbl_product.P_unitprice, tbl_product.P_quantity AS qProduct, tbl_product.P_image, tbl_product.P_itemstatus FROM tbl_cart INNER JOIN tbl_product ON tbl_cart.C_ProductID = tbl_product.Product_ID WHERE tbl_cart.C_CusNIC = '$nics' ";

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo'<table class="table">
					  			<thead>
									<tr>
										<th scope="col"></th>
						  				<th scope="col">Image</th>
						  				<th scope="col">Product Name</th>
						  				<th scope="col">Brand Name</th>
						  				<th scope="col">Quantity</th>
						  				<th scope="col">Unit Price</th>
						  				<th scope="col">Item Status</th>
						  				<th scope="col"></th>
						  				<th scope="col"></th>
									</tr>
					  			</thead>
					  			<tbody>';

							while ($row = $result->fetch_assoc()) {
								$cID = $row["Cart_ID"];
								$imageURL = '../uploads/'.$row["P_image"];
								$pName = $row["P_name"];
								$pBrandName = $row["P_brandname"];
								$cQuantity = $row["qCart"];
								$pQuantity = $row["qProduct"];
								$uPrice = $row["P_unitprice"];
								$iStatus = $row["P_itemstatus"];

								if ($cQuantity < $pQuantity) {
									$bStatus = "1";
								}else{
									$bStatus = "0";
								}

								if($iStatus == "Out of Stock"){
									$status = "Out of Stock";
									$total = 0.0;
								}else{
									$status = $pQuantity . " in " . $iStatus;
									$total = $cQuantity * $uPrice;
									$subTotal += $total;
								}

								echo '<form action="" method="POST">
								<tr class="danger"> 
								<td></td>
						        <td><img class="img-responsive" width="150px" height="100px" src="' . $imageURL .'" alt="" /></td> 
						        <td>'.$pName.'</td> 
						        <td>'.$pBrandName.'</td> 
						        <td>'.$cQuantity.'</td>
						        <td>'.$uPrice.'</td>
						        <td>'.$status.'</td>
						        <td><input type="hidden" name="hcid" value="'.$cID.'"></td>
					  			<td><button type="submit" class="btn btn-danger" name="delete">Remove</button></td>
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
															<div style="background-color:#ebedeb; width: 700px; height: 420px; padding: 20px;  float:left;">
																<form action="" method="POST"><table><caption><h3 align="center"><b>Payment Details</b></h3></caption>
															  		<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Payment Type:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 400px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<select class="form-control" id="p_type" name="p_type" required>
																						<option value="Cash (At the Shop)">Cash (At the Shop)</option>
																						<option value="Debit Card" disabled="">Debit Card</option>
																						<option value="Credit Card" disabled="">Credit Card</option>
																					</select>
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		<div style="background-color:#ebedeb; width: 700px;">
															  		<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Card Holder's Name:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 400px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<input type="text" class="form-control" name="address" disabled="" />
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Card Number:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 400px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<input type="text" class="form-control" name="address" disabled=""/>
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">CVV Number:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 400px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<input type="text" class="form-control" name="address" disabled=""/>
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Expire Date:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 400px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<input type="text" class="form-control" name="address" disabled=""/>
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		</div>
															  	</table>

															</div>
														</th>
														<th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
														<th>
															<div style="background-color:#ebedeb; width: 700px; height: 420px; padding: 20px;  float:left;">
																<table><caption><h3 align="center"><b>Confirm Order</b></h3></caption>
																	<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Total:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 500px; text-align:right">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<h1  name="total" readonly=""> <b><?php echo "Rs: " . $subTotal;  ?></b></h1>
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		<tr>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Nearest warehouse:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 400px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<select class="form-control" id="whouse" name="whouse" required>
																						<option value="">Select Warehouse</option>
														
																							<?php

																						        $records = mysqli_query($con, "SELECT Warehouse_Code, W_name, W_address FROM tbl_warehouse");
																						        if (mysqli_num_rows($records)>0) {
																						        	while($data = mysqli_fetch_array($records))
																						        	{
																						            echo "<option value='". $data['Warehouse_Code'] ."'>" . $data['W_name'] ." - " .$data['W_address']."</option>";
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
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<label for="from">Note:</label>
																				</div>
																			</div>
															  			</th>
															  			<th style="width: 500px">
															  				<div class="col-xxs-12 col-xs-12 mt">
																				<div class="input-field">
																					<input type="text" class="form-control" name="note" value="None" required/>
																				</div>
																			</div>
															  			</th>
															  		</tr>
															  		<tr>
															  			<th></th>
															  			<th>
															  				<div class="col-xxs-12 col-xs-12 mt alternate">
																				<input type="submit" class="btn btn-success btn-block" name ="place_order" value="Place Order">
																			</div>
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
								<br>

				  			<?php
				  		}else {
							echo "<br><h3 align='center'>No Items in Your Cart</h3>";
							echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";
						}
			  		}
				  	echo '</tbody></table>';
    					
		?>


		<?php
			if(isset($_POST['delete'])){
				$key = $_POST['hcid'];

				$delete = mysqli_query($con,"DELETE FROM `tbl_cart` WHERE Cart_ID = '$key'") or die("Action not successful".mysql_error());

				echo "<meta http-equiv='refresh' content='0'>";
			}

			if (isset($_POST['place_order'])) {

				$date= date("Y-m-d");
				$note = $_POST['note'];
				$whouse = $_POST['whouse'];
				$payType = $_POST['p_type'];


				$insert1="INSERT INTO `tbl_order`(`O_CusNIC`, `O_note`, `O_totalprice`, `O_date`, `O_nearwarehouse`, `O_pickupat`,`O_status`) VALUES ('$nics','$note','$subTotal','$date', '$whouse', 'Pending', 'Pending')";

				$query = mysqli_query($con, $insert1) or die(mysqli_error($con));
				if($query == 1){
					$last_id = $con->insert_id;	
					
					$sql = "SELECT tbl_cart.Cart_ID, tbl_cart.C_ProductID, tbl_cart.C_quantity AS qCart, tbl_product.P_unitprice, tbl_product.P_quantity AS qProduct FROM tbl_cart INNER JOIN tbl_product ON tbl_cart.C_ProductID = tbl_product.Product_ID WHERE tbl_cart.C_CusNIC = '$nics' ";
					if ($result = mysqli_query($con,$sql)) {
						while ($row = $result->fetch_assoc()) {
							$pID = $row["C_ProductID"];
							$cQuantity = $row["qCart"];
							$pQuantity = $row["qProduct"];
							$uPrice = $row["P_unitprice"];

							$insert2="INSERT INTO `tbl_order_product`(`OP_ProductID`, `OP_quantity`, `OP_OrderID`) VALUES ('$pID','$cQuantity','$last_id')";
							$query = mysqli_query($con, $insert2) or die(mysqli_error($con));
							if($query != 1){
								echo '<script>alert("Order Confirmation Falied!")</script>';
							}

							
							$totalQuantity = $pQuantity - $cQuantity;
							if ($totalQuantity == 0) {
								$availableStatus = "Out of Stock";
							}else{
								$availableStatus = "In Stock";
							}

							$update = "UPDATE `tbl_product` SET P_quantity='$totalQuantity', P_itemstatus='$availableStatus' WHERE Product_ID='$pID'";
							$query = mysqli_query($con, $update) or die(mysqli_error($con));

						}
		
						if ($payType == "Cash (At the Shop)") {
							$payment="INSERT INTO `tbl_payment`( `Payment_type`, `Payment_status`, `Pay_OrderID`) VALUES ('$payType', 'Pending', '$last_id')";
							$query = mysqli_query($con, $payment) or die(mysqli_error($con));
						}
						

						$insert3="INSERT INTO `tbl_notification`(`OrderID`, `Description`, `CusNIC`, `CusStatus`, `AuthStatus`) VALUES ('$last_id','Thank you for Your Order!. We will inform you after oder is Ready.','$nics','1', '1')";
						$query = mysqli_query($con, $insert3) or die(mysqli_error($con));

						$delete = mysqli_query($con,"DELETE FROM `tbl_cart` WHERE C_CusNIC = '$nics'") or die("Action not successful".mysql_error());

						echo '<script>alert("Order Confirmed!")</script>';
						echo "<meta http-equiv='refresh' content='0'>";
					}
					
				}
				else{
					echo '<script>alert("Order Confirmation Falied!")</script>';
				}

		        mysqli_close($con);
			}

			
			
		?>		
		
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
