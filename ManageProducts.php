<?php
include_Once('./config.php');
	$productType = '';
	$productCategory = '';
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
				<table class="table"><caption><h3 align="center"><b>Manage Products</b></h3></caption>
					<tr> 
					  <th>
					  	<form action="" method="POST">
						   <select class="form-control" id="p_type" name="p_type" required>
								<option value=" ">Select Product Type</option>
								<option value="Fertilizer">Fertilizer</option>
								<option value="Equipment">Equipment</option>
							</select>			  
					  </th>

					  <th>
						   <select class="form-control" id="p_cat" name="p_cat" required>
								<option value=" ">Select Category</option>
							</select>	  
					  </th>
					  <th><button type="Submit" class="btn btn-info"  name="submit">Search</button></th>
					</form>
						<form method="POST" action=""><th><button type="Submit" class="btn btn-danger"  name="out_of_stock">Out of Stock</button></th></form>
						<th><a class="btn btn-success" href="addProduct.php">Add New Product<i class="icon-arrow-right22"></i></a></th>
					</tr>

				</table>

				<?php
    				if(isset($_POST['submit'])){
    					if(!empty($_POST['p_type']) ) {

        					$productType = $_POST['p_type'];
        					$productCategory = $_POST['p_cat'];
        					
				  			$sql = "SELECT * FROM tbl_product WHERE P_type= '$productType' AND P_category= '$productCategory'";
							if ($result = mysqli_query($con,$sql)) {
								if(mysqli_num_rows($result)>0){

									echo'<table class="table">
							  			<thead>
											<tr>
												<th scope="col"></th>
								  				<th scope="col">Image</th>
								  				<th scope="col">Product Name</th>
								  				<th scope="col">Quantity</th>
								  				<th scope="col">Unit Price</th>
								  				<th scope="col">Item Status</th>
								  				<th scope="col"></th>
								  				<th scope="col"></th>
											</tr>
							  			</thead>
							  			<tbody>';
									while ($row = $result->fetch_assoc()) {
										$pID = $row["Product_ID"];
										$imageURL = 'uploads/'.$row["P_image"];
										$pName = $row["P_name"];
										$pQuantity = $row["P_quantity"];
										$uPrice = $row["P_unitprice"];
										$iStatus = $row["P_itemstatus"];

										echo '<form action="" method="POST">
										<tr class="danger"> 
										<td></td>
								        <td><img class="img-responsive" width="150px" height="100px" src="' . $imageURL .'" alt="" /></td> 
								        <td>'.$pName.'</td> 
								        <td>'.$pQuantity.'</td>
								        <td>'.$uPrice.'</td>
								        <td>'.$iStatus.'</td>
								        <td><button type="submit" class="btn btn-warning" name="view">View</button>
								        <input type="hidden" name="hpid" value="'.$pID.'"></td>
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
    				}else if(isset($_POST['out_of_stock'])){
    					$sql = "SELECT * FROM tbl_product WHERE P_itemstatus= 'Out of Stock' ";
							if ($result = mysqli_query($con,$sql)) {
								if(mysqli_num_rows($result)>0){

									echo'<table class="table">
							  			<thead>
											<tr>
												<th scope="col"></th>
								  				<th scope="col">Image</th>
								  				<th scope="col">Product Name</th>
								  				<th scope="col">Quantity</th>
								  				<th scope="col">Unit Price</th>
								  				<th scope="col">Item Status</th>
								  				<th scope="col"></th>
								  				<th scope="col"></th>
											</tr>
							  			</thead>
							  			<tbody>';
									while ($row = $result->fetch_assoc()) {
										$pID = $row["Product_ID"];
										$imageURL = 'uploads/'.$row["P_image"];
										$pName = $row["P_name"];
										$pQuantity = $row["P_quantity"];
										$uPrice = $row["P_unitprice"];
										$iStatus = $row["P_itemstatus"];

										echo '<form action="" method="POST">
										<tr class="danger"> 
										<td></td>
								        <td><img class="img-responsive" width="150px" height="100px" src="' . $imageURL .'" alt="" /></td> 
								        <td>'.$pName.'</td> 
								        <td>'.$pQuantity.'</td>
								        <td>'.$uPrice.'</td>
								        <td>'.$iStatus.'</td>
								        <td><button type="submit" class="btn btn-warning" name="view">View</button>
								        <input type="hidden" name="hpid" value="'.$pID.'"></td>
							  			<td><button type="submit" class="btn btn-danger" name="delete">Delete</button></td>
							  			</form>
								      </tr>';
						  			}	
						  		}else {
									echo "<br><h3 align='center'>All Products In Stock</h3>";
								}
					  		}
						  	echo '</tbody>';
						 echo'</table>';
    				}
    				else {
						echo "<h3 align='center'>Please Select Product</h3>";
					}	
		?>
		<?php
			if(isset($_POST['view'])){

				$_SESSION["pid"] = $_POST['hpid'];
				header("Location:updateinfoProduct.php");
				//header("Refresh:0; url=adminupdateinfoRequester.php");
				
			}

			if(isset($_POST['delete'])){
				$key = $_POST['hpid'];

				$qupdate = mysqli_query($con,"DELETE FROM `tbl_product` WHERE Product_ID = '$key'") or die("Action not successful".mysql_error());

				//$qdelete2 = mysqli_query($con,"DELETE FROM `tblrequest` WHERE nic = '$key'") or die("Action not successful".mysql_error());

				//$qdelete2 = mysqli_query($con,"DELETE FROM `tblrequestnotification` WHERE Req_NIC = '$key'") or die("Action not successful".mysql_error());

				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
			}

			?>		
		</br></br></br></br></br></br></br></br></br></br>
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
