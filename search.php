<?php
session_start();
require_once 'includes/auth.php';
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

if (isset($_GET['submit'])) {
	if (empty($_GET['name'])) {
		echo "<p>Please fill out all of the form fields!</p>";
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$name = sanitizeMySQL($conn, $_GET['name']);
		$query = "SELECT * FROM user NATURAL JOIN collection NATURAL JOIN collection_item NATURAL JOIN art NATURAL JOIN content NATURAL JOIN asset WHERE `user_id`= $_SESSION["user_id"]";
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
				<th>artist_name/th>
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

<!--Search Form-->
<form method="get" action="search.php">
	<fieldset>
		<legend>Explore Art & Themes</legend>
		<input type="text" name="name" required><br> 
		<input type="submit" name="submit">
	</fieldset>
</form>
</body>
</html>