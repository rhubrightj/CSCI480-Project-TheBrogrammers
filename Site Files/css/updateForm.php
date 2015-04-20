<?php 
session_start();
include 'includes/head.php';
include 'includes/header.php';

// gets the passed variable $edit and stores it into $id 
$id = $_GET['edit'];    

//-------------connect to the database-------------
$servername = 'mysql.objectsofdesirefindlay.com';
$user       = 'jasrhu2';
$password   = 'QRcodes21';
$dbname     = 'qrusers';

$conn = new mysqli($servername, $user, $password, $dbname) or die("Unable to connect to the database");    

$query = "SELECT * 
		  FROM	 products 
		  WHERE	 productID='$id'";

if ($productRecords = $conn->query($query)){
	$productArray = $productRecords->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
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
			
			<center><h2>Edit Item</h2></center>
			
			<!-- product info form -->
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2" style="margin-bottom:10px">
					<form class="form-horizontal" action="update.php" method="POST" enctype="multipart/form-data" id="addItem"/>
						<input id="id" name="productID" type="hidden" value="<?php echo $productArray['productID']?>" class="form-control">
						<div class="form-group">
							<label for="title">Title:</label><input class="form-control" type="text" id="title" name="title" value="<?php echo $productArray['title']?>"/>
						</div>
						<div class="form-group">
							<label for="price">Price:  </label><br><input class="form-control" id="price" type="text" name="price" value="<?php echo $productArray['price']?>"/>
						</div>
						<div class="form-group">
							<label for="short" >Short Description: </label>
							<textarea class="form-control" id="short" class="" cols="40" rows="3" name="short" form="addItem"><?php echo $productArray['shortDesc']?></textarea>
						</div>
						<div class="form-group">
							<label for="detailed" >Detailed Description: </label>
							<textarea class="form-control" id="detailed" cols="40" rows="5" name="detailed" form="addItem"><?php echo $productArray['longDesc']?></textarea>
						</div>
						<div class="form-group">
							<label for="qr">QR Code Title:</label><input class="form-control" id="qr" type="text" name="qrtitle" value="<?php echo $productArray['qrCodePath']?>"/>
						</div>
						<div class="form-group">
							<input style="margin:20px; margin-left:0px" type="file" name="fileToUpload" id="fileToUpload">
						</div>
						<div class="form-group">
							<label for="itemTag">Tag Name:</label><input class="form-control" type="text" id="itemTag" name="itemTag" value="<?php echo $productArray['itemTag']?>"/>
						</div>
						<div class="form-group">
							<input class="btn btn-info pull-left" type="submit" value="Update">
						</div>
					</form>	
				</div>
			</div>	
		</div>
	</div>
</div>

<?php include 'includes/footer.php';?>