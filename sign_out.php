<?php
session_start();
$_SESSION = array();
session_destroy();
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
echo "<p>Thank you. You are now logged out.</p>";
echo "<p><a href=\"index.php\">Return to homepage</a></p>";
include_once 'includes/footer.php';
?>
