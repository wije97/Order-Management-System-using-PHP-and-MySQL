<?php
	include_Once('./config.php');
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
				<table class="table"><caption><h3 align="center"><b>View Orders</b></h3></caption>
					<tr> 
					  <form method="POST" action="">
					  <th style="width: 400px">
					  	<div class="col-xxs-12 col-xs-12 mt">
							<div class="input-field">
								<input type="text" class="form-control" name="order_id" placeholder="Enter Order ID" required/>
							</div>
						</div>
					  </th>
					  <th>
					  	<div class="col-xxs-8 col-xs-8 mt">
							<div class="input-field">
								<button type="Submit" class="btn btn-info"  name="id_search">Search</button>
							</div>
						</div>
					</th></form>

					<form method="POST" action="">
					  <th style="width: 400px">
					  	<div class="col-xxs-12 col-xs-12 mt">
							<div class="input-field">
								<select class="form-control" id="o_type" name="o_type" required>
									<option value="Pending">Pending</option>
									<option value="Confirmed">Confirmed</option>
									<option value="Canceled">Canceled</option>
								</select>
							</div>
						</div>
					  </th>
					  <th>
					  	<div class="col-xxs-8 col-xs-8 mt">
							<div class="input-field">
								<button type="Submit" class="btn btn-info"  name="status_search">Search</button>
							</div>
						</div>
					</th></form>



					</tr>
				</table>

				<?php
    				if(isset($_POST['id_search'])){

    					if(!empty($_POST['order_id']) ) {

    						$orderId = $_POST['order_id'];
    						echo searchOrder("WHERE Order_ID= '$orderId' ");
    					} 
    				}else if(isset($_POST['status_search'])){

    					if(!empty($_POST['o_type']) ) {

    						$orderStatus = $_POST['o_type'];

    						if ($orderStatus == "Pending") {
    							echo searchOrder("WHERE O_status = 'Pending' ");
    						}else if ($orderStatus == "Confirmed"){
    							echo searchOrder("WHERE O_status = 'Ready' ");
    						}else{
    							echo searchOrder("WHERE O_status = 'Canceled' ");
    						}

    						
    					} 
    				}
    				else{
    					echo searchOrder("WHERE O_status = 'Pending' ");
    				}
    				
					function searchOrder($condition){
						include('./config.php');
						$nics = $_SESSION["nic"];

			  			$sql = "SELECT tbl_order.Order_ID, tbl_order.O_CusNIC, tbl_order.O_note, tbl_order.O_totalprice,  tbl_order.O_date, tbl_order.O_nearwarehouse, tbl_order.O_status, tbl_payment.Payment_type, tbl_payment.Payment_status FROM  tbl_order INNER JOIN tbl_payment ON tbl_order.Order_ID = tbl_payment.Pay_OrderID $condition " ;
						if ($result = mysqli_query($con,$sql)) {
							if(mysqli_num_rows($result)>0){

								echo'<table class="table">
						  			<thead>
										<tr>
											<th scope="col"></th>
											<th scope="col"></th>
							  				<th scope="col">Order Id</th>
							  				<th scope="col">Note</th>
							  				<th scope="col">Total Price</th>
							  				<th scope="col">Expected Warehouse</th>
							  				<th scope="col">Date</th>
							  				<th scope="col">Payment Type</th>
							  				<th scope="col">Payment Status</th>
							  				<th scope="col">Order Status</th>
							  				<th scope="col"></th>
							  				<th scope="col"></th>
										</tr>
						  			</thead>
						  			<tbody>';
								while ($row = $result->fetch_assoc()) {
									$oID = $row["Order_ID"];
									$cNIC = $row["O_CusNIC"];
									$oNote = $row["O_note"];
									$oTPrice = $row["O_totalprice"];
									$wHouse = $row["O_nearwarehouse"];
									$oDate = $row["O_date"];
									$pType = $row["Payment_type"];
									$pStatus = $row["Payment_status"];
									$oStatus = $row["O_status"];

									echo '<form action="" method="POST">
									<tr class="danger"> 
									<td></td><td></td>
							        <td>'.$oID.'</td> 
							        <td>'.$oNote.'</td>
							        <td>'.$oTPrice.'</td>
							        <td>'.$wHouse.'</td>
							        <td>'.$oDate.'</td>
							        <td>'.$pType.'</td>
							        <td>'.$pStatus.'</td>
							        <td>'.$oStatus.'</td>
							        <td><button type="submit" class="btn btn-warning" name="view">View</button>
							        <input type="hidden" name="hoid" value="'.$oID.'">
							        <input type="hidden" name="hwhC" value="'.$wHouse.'">
							        <input type="hidden" name="hcNIC" value="'.$cNIC.'"></td>
							        <input type="hidden" name="hOStatus" value="'.$oStatus.'"></td>
						  			<td><button type="submit" class="btn btn-danger" name="delete">Cancel</button></td>
						  			</form>
							      </tr>';
					  			}	
					  			}else {
									echo "<br><h3 align='center'>No Data</h3>";
								}
				  			}
					  		echo '</tbody>';
						 echo'</table>';
						}
		?>
		<?php
			if(isset($_POST['view'])){

				$_SESSION["oid"] = $_POST['hoid'];
				$_SESSION["whCode"] = $_POST['hwhC'];
				$_SESSION["cNIC"] = $_POST['hcNIC'];
				$_SESSION["oStatus"] = $_POST['hOStatus'];

				echo '<script type="text/javascript">
					window.location.href = "OrderItemView.php";</script>';
				//header("Refresh:0; url=adminupdateinfoRequester.php");
				
			}

			if(isset($_POST['delete'])){
				$key = $_POST['hoid'];
				$cid = $_POST['hcNIC'];

				$update = "UPDATE `tbl_order` SET O_status='Canceled' WHERE Order_ID='$key'";

				$query = mysqli_query($con, $update) or die(mysqli_error($con));
				if($query == 1){		
		
					$insert3="INSERT INTO `tbl_notification`(`OrderID`, `Description`, `CusNIC`, `CusStatus`, `AuthStatus`) VALUES ('$key','You Order (Order ID = $oid) is Canceled. Please contact (+94) 77 222 3333 for more details. Thank you!','$cid','1', '0')";
					$query = mysqli_query($con, $insert3) or die(mysqli_error($con));

					$update2 = "UPDATE `tbl_notification` SET AuthStatus='0' WHERE OrderID='$key'";

					$query = mysqli_query($con, $update2) or die(mysqli_error($con));

					echo '<script type="text/javascript">
					alert("Order Canceled!");</script>';
					echo "<meta http-equiv='refresh' content='0'>";
					header("Refresh:0");
					
				}
				else{
					echo '<script>alert("Cancel Failed !")</script>';
				}

		        mysqli_close($con);

				}

				

			?>		
		</br></br></br></br></br></br></br></br></br></br>
	</div>

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
