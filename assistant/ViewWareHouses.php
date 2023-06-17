<?php
include_Once('../config.php');
$district = '';

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
							<li><a href="Assistant_UI.php">Dashboard</a></li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Add</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../addProduct.php">Product</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="fh5co-sub-ddown">View</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../ManageOrders.php">Order</a></li>
								</ul>
							</li>

							<li><a href="../contact.php">Contact</a></li>
							<li><a href="../About.php">About</a></li> 
							<li>
								<a href="#" class="fh5co-sub-ddown">Profile</a>
								<ul class="fh5co-sub-menu">
									<li><a href="../updateinfoAssistant.php">Update</a></li>
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
				<table class="table"><caption><h3 align="center"><b>Manage Users</b></h3></caption>
				<tr> 
				  <th style="width: 500px;">
				  <form action="" method="POST">
				  	<div class="col-md-12">
						<div class="form-group">
							<select class="form-control" id="district" name="w_district" required="">
								<option value="">Select District</option>
								
								<?php
							        $records = mysqli_query($con, "SELECT DISTINCT W_district FROM tbl_warehouse");
							        if (mysqli_num_rows($records)>0) {
							        	while($data = mysqli_fetch_array($records))
							        	{
							            echo "<option value='". $data['W_district'] ."'>" .$data['W_district'] ."</option>";
							        	}
							        }else {
							        	echo "<option value='Not Specified'>Please Add Warehouse</option>";
							        }
							    ?> 
							</select>	
						</div>
					</div>	
				  			  
				  </th>
				  <th><button type="Submit" class="btn btn-info"  name="submit">Search</button></th>
				</tr>
				</form>
				</table>

				<?php
    				if(isset($_POST['submit'])){
    					if(!empty($_POST['w_district'])) {

        					$district = $_POST['w_district'];
        					
				  			$sql = "SELECT * FROM tbl_warehouse WHERE W_district= '$district'";
							if ($result = mysqli_query($con,$sql)) {
								if(mysqli_num_rows($result)>0){

									echo'<table class="table">
							  			<thead>
											<tr>
												<th scope="col"></th>
								  				<th scope="col">Warehouse Code</th>
								  				<th scope="col">Warehouse Name</th>
								  				<th scope="col">Address</th>
								  				<th scope="col">Contact Number</th>
								  				<th scope="col"></th>
								  				<th scope="col"></th>
											</tr>
							  			</thead>
							  			<tbody>';
									while ($row = $result->fetch_assoc()) {
										$wCode = $row["Warehouse_Code"];
										$wName = $row["W_name"];
										$wAddress = $row["W_address"];
										$wPhone = $row["W_phone"];

										echo '<form action="" method="POST">
										<tr class="danger"> 
										<td></td>
										<td>'.$wCode.'</td>
								        <td>'.$wName.'</td> 
								        <td>'.$wAddress.'</td>
								        <td>'.$wPhone.'</td>
								        <td></td>
							  			<td></td>
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
    				}
    				else {
						echo "<h3 align='center'>Please Select Warehouse</h3>";
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
