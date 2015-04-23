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
			<a class="btn btn-default pull-right navbar-btn" href="./logout.php">Log Out</a>
			<?php
				if ($_SESSION['username'])
					echo "<p class='navbar-text'>Welcome, " .$_SESSION['username']. "!</p>";
				else
					die ("You must be logged in!");
			?>
		</div>
	</nav>
	
	<!-- Dashboard Buttons -->
	<div id="main">
		<div class="container">

			<center><h4>Dashboard</h4></center>

			<div class="row">
				<div class="col-md-4 col-md-offset-4" style="margin-bottom:10px">
					<a href="add.php" class="btn btn-primary btn-lg btn-block btn-huge">Add Item</a>
				</div>
				<div class="col-md-4 col-md-offset-4" style="margin-bottom:10px">
					<a href="remove.php?page=1" class="btn btn-primary btn-lg btn-block btn-huge">Remove Item</a>
				</div>
				<div class="col-md-4 col-md-offset-4" style="margin-bottom:10px">
					<a href="update.php?page=1" class="btn btn-primary btn-lg btn-block btn-huge">Edit Item</a>
				</div>
			</div>	
		</div>
	</div>
</div>

<?php include 'includes/footer.php';?>