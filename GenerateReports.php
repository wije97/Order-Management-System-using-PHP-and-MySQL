<?php
	include('./config.php');
	session_start();
	$logtype = $_SESSION["type"];
  	$usertype = $_SESSION["usertype"];


?>
<!DOCTYPE html>

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
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	

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

		<!-- end:header-top -->

		<div class="fh5co-section-gray"><br>
		<table class="table" ><caption><h3 align="center"><b>Generate Reports</b></h3></caption>
			<tr>
			    <form method="POST">
				  <th >
				  	<div class="col-xxs-12 col-xs-12 mt">
						<div class="input-field">
							<select class="form-control" id="type" name="type" onchange="setVal()">
								<option>All Products</option>
								<option value="Products by Type">Products by Type</option>
								<option>All Sold Products</option>
								<option value="Products by Type">Sold Products by Type</option>
								<option>Total Transactions</option>
								<option>All Customers By Gender</option>
								<option></option>
						    </select>
						</div>
					</div>
				  </th>

				  <th>
				  	<div class="col-xxs-12 col-xs-12 mt">
						<div class="input-field">
							<select class="form-control" id="category" name="category" disabled="">
								
						    </select>
						</div>
					</div>
				  </th>
				  
				  <th><button type="submit" name="sby_category" class="btn btn-info">Search</button></th>
				  <th> </th>
			    </form>
			</tr>
		</table>

		<script type="text/javascript">
			
            $(document).ready(function () {
			    $("#type").change(function () {
			        var val = $(this).val();

			        if (val == "Products by Type") {
			        	document.getElementById("category").disabled = false;
			            $("#category").html("<option>Fertilizer</option><option>Equipment</option>");
			        }

			    });
			});

        </script>

		<?php
			if (isset($_POST['sby_category'])) {
				
				$search_type = $_POST['type'];

				switch ($search_type) {
					case 'All Products':
						echo searchAllproducts("");
						break;
					case 'Products by Type':
						$search_category = $_POST['category'];

						echo searchAllproducts("WHERE Type = '$search_category' ");
						break;
					case 'All Sold Products':
						echo searchSoldProducts("");
						break;
					case 'All Donations':
						echo searchSoldProducts("tblrequest", "tbldonation", "tbldonor", "");
						break;
					case 'Group by Donations':
						echo searchDonationGroup("tblrequest", "tbldonation", "tbldonor", "GROUP By tbldonation.Req_ID");
						break;
					
					default:
						// code...
						break;
				}
				

			}else {
				
				echo "<h3 align='center'>Please Select Report Type</h3>";
				echo "</br></br></br></br></br></br></br></br></br></br></br>";
			}

			function searchAllproducts($condition){

				include('./config.php');


					$sql = "SELECT tbl_product.* , tbl_warehouse.* FROM tbl_product INNER JOIN tbl_warehouse ON tbl_product.Warehouse = tbl_warehouse.WCode $condition";

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo '<div class="fh5co-hero">
								<table class="table" id="result_tbl">
									  <thead>
										<tr>
										  <th scope="col"></th>
										  <th scope="col">Image</th>
										  <th scope="col">Product ID</th>
										  <th scope="col">Name</th>
										  <th scope="col">Title</th>
										  <th scope="col">Type</th>
										  <th scope="col">Category</th>
										  <th scope="col">Available Quantity</th>
										  <th scope="col">Unit Price (Rs)</th>
										  <th scope="col">Stock Status</th>
										  <th scope="col">Warehouse Code</th>
										  <th scope="col">Warehouse Name</th>
										  <th scope="col">Warehouse Address</th>
										  <th scope="col">Warehouse Telephone</th>
										  <th></th>
										</tr>
									  </thead>
									  <tbody>';
							while ($row = $result->fetch_assoc()) {
								
								$pName = $row["Name"];
								$proID = $row["ProductID"];
								$pTitle = $row["Title"];
								$pType = $row["Type"];
								$pCat = $row["Category"];
								$quantity = $row["Quantity"];
								$uPrice = $row["UnitPrice"];
								$image = $row["Image"];
								$imageURL = 'uploads/'.$row["Image"];
								$pStatus = $row["ItemStatus"];
								$pWouse = $row["Warehouse"];
								$wCode = $row["WCode"];
								$wName = $row["Name"];
								$wAddress = $row["Address"];
								$wPhone = $row["Phone"];

								echo '<tr class="danger">
								<td> </td>  
								<td><img class="img-responsive" width="150px" height="100px" src="' . $imageURL .'" alt="" /></td>
								<td>'.$proID.'</td>
						        <td>'.$pName.'</td>
						        <td>'.$pTitle.'</td> 
						        <td>'.$pType.'</td>
						        <td>'.$pCat.'</td> 
						        <td>'.$quantity.'</td>
						        <td>'.$uPrice.'</td> 
						        <td>'.$pStatus.'</td>
						        <td>'.$wCode.'</td>
						        <td>'.$wName.'</td> 
						        <td>'.$wAddress.'</td>
						        <td>'.$wPhone.'</td>
						        <td></td>
						      </tr>';
							}
						}else{
							echo "<br><h3 align='center'>No Data</h3>";
							echo "</br></br></br></br></br></br></br></br></br>";
						}
					}
						
				echo '</tbody></table></div>';
			}


			function searchSoldProducts($condition){

				include('./config.php');


					$sql = "SELECT tbl_order_items.* , tbl_product.* FROM tbl_order_items INNER JOIN tbl_product ON tbl_order_items.PrID = tbl_product.ProductID $condition";

					if ($result = mysqli_query($con,$sql)) {
						if(mysqli_num_rows($result)>0){

							echo '<div class="fh5co-hero">
								<table class="table" id="result_tbl">
									  <thead>
										<tr>
										  <th scope="col"></th>
										  <th scope="col">Image</th>
										  <th scope="col">Product ID</th>
										  <th scope="col">Name</th>
										  <th scope="col">Title</th>
										  <th scope="col">Type</th>
										  <th scope="col">Category</th>
										  <th scope="col">Available Quantity</th>
										  <th scope="col">Sold Quantity</th>
										  <th scope="col">Sold Price (Rs)</th>
										  <th></th>
										</tr>
									  </thead>
									  <tbody>';
							while ($row = $result->fetch_assoc()) {
								
								$pName = $row["Name"];
								$proID = $row["ProductID"];
								$pTitle = $row["Title"];
								$pType = $row["Type"];
								$pCat = $row["Category"];
								$quantity = $row["Quantity"];
								$uPrice = $row["UPrice"];
								$image = $row["Image"];
								$imageURL = 'uploads/'.$row["Image"];
								$oQuantity = $row["PQuantity"];

								echo '<tr class="danger">
								<td> </td>  
								<td><img class="img-responsive" width="150px" height="100px" src="' . $imageURL .'" alt="" /></td>
								<td>'.$proID.'</td>
						        <td>'.$pName.'</td>
						        <td>'.$pTitle.'</td> 
						        <td>'.$pType.'</td>
						        <td>'.$pCat.'</td> 
						        <td>'.$quantity.'</td>
						        <td>'.$uPrice.'</td> 
						        <td>'.$oQuantity.'</td>
						        <td></td>
						      </tr>';
							}
						}else{
							echo "<br><h3 align='center'>No Data</h3>";
							echo "</br></br></br></br></br></br></br></br></br>";
						}
					}
						
				echo '</tbody></table></div>';
			}


		?>

		
	</div>
		<footer>
			<div id="footer2" >
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
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

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
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>

