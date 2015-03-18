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
					
			</div>
		</nav>
		<div id="main">
			<div class="container">
				
				<h4>Dashboard</h4>
				
					
				<div class="row">
					<div class="col-xs-4" style="margin-bottom:10px">
					
					
					
					
					
						<form action="addItem.php" method="post" id="addItem"/>
							<p><label>Title:  </label><input type="text" name="title"/></p>
							<p><label>Price:  </label><input type="text" name="price"/></p>
							<p><label>Short Description: </label>
							<textarea id="short" class="" cols="30" rows="2" name="short" form="addItem"></textarea></p>
							<p><label>Detailed Description: </label>
							<textarea id="detailed" class="" cols="30" rows="2" name="detailed" form="addItem"></textarea></p>
						</form>	
						 <form class="form-inline" action="upload.php" method="post" enctype="multipart/form-data">
							Image:<input type="file" name="fileToUpload" id="fileToUpload">	
							<input type="submit" value="Upload Image" name="submit">
							
							
							
							
							
							
						</form>
					</div>
					<div class="col-xs-4" style="margin-bottom:10px">
						
					</div>
				</div>	
			</div>
		</div>
	</div>

    <?php include 'includes/footer.php';?>




