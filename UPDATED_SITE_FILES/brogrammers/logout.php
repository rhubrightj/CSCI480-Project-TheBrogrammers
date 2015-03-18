<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include 'includes/head.php';
include 'includes/header.php';

session_destroy();

?>
   
<div id="wrap">
		
		<div id="main">
			<div class="container">
				
				<h3>Dashboard</h3>
				
					
				<div class="row">
					<div class="col-md-12" style="margin-bottom:10px">
						<p>You have been logged out.</p>
					</div>
					<div class="col-md-12" style="margin-bottom:10px">
						<a href="index.php" class="btn btn-primary btn-lg btn-block btn-huge">Log In Again</a>
					</div>
					
				</div>	
			</div>
		</div>
	</div>

    <?php include 'includes/footer.php';?>