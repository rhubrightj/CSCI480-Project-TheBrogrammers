<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include 'includes/head.php';
include 'includes/header.php';?>
	<div id="wrap">
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
		<div id="main">
			<div class="container">
				
				<h4>Dashboard</h4>
				
					
				<div class="row">
					<div class="col-md-3" style="margin-bottom:10px">
						<a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Add Item</a>
					</div>
					<div class="col-md-3" style="margin-bottom:10px">
						<a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Remove Item</a>
					</div>
					<div class="col-md-3" style="margin-bottom:10px">
						<a href="#" class="btn btn-primary btn-lg btn-block btn-huge">Edit Item</a>
					</div>
				</div>	
			</div>
		</div>
	</div>

    <?php include 'includes/footer.php';?>




