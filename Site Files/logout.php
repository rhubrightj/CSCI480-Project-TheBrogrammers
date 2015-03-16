<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include 'includes/head.php';
include 'includes/header.php';

session_destroy();

?>
    
	<h1>Logout</h1>
	<div class="container">
		<div class="row">
		  <p>You have been logged out.</p>
		  <p><a class="btn btn-success" href="./index.php">Login</a></p>
		</div>	
	</div>

    <?php include 'includes/footer.php';?>





