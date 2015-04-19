<?php
//-------------connect to the database-------------
$servername = 'mysql.objectsofdesirefindlay.com';
$user       = 'jasrhu2';
$password   = 'QRcodes21';
$dbname     = 'qrusers';

$conn = new mysqli($servername, $user, $password, $dbname) or die("Unable to connect to the database");
	

$page 		=	isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage	= 	isset($_GET['per-page']) && $_GET['per-page'] <= 100 ? (int)$_GET['per-page'] : 10;

//Positioning
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

//Query
$sql = "SELECT * FROM products ORDER BY title";


/*$sql = "SELECT  SQL_CALC_FOUND_ROWS productID, title 
		FROM	products
		ORDER BY title
		LIMIT	{$start}, {$perPage}";*/


$result = $conn->query($sql);

//$pages = ceil($result/$perPage);
/*if($result->num_rows > 0){
$result->fetch_assoc();
}
else{
	echo "0 results";
}*/

//This displays the title, price, and description
/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         echo " Title: " . $row["title"]."<br>",  " Price: " . $row["price"]."<br>",  " Description: " . $row["shortDesc"]. "<br>", "Long Description" . $row["longDesc"]. "<br>";
		 echo "<br>";
   }
	
} else {
    echo "0 results";
}
*/

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
			<a class='btn btn-small btn-default pull-right' href='loginPage.php'>Admin</a>
		</div>
	</nav>
	
	<div id="main">
		<div class="container">
			
			<h2>Welcome</h2>
			
			<!-- product info form -->
			<div class="row">
				<div class="col-xs-12" style="margin-bottom:10px">
					
					<?php foreach($result as $results): ?>
					<div class="result">
						<form class="form-inline" action="displayItem.php" method="GET" enctype="multipart/form-data" id="displayItem"/>
							<div class="table-responsive">
								<?php 
				
								echo '<table class="table table-striped">';
								echo '<tr>';
								echo "<td><a href=/displayItem.php?productID=" . $results['productID'] . '>' . $results['title'] .  "</a></td>";
								echo '</tr>';
								
								echo '</table>';
								?> 
							</div>
						</form>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="col-xs-4" style="margin-bottom:10px">
					
				</div>
			</div>	
		</div>
	<!----pagination page navigation bar--->
	<!---<nav>
 <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="index.php">1</a></li>
    <li><a href='index.php/'. $page . =2'>2</a></li>
    <li><a href="index.php/page=3">3</a></li>
    <li><a href="index.php/page=4">4</a></li>
    <li><a href="index.php/page=5">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>--->
	</div>

</div>
<?php include 'includes/footer.php';?>