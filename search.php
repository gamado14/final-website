<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Explore Art and Themes</title>
</head>
<body>

<?php
require_once 'auth.php';
require_once 'login.php';
require_once 'functions.php';

if (isset($_GET['submit'])) {
	if (empty($_GET['name'])) {
		echo "<p>Please fill out all of the form fields!</p>";
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$name = sanitizeMySQL($conn, $_GET['name']);
		$query = "SELECT * FROM user NATURAL JOIN collection NATURAL JOIN collection_item NATURAL JOIN art NATURAL JOIN content NATURAL JOIN asset WHERE user_id=1";
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
<form method="get" action="search.php">
	<fieldset>
		<legend>Search for Art and Themes</legend>
		<label for="name">Art:</label>
		<input type="text" name="name" required><br> 
		<input type="submit" name="submit">
	</fieldset>
</form>

<?php include_once 'footer.php'; ?>

</body>
</html>