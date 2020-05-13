<?php
session_start();
$_SESSION['username'] = 'username';
$_SESSION['password'] = '';
$_SESSION['time'] = time();	
$_SESSION["user_id"] = 'user_id';

?>

<!DOCTYPE html>
<html>
<head>
<title>Art Thread</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta name="author" content="Gloriana Amador" />
<meta name="description" content="Art Interpretation" />
<meta name="keywords" content="Art, museums, digital" />
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>
<body>

<?php
include_once 'header.php';
require_once 'login.php';
require_once 'functions.php';
include_once 'auth.php';


$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['submit'])) {
	if (empty($_GET['name'])) {
		echo "<p>Please fill out all of the form fields!</p>";
	} else {
		$conn = new mysqli($hostname, $username, $password, $database);
		if ($conn->connect_error) die($conn->connect_error);
		$name = sanitizeMySQL($conn, $_GET['name']);
		$query = "SELECT * FROM user NATURAL JOIN collection NATURAL JOIN collection_item NATURAL JOIN art NATURAL JOIN content NATURAL JOIN asset WHERE `user_id`=" .$_SESSION["user_id"];
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$rows = $result->num_rows;
			if ($rows) {
				echo 
				"<h1>Results</h1>
				<table><tr>
				
				<th>art_id</th>
				<th>title</th>
				<th>artist_name</th>
				<th>date_created</th>
				<th>image_file</th>
				<th>theme</th>
				<th>content_file_name</th>
				
				</tr>";
				
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>"
					.$row["art_id"]."</td><td>"
					.$row["title"]."</td><td>"
					.$row["artist_name"]."</td><td>"
					.$row["date_created"]."</td><td>"
					.$row["theme"]."</td><td>"
					.$row["content_file_name"]."</td><td>"
					.$row["image_file"]."</td>";
					echo "</tr>";
				}
				echo "</table>";
			} else {
				echo "<p>Sorry, there are no results for this query!</p>";
			}
			echo "<h2>Search Again</h2>";
		}
	}
}
?>
<div style="height: 100px;"></div>

<!--View_coll Section-->
<div class="view_coll">
<div class="view_coll-text"><h1>See your collection</h1><h2>Expand the knowledge about your favorite artists in your personalized collections.</h2></div>
</div>

<!--View Colle Form-->
<div class="view_coll-form">
<form method="get" action="viewcolle.php">
	<fieldset>
		<legend>My Collection</legend>
		<input type="text" name="name" required><br> 
		<input type="submit" name="submit">
	</fieldset>
</form>
</div>

<div class="clear"></div>

<?php include_once ('footer.php');?>

</body>
</html>
