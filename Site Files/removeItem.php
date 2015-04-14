<?php 
session_start();
include 'includes/head.php';
include 'includes/header.php';
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
			
	<h2>Remove Item</h2>
			
	<!-- product info form -->
	<div class="row">
	<div class="col-xs-4" style="margin-bottom:10px">	
<?php
	//-------------connect to the database-------------
	$servername = 'mysql.objectsofdesirefindlay.com';
	$user       = 'jasrhu2';
	$password   = 'QRcodes21';
	$dbname     = 'qrusers';;

	$conn = new mysqli($servername, $user, $password, $dbname) or die("Unable to connect to the database");

	$productID = $_GET["productID"];
	echo  "<br>" . $productID . "<br>";
	
	$sql	= '
			SELECT  title, price, shortDesc, longDesc, imagePath 
			FROM	products	
			WHERE	productID = ' .$_GET['productID']. '  '
	;
	
	
$result = $conn->query($sql);	


//This displays the title, price, and description
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<img class=\"img-responsive\" alt=\"Brand\" src=\"" . $row["imagePath"] . "\" width=\"100px\"> ";
		echo "<br>";
        echo " Title: " . $row["title"] . "<br>",  " Price: " . $row["price"] . "<br>",  " Description: " . $row["shortDesc"] . "<br>", "Long Description: " . $row["longDesc"] . "<br>", "Image: " . $row["imagePath"];
		echo "<a class='btn btn-small btn-danger' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>";
		echo "<br>";
		echo "--------------------------------------------------------------";
		echo "<br>";
   }
	
} else {
    echo "0 results";
}
	
	
	mysqli_close($conn); // close database connection

?>
					</div>
			</div>	
		</div>
	</div>
	<a class="btn btn-default pull-left navbar-btn" href="remove.php">Remove Another Item</a>
</div>

<?php include 'includes/footer.php';?>