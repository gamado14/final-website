<?php
session_start();
$_SESSION['username'] = 'username';
$_SESSION['password'] = '';
$_SESSION['time'] = time();

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


if (isset($_GET['submit'])) {
	if (empty($_GET['artist_name'])) {
		echo "<p>To start exploring some art, you need to fill out all of the form fields.</p>";
	} else {
		$conn = new mysqli($hostname, $username, $password, $database);
		if ($conn->connect_error) die($conn->connect_error);
		$artist_name = sanitizeMySQL($conn, $_GET['artist_name']);
		$query = "SELECT * FROM art WHERE artist_name LIKE '%$artist_name%'";
		$result = $conn->query($query);
		if (!$result) {
			die ("Database access failed: " . $conn->error);
		} else {
			$rows = $result->num_rows;
			if ($rows) {
				echo "<h1>My results</h1><table><tr><th>art_id</th><th>title</th><th>artist_name</th><th>date_created</th><th>image_file</th></tr>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>".$row["art_id"]."</td><td>".$row["title"]."</td><td>".$row["artist_name"]."</td><td>".$row["date_created"]."</td><td>".$row["image_file"]."</td>";
					echo "</tr>";
				}
				echo "</table>";
			} else {
				echo "<p>No results!</p>";
			}
			echo "<h2>Search Again</h2>";
		}
	}
}
?>
<div style="height: 100px;"></div>

<!--Search Section-->
<div class="search">
<div class="search-text"><h1>Explore some art</h1><h2>To found out more about your favorite artists just type in a name.</h2></div>
</div>

<!--Search Form-->
<div class="search-form">
<form method="get" action="search.php">
	<fieldset>
		<legend>Explore Art & Themes</legend>
		<input type="text" name="artist_name" required><br> 
		<input type="submit" name="submit">
	</fieldset>
</form>
</div>

<div class="clear"></div>
<?php include_once ('footer.php');?>

</body>
</html>
