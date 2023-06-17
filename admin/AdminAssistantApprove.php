<?php
include_Once('../config.php');
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


		<!-- end:header-top -->
					
		<div  class="fh5co-section-gray"><br>
		<?php
  			$sql = "SELECT * FROM tbl_staff_member WHERE S_type= 'Assistant' AND S_status ='Pending'";
			if ($result = mysqli_query($con,$sql)) {
				if(mysqli_num_rows($result)>0){

					echo '<table class="table"><caption><h3 align="center"><b>Pending Approval</b></h3></caption>
			  					<thead>
								<tr><th scope="col"></th>
									<th scope="col">StaffID</th>
									<th scope="col">Warehouse Code</th>
					  				<th scope="col">First Name</th>
					  				<th scope="col">Last Name</th>
					  				<th scope="col">NIC</th>
					  				<th scope="col">Gender</th>
					  				<th scope="col">Age</th>
					  				<th scope="col">Address</th>
					  				<th scope="col">Email</th>
					  				<th scope="col">Phone</th>
					  				<th scope="col">Status</th>
					  				<th scope="col">Action</th>
					  				<th scope="col"></th>
								</tr>
				  			</thead><tbody>;';

					while ($row = $result->fetch_assoc()) {

						$nic = $row["S_NIC"];
						$fname = $row["S_First_Name"];
						$lname = $row["S_Last_Name"];
						$brCode = $row["S_WarehouseCode"];
						$stID = $row["Staff_ID"];
						$gender = $row["S_gender"]; 
						$age = $row["S_age"];
						$address = $row["S_address"];
						$email = $row["S_email"];
						$phone = $row["S_phone"];
						$status = $row["S_status"];
	
						echo '<form action="" method="POST">
						<tr class="danger">
						 <td></td> 
						<td>'.$stID.'</a></td>
						<td>'.$brCode.'</td>
				        <td>'.$fname.'</td> 
				        <td>'.$lname.'</td>
				        <td>'.$nic.'</td>
				        <td>'.$gender.'</a></td>
				        <td>'.$age.'</td>
				        <td>'.$address.'</td>
				        <td>'.$email.'</td>
				        <td>'.$phone.'</td>
				        <td>'.$status.'</td>
				        <td><button type="submit" class="btn btn-warning" name="approve">Approve</button>
				        <input type="hidden" name="hnic" value="'.$nic.'"</td>
			  			<td><button type="submit" class="btn btn-danger" name="reject">Reject</button></td>
			  			</form>
				      </tr>';
		  			}	
				}
				else 
				{
					echo "<br><h3 align='center'>No Authorizers to Approve</h3>";
					echo "</br></br>";
				}
				
  			}       
		  	echo '</tbody></table>';
		?>

		<?php
			if(isset($_POST['approve'])){
				$key = $_POST['hnic'];
			
				$qupdate = mysqli_query($con,"UPDATE `tbl_staff_member` SET S_status = 'Approved' WHERE S_NIC = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}
			elseif(isset($_POST['reject'])){
				$key = $_POST['hnic'];
				$qupdate = mysqli_query($con,"UPDATE `tbl_staff_member` SET S_status = 'Reject' WHERE S_NIC = '$key'") or die("Action not successful".mysql_error());
				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}
		?>

		</br></br></br></br></br></br></br></br></br></br></br></br></br>
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
