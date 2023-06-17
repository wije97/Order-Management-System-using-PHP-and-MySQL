<?php
include_Once('../config.php');
$selected = '';

session_start();
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


		
		<div class="fh5co-section-gray">
			<br>
		<table class="table"><caption><h3 align="center"><b>Manage Users</b></h3></caption>
				<tr> 
				  <th>
				  <form action="" method="POST">
				  <select class="form-control" id="user" name="user">
						<option>Select</option>
						<option value="tbl_customer">Customer</option>
						<option value="tbl_staff_member">Assistant</option>
				   </select>				  
				  </th>
				  <th><button type="Submit" class="btn btn-info"  name="submit">Search</button></th>
				  <th><a class="btn btn-success" href="../registrationAssistant.php">Add New Assistant<i class="icon-arrow-right22"></i></a></th>
				</tr>
				</form>
				</table>

				<?php
    				if(isset($_POST['submit'])){
    					if(!empty($_POST['user'])) {
        				$selected = $_POST['user'];
    					} 
    				}
    				if($selected == "tbl_customer"){

			  			$sql = "SELECT * FROM tbl_customer";
						if ($result = mysqli_query($con,$sql)) {
							if(mysqli_num_rows($result)>0){

								echo'<table class="table">
						  			<thead>
										<tr>
											<th scope="col"></th>
							  				<th scope="col">NIC</th>
							  				<th scope="col">First Name</th>
							  				<th scope="col">Last Name</th>
							  				<th scope="col">Age</th>
							  				<th scope="col">Phone</th>
							  				<th scope="col">Address</th>
							  				<th scope="col"></th>
							  				<th scope="col"></th>
										</tr>
						  			</thead>
						  			<tbody>';
								while ($row = $result->fetch_assoc()) {
									$nic = $row["C_NIC"];
									$fname = $row["C_First_Name"];
									$lname = $row["C_Last_Name"];
									$age = $row["C_age"];
									$phone = $row["C_phone"];
									$address = $row["C_address"];

									echo '<form action="" method="POST">
									<tr class="danger"> 
									<td></td>
							        <td>'.$nic.'</td> 
							        <td>'.$fname.'</td> 
							        <td>'.$lname.'</td>
							        <td>'.$age.'</td>
							        <td>'.$phone.'</td>
							        <td>'.$address.'</td>
							        <td><button type="submit" class="btn btn-warning" name="view">View</button>
							        <input type="hidden" name="hnic" value="'.$nic.'"><input type="hidden" name="type" value="customer"></td>
						  			<td><button type="submit" class="btn btn-danger" name="delete">Delete</button></td>
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
			else if($selected == "tbl_staff_member"){

			  			$sql = "SELECT * FROM tbl_staff_member WHERE S_status = 'Approved'";
						if ($result = mysqli_query($con,$sql)) {
							if(mysqli_num_rows($result)>0){

								echo'<table class="table">
						  			<thead>
										<tr>
											<th scope="col"></th>
											<th scope="col">StaffID</th>
							  				<th scope="col">Warehouse Code</th>
							  				<th scope="col">First Name</th>
							  				<th scope="col">Last Name</th>
							  				<th scope="col">NIC</th>
							  				<th scope="col">Mobile Number</th>
							  				<th scope="col">Address</th>
							  				<th scope="col"></th>
							  				<th scope="col"></th>
										</tr>
						  			</thead>
						  			<tbody>';
								while ($row = $result->fetch_assoc()) {
									$nic = $row["S_NIC"];
									$fname = $row["S_First_Name"];
									$lname = $row["S_Last_Name"];
									$wCode = $row["S_WarehouseCode"];
									$stID = $row["Staff_ID"];
									$telephone = $row["S_phone"];
									$address = $row["S_address"];
				

									echo '<form action="" method="POST">
									<tr class="danger"> 
							        <td></td>
							        <td>'.$stID.'</td>
							        <td>'.$wCode.'</a></td>
							        <td>'.$fname.'</td> 
							        <td>'.$lname.'</td>
							        <td>'.$nic.'</td> 
							        <td>'.$telephone.'</td>
							        <td>'.$address.'</td>
							        <td><button type="submit" class="btn btn-warning" name="view">View</button>
							        <input type="hidden" name="hnic" value="'.$nic.'"><input type="hidden" name="type" value="assistant"></td>
						  			<td><button type="submit" class="btn btn-danger" name="delete">Delete</button></td>
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
			else {
				echo "<h3 align='center'>Please Select Valid User</h3>";
			}	
		?>
		<?php
			if(isset($_POST['view'])){
				$type = $_POST['type'];
				if($type== "customer"){
					$_SESSION["type"] = "customer";
  					$_SESSION["nic"] = $_POST['hnic'];
  					header("Location:../updateinfoCustomer.php");
  					//header("Refresh:0; url=adminupdateinfoRequester.php");
				}else{
					$_SESSION["type"] = "assistant";
  					$_SESSION["nic"] = $_POST['hnic'];
  					header("Location:../updateinfoAssistant.php");
  					//header("Refresh:0; url=adminupdateinfoAuthorizer.php");
				}

			}

			if(isset($_POST['delete'])){
				$key = $_POST['hnic'];
				$type = $_POST['type'];
				if($type== "customer"){
					$qupdate = mysqli_query($con,"DELETE FROM `tbl_customer` WHERE C_NIC = '$key'") or die("Action not successful".mysql_error());

					//$qdelete2 = mysqli_query($con,"DELETE FROM `tblrequest` WHERE nic = '$key'") or die("Action not successful".mysql_error());

					//$qdelete2 = mysqli_query($con,"DELETE FROM `tblrequestnotification` WHERE Req_NIC = '$key'") or die("Action not successful".mysql_error());

					echo "<meta http-equiv='refresh' content='0'>";
					header("Refresh:0");


				}
				else{
					$qupdate = mysqli_query($con,"DELETE FROM `tbl_staff_member` WHERE S_NIC = '$key'") or die("Action not successful".mysql_error());
					echo "<meta http-equiv='refresh' content='0'>";
					header("Refresh:0");
				}
			}

			?>		
		</br></br></br></br></br></br></br></br></br></br>
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
