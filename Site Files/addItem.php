<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
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


	<?php
	//-------------connect to the database-------------
	$servername = 'localhost';
	$user       = 'root';
	$password   = '';
	$dbname     = 'qrusers';

	$conn = new mysqli($servername, $user, $password, $dbname) or die("Unable to connect to the database");


	//--------------insert data--------------------
	$title     = $_POST["title"];
	$price     = $_POST["price"];
	$shortDesc = $_POST["short"];
	$longDesc  = $_POST["detailed"];

	// INSERT INTO products (title, price, shortDesc, longDesc) VALUES ("Product", 5.00, "Product description", "detailed description")"
	$sql = "INSERT INTO products (title, price, shortDesc, longDesc) 
			VALUES (" . "\"" . $title . "\", " . $price . ", \"" . $shortDesc . "\", \"" . $longDesc . "\")";

	if (mysqli_query($conn, $sql)){
		// SQL query executed successfully
		echo "<p>New record created successfully</p>";
	} else {
		// SQL query fail
		echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
	}
	mysqli_close($conn); // close database connection



	//----------------------Upload the image to the uploads folder-------------------------
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	// Check if image file is actually an image or fake image
	if(isset($_POST["submit"])){
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false){
			echo "<p>File is an image - " . $check["mime"] . ".</p>";
			$uploadOk = 1;
		} else {
			echo "<p>File is not an image.</p>";
			$uploadOk = 0;
		}
	}
	
	// Check if file already exists
	if (file_exists($target_file)){
		echo "<p>Sorry, file already exists.</p>";
		$uploadOk = 0;
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000){
		echo "<p>Sorry, your file is too large.</p>";
		$uploadOk = 0;
	}
	
	// Limit the type of file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
		echo "<p>Sorry, only JPG, JPEG, and PNG files are allowed.</p>";
		$uploadOk = 0;
	}
	
	// Check if $uploadOk has been set to 0 by an error
	if ($uploadOk == 0){
		echo "<p>Sorry, your file was not uploaded.</p>";
	// if everything is ok, try to upload file
	} 
	else{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
			echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
		} else {
			echo "<p>Sorry, there was an error uploading your file.</p>";
		}
	}
	?>
	
	<a class="btn btn-default pull-left navbar-btn" href="add.php">Add Another Item</a>
	
</div>

<?php include 'includes/footer.php';?>