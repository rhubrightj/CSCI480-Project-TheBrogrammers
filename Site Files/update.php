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
			
			<center><h2>Edit Item</h2></center>
			
			<?php
			//-------------connect to the database-------------
			$servername = 'mysql.objectsofdesirefindlay.com';
			$user       = 'jasrhu2';
			$password   = 'QRcodes21';
			$dbname     = 'qrusers';
			
			$conn = new mysqli($servername, $user, $password, $dbname) or die("Unable to connect to the database");

			
			//-------------------- Update Variables --------------------
			$productID  = $_POST['productID'];
			$title      = $_POST['title'];
			$price      = $_POST['price'];
			$shortDesc  = $_POST['short'];
			$longDesc   = $_POST['detailed'];
			$imageName  = $_FILES["fileToUpload"]["name"];
			$qrCodePath = $_POST['qrtitle'];
			$itemTag	= $_POST['itemTag'];
			//if a new image was not entered, query for old image path.
			if ($imageName){
				//new image selected
				$newImage = 1;
				$imagePath = "uploads/" . $imageName;
				echo "<p>NEWImagePath: " . $imagePath . "</p>";
			}
			else {
				//no new image, query for old imagePath
				$newImage = 0;
				$imgQuery = "SELECT imagePath
							 FROM	products
							 WHERE	title = '" . $title . "'";
				if ($imgResults = mysqli_query($conn, $imgQuery)){
					$imagePath  = $imgResults->fetch_assoc();
					$imagePath  = $imagePath['imagePath'];
					echo "<p>OLDImagePath: " . $imagePath . "</p>";
				}
				else {
					//imagePath query failed
					echo "<p>ERROR: SQL query for the imagePath failed.</p>";
				}
			}
			
			
			//----------------------- Upload the new image to the uploads folder ------------------------------------------
			$uploadOk = 1;
			// Do not need to perform upload if original image is used.
			if ($newImage){
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				
				// Check if image file is actually an image or fake image.
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
				
				// Check if file already exists.
				if (file_exists($target_file)){
					echo "<p>Sorry, file already exists.</p>";
					$uploadOk = 0;
				}
				
				// Check file size - unit is in bytes (5MB).
				if ($_FILES["fileToUpload"]["size"] > 5000000){
					echo "<p>Sorry, your file is above the 5MB limit.</p>";
					$uploadOk = 0;
				}
				
				// Limit the type of file formats.
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
					echo "<p>Sorry, only JPG, JPEG, and PNG files are allowed.</p>";
					$uploadOk = 0;
				}
				
				// Check if $uploadOk has been set to 0 by an error.
				if ($uploadOk == 0){
					echo "<p>Sorry, your file was not uploaded.</p>";
				} 
				// if everything is ok, try to upload file.
				else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
						echo "<p>The file " . basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded.</p>";
					} 
					else {
						echo "<p>Sorry, there was an error uploading your file.</p>";
					}
				}
			}
			
			
			//------------------------ Update the product with the new info -------------------------------
			$sqlUpdateRow = "UPDATE products SET title='$title', price='$price', shortDesc='$shortDesc',
									longDesc='$longDesc', imagePath='$imagePath', qrCodePath='$qrCodePath', itemTag='$itemTag'
							 WHERE 	productID='$productID'";
			
			// Execute sqlUpdateRow
			if (mysqli_query($conn, $sqlUpdateRow)){
				// SQL query executed successfully
				echo 'Total rows updated: ' . $conn->affected_rows;
			}
			else {
				// SQL query fail
				echo "<p>Error: " . $sqlUpdateRow . "<br>" . mysqli_error($conn) . "</p>";
			}
			
			
			//------------------- Redisplay all the products with the update info ---------------------
			$query = "SELECT * FROM products";
			
			//$eventRecords = mysql_query($query);
			?>    
			
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
					<th>Product Id</th>
					<th>Title</th>
					<th>Price</th>
					<th>Short Description</th>
					<th>Edit</th>
					</tr>
				
					<?php
						if ($productRecords = $conn->query($query)){
							while($productArray = $productRecords->fetch_assoc()){
								
								echo "<tr>";
								echo "<td>".$productArray['productID']."</td>";
								echo "<td>".$productArray['title']."</td>";
								echo "<td>".$productArray['price']."</td>";
								echo "<td>".$productArray['shortDesc']."</td>";
								echo "<td><a class='btn btn-warning btn-xs' href='updateForm.php?edit=$productArray[productID]'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
								
								echo "</tr>";

							}//end while
						}
						$productRecords->free();
						mysqli_close($conn); // close database connection
					?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php';?>