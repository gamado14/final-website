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

if (isset($_POST['submit'])) { 
	if ( empty($_POST['username']) || empty($_POST['password']) ) {
		echo "<p>Please fill out all of the form fields!</p>";
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);			
		$salt1 = "*kw&!h*";  
		$salt2 = "@pxg!@";  
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "SELECT first_name, last_name FROM users WHERE username='$username' AND password='$password'"; 
		$result = $conn->query($query);    
		if (!$result) die($conn->error); 
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];	
			header("Location: viewcolle.php"); 			
		} else {
			echo "<p>Oh no! The password or username is not valid. Try again.</p>";
		}
	}
}
?>

<fieldset style="width:30%"><legend>Sign in</legend>
<form method="POST" action="">
Username:<br><input type="text" name="username" size="40"><br>
Password:<br><input type="password" name="password" size="40"><br>
<input type="submit" name="submit" value="Submit">
</form>
</fieldset>

<?php include_once ('footer.php');?>

</body>
</html>