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
							<?php if($usertype == "assistant") {?> 
								
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

							<?php } else if($usertype == "admin") {?> 
								
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
							
							<?php }else if($usertype == "customer") {?> 
								
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
							<?php }  ?>

						</ul>
					</nav>
				</div>
			</div>
		</header>


		<!-- end:header-top -->
		
  		<div class="fh5co-section-gray"><br>
		<?php

			if ($usertype == "customer") {

				$sql = "SELECT * FROM tbl_notification WHERE CusNIC= '$nics'";
				if ($result = mysqli_query($con,$sql)) {
					if(mysqli_num_rows($result)>0){

						echo '<table class="table"><caption><h3 align="center"><b>Notifications</b></h3></caption><thead>
						<tr><th scope="col"></th>
							<th scope="col">Order ID</th>
			  				<th scope="col" style"width: 500px;">Description</th>
			  				<th scope="col"></th>
			  				<th scope="col"></th>
						</tr></thead><tbody>';

						while ($row = $result->fetch_assoc()) {

							$nID = $row["NotificationID"];
							$oID = $row["OrderID"];
							$description = $row["Description"];
							$cStatus = $row["CusStatus"];
		
							echo '<form action="" method="POST">
							<tr class="danger">
							 <td></td>';


					        if($cStatus == '1'){
					        	echo '<td></td><td><b><a href="customer/customerViewOrders.php" >'.$oID.'</a></b></td>
					        		  <td><a>'.$description.'</a></td><td></td>
					        		  <td><button type="submit" class="btn btn-warning" name="cus_mark_read">Mark as Read</button>
					        		  <input type="hidden" name="hnid" value="'.$nID.'"</td>';
					        } else{
					        	echo '<td></td><td>'.$oID.'</td>
					        		  <td>'.$description.'</td><td></td>
					        		  <td></td> ';
					        }

				  			echo '</form></tr>';
			  			}	
			  		}else 
					{
						echo "<br><h3 align='center'>No Notifications</h3>";
						echo "</br></br>";
					}
	  			}       
	  			echo '</tbody></table>';

			}else if($usertype == "assistant"){

				$sql = "SELECT * FROM tbl_notification ";
				if ($result = mysqli_query($con,$sql)) {
					if(mysqli_num_rows($result)>0){

						echo '<table class="table"><caption><h3 align="center"><b>Notifications</b></h3></caption><thead>
						<tr><th scope="col"></th>
						<th scope="col"></th>
							<th scope="col">Order ID</th>
			  				<th scope="col" style"width: 700px;">Description</th>
			  				<th scope="col" style"width: 700px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
			  				<th scope="col" ></th>

						</tr></thead><tbody>';

						while ($row = $result->fetch_assoc()) {

							$nID = $row["NotificationID"];
							$oID = $row["OrderID"];
							$aStatus = $row["AuthStatus"];
		
							echo '<form action="" method="POST">
							<tr class="danger">
							 <td></td>';


					        if($aStatus == '1'){
					        	echo '<td></td>
					        		  <td><b><a href="ManageOrders.php" >'.$oID.'</a></b></td>
					        		  <td><a> You Have New Order</a></td><td></td>
					        		  <td><button type="submit" class="btn btn-warning" name="assi_mark_read">Mark as Read</button>
					        		  <input type="hidden" name="hnid" value="'.$nID.'"</td>';
					        } else{
					        	echo '<td></td><td>'.$oID.'</td>
					        		  <td>You Have New Order</td><td></td>
					        		  <td></td> ';
					        }

				  			echo '</form></tr>';
			  			}
			  		}
			  		else 
					{
						echo "<br><h3 align='center'>No Notifications</h3>";
						echo "</br></br>";
					}	
	  			}       
	  			echo '</tbody></table>';
			}

		?>

		<?php
			if(isset($_POST['cus_mark_read'])){
				$key = $_POST['hnid'];

				$qupdate = mysqli_query($con,"UPDATE `tbl_notification` SET CusStatus = '0' WHERE NotificationID = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}

			if(isset($_POST['assi_mark_read'])){
				$key = $_POST['hnid'];

				$qupdate = mysqli_query($con,"UPDATE `tbl_notification` SET AuthStatus = '0' WHERE NotificationID = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}
			
		?>

		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br></br>

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
