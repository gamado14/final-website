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
?>

<?php
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM user WHERE `user_id`= $_SESSION["user_id"]";

$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;


<div style="height: 100px;"></div>

//Welcome Section
echo <div class="welcome">
echo <div class="welcome"><h1>echo "Welcome to Art thread ".$row ["username"] "!"</h1><h2>"Go to your collection or explore some art."</h2></div>
echo <div class="welcome"><img src="images/img-welcome.jpg" alt="img-welcome"/></div>;
echo </div>;

echo <div class="clear"></div>;
?>

<?php
echo "<a href=\"search.php\">Explore art and themes</a>";
echo "<a href=\"viewcoll.php\">My collection</a>";
echo "<a href=\"sign_out.php\">Sign out</a>";
?>

<?php
include_once ('footer.php');
?>
</body>
</html>