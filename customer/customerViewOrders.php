<?php
	include_Once('../config.php');
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
							<li><a href="Cart.php">Cart</a></li>
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
								<button type="Submit" class="btn btn-info"  name="submit">Search</button>
							</div>
						</div>
					</th>
					</tr></form>
				</table>

				<?php
    				if(isset($_POST['submit'])){

    					if(!empty($_POST['order_id']) ) {

    						$oderId = $_POST['order_id'];
    						echo searchOrder("AND Order_ID= '$oderId' ");
    					} 
    				}
    				else{
    					echo searchOrder("");
    				}
    				
					function searchOrder($condition){
						include('../config.php');
						$nics = $_SESSION["nic"];

			  			$sql = "SELECT tbl_order.Order_ID, tbl_order.O_CusNIC, tbl_order.O_note, tbl_order.O_totalprice,  tbl_order.O_date, tbl_order.O_status, tbl_order.O_pickupat FROM  tbl_order WHERE O_CusNIC = '$nics' $condition " ;
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
							  				<th scope="col">Date</th>
							  				<th scope="col">Order Status</th>
							  				<th scope="col">Pick Up At</th>
							  				<th scope="col"></th>
							  				<th scope="col"></th>
										</tr>
						  			</thead>
						  			<tbody>';
								while ($row = $result->fetch_assoc()) {
									$oID = $row["Order_ID"];
									$oNote = $row["O_note"];
									$oTPrice = $row["O_totalprice"];
									$oDate = $row["O_date"];
									$oStatus = $row["O_status"];
									$oPickup = $row["O_pickupat"];

									echo '<form action="" method="POST">
									<tr class="danger"> 
									<td></td><td></td>
							        <td>'.$oID.'</td> 
							        <td>'.$oNote.'</td>
							        <td>'.$oTPrice.'</td>
							        <td>'.$oDate.'</td>
							        <td>'.$oStatus.'</td>
							        <td>'.$oPickup.'</td>
							        <td><button type="submit" class="btn btn-warning" name="view">View</button>
							        <input type="hidden" name="hoid" value="'.$oID.'"></td>
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
		?>
		<?php
			if(isset($_POST['view'])){

				$_SESSION["oid"] = $_POST['hoid'];
				echo '<script type="text/javascript">
					window.location.href = "customerOrderItemView.php";</script>';
				//header("Refresh:0; url=adminupdateinfoRequester.php");
				
			}

			if(isset($_POST['delete'])){
				$key = $_POST['hoid'];

				$delete1 = mysqli_query($con,"DELETE FROM `tbl_order` WHERE Order_ID = '$key'") or die("Action not successful".mysql_error());
				$delete2 = mysqli_query($con,"DELETE FROM `tbl_order_product` WHERE tbl_order_product.OP_OrderID = '$key'") or die("Action not successful".mysql_error());


				echo "<meta http-equiv='refresh' content='0'>";
				header("Refresh:0");
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
