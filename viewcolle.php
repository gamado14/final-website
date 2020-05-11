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
include_once 'includes/header.php';
require_once 'includes/login.php';
require_once 'includes/functions.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['id'])) {
	$id = sanitizeMySQL($conn, $_GET['id']);
	$query = "SELECT * FROM collection, collection_item WHERE `user_id`= $_SESSION["user_id"]";
	$result = $conn->query($query);
	if (!$result) die ("The id is invalid. Please try again.");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo "Sorry, there are no results for this user $id<br>";
	} else {
		while ($row = $result->fetch_assoc()) {
			echo '<h1>My Collection</h1>';
			echo '<p>'.$row["collection_name"]'</p>'; 
			echo $row["art_id"];			
		}
	}
	echo "<p><a href=\"search.php\">Explore Art and Themes</a></p>";
} else {
	echo "No artwork was found with the id";
}

include_once 'footer.php';
?>

</body>
</html>
