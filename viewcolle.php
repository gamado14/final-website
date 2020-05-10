<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>My Collection</title>
</head>
<body>

<?php
require_once 'auth.php';
include_once 'header.php';
require_once 'login.php';
require_once 'functions.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query = "SELECT * FROM collection WHERE user_id=".$id;
	$result = $conn->query($query);
	if (!$result) die ("The id is invalid. Please try again.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "Sorry, there are no results for this user $id<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
			echo '<h1>Artwork Information</h1>';
			echo '<p>' "The artwork ".$row["Title"]." was made by ".$row["Artist"]." in ".$row["Date_created"]'</p>'; 
			echo '<h4>Image link:</h4>';
			echo $row["Image_file"];			
		}
	}
	echo "<p><a href=\"index.php\">Return to homepage</a></p>";
} else {
	echo "No artwork was found with the id";
}

include_once 'footer.php';
?>

</body>
</html>
