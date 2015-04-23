<?php
session_start();
//-------------connect to the database-------------
$servername = 'mysql.objectsofdesirefindlay.com';
$user       = 'jasrhu2';
$password   = 'QRcodes21';
$dbname     = 'qrusers';

$conn = new mysqli($servername, $user, $password, $dbname) or die("Unable to connect to the database");
	

$page 		=	isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage	= 	isset($_GET['per-page']) && $_GET['per-page'] <= 10 ? (int)$_GET['per-page'] : 5;

//Positioning
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

//Query
$sql = "SELECT  SQL_CALC_FOUND_ROWS productID, title 
		FROM	products
		ORDER BY title
		LIMIT	{$start}, {$perPage}";

$result = $conn->query($sql);
$total = $conn->query("SELECT FOUND_ROWS() as total")->fetch_assoc()['total'];

$pages = ceil($total/$perPage);
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
			<a class="btn btn-default pull-left navbar-btn" href="./dashboard.php">Dashboard</a>
			<a class="btn btn-default pull-right navbar-btn" href="./logout.php">Log Out</a>
		</div>
	</nav>
	
	<div id="main">
		<div class="container">
			
			<h2>Remove Item</h2>
			
			<!-- product info form -->
			<div class="row">
				<div class="col-xs-12" style="margin-bottom:10px">
					
					<?php foreach($result as $results): ?>
					<div class="result">
						<form class="form-inline" action="removeItem.php" method="GET" enctype="multipart/form-data" id="removeItem"/>
							<div class="table-responsive">
								<?php 
				
								echo '<table class="table table-striped">';
								echo '<tr>';
								echo "<td><a href=/removeItem.php?productID=" . $results['productID'] . '>' . $results['productID'] . ": "  . $results['title'] .  "</a></td>";
								echo"<td><a class='btn btn-small btn-danger pull-right' href='delete.php?del=$results[productID]'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
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
	<nav>
<div class="text-center">
 <ul class="pagination">
  <li>
     <!---Functionality to navigate pages--->
	<?php
	$firstPage    = 1;
	$currentPage   = (int)$_GET['page'] ;
	$previousPage  = $currentPage - 1;
	if($currentPage > $firstPage)

	?>
      <a href="?page=<?php echo $previousPage ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
 <?php for($x = 1; $x <= $pages; $x++): ?>
   
    <li><a href="?page=<?php echo $x?>&per-page=<?php echo $perPage; ?>"><?php echo $x?></a></li>
   
<?php endfor;?>
<li>
     <!---Functionality to navigate pages--->
	<?php
	$currentPage = (int)$_GET['page'];
	$nextPage    = $currentPage + 1;
	if($currentPage < $x) ?>
	
      <a href="?page=<?php echo $nextPage ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</div>
</nav>
	</div>
</div>

<?php include 'includes/footer.php';?>