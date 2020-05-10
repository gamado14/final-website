<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Homepage Art Thread</title>
<link href="art_thread.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>
</head>
<body>

<?php
require_once 'auth.php';
include_once 'header.php';
require_once 'login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM art";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

echo 
"<table>
<tr> 
<th>art_id</th> 
<th>title</th>
<th>artist_name</th>
<th>date_created</th>
<th>image_file</th>
</tr>";

while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	echo "<td>".$row["art_id"]."</td><td>";
	echo "<td>".$row["title"]."</td><td>";
	echo "<td>".$row["artist_name"]."</td><td>";
	echo "<td>".$row["date_created"]."</td><td>";
	echo "<td>".$row["image_file"]."</td><td>";		
	echo '</tr>';
}
echo "</table>";

echo "<a href=\"viewcolle.php\">View My Collection</a>";
echo "<a href=\"search.php\">Explore Art and Themes</a>";

include_once 'footer.php';
?>

</body>
</html>
