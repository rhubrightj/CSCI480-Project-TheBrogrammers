<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include 'includes/head.php';
include 'includes/header.php';
?>

<div id="wrap">
	<!-- header logo and buttons -->
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">
					<img class="img-responsive" alt="Brand" src="./images/logo.jpg" width="100px">
				</a>
			</div>
			<a class="btn btn-default pull-left navbar-btn" href="./dashboard.php">Dashboard</a>
			<a class="btn btn-default pull-right navbar-btn" href="./logout.php">Log Out</a>
		</div>
	</nav>
	
	<div id="main">
		<div class="container">
			<!-- product info form -->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
					<?php
					//-------------connect to the database-------------
					$servername = 'mysql.objectsofdesirefindlay.com';
					$user       = 'jasrhu2';
					$password   = 'QRcodes21';
					$dbname     = 'qrusers';

					$conn = new mysqli($servername, $user, $password, $dbname) or die("Unable to connect to the database");
					
					//-------------delete record-----------------------
					if (isset($_GET['del'])) {
						$id       = $_GET['del'];
						$imageSql = "SELECT imagePath, qrCodePath
									 FROM 	products
									 WHERE 	productID = " . $id;
						$sql      = "DELETE FROM products
									 WHERE 	productID = " . $id;
					}
					
					// remove image & QR code from server.
					$query = mysqli_query($conn, $imageSql);
					if ($query){
						$results = $query->fetch_assoc();
						$imagePath  = $results['imagePath'];
						$qrCodePath = $results['qrCodePath'];
						unlink($imagePath);
						unlink($qrCodePath);
						
						// remove product from database.
						if (mysqli_query($conn, $sql)){
							echo '<p class="success">Product Deleted Successfully.</p>';
						}
						else {
							// SQL query fail.
							echo "<p>ERROR: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
						}
					}
					else {
						echo "<p>ERROR: Image & QR Code path query failed.</p>";
					}
					$conn->close();
					?>
				</div>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3">
					<a class="btn btn-info pull-left navbar-btn" href="remove.php">Remove Another Item</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php';?>