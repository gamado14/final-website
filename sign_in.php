<?php
session_start();
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

if (isset($_POST['submit'])) { //check if the form has been submitted
	if ( empty($_POST['username']) || empty($_POST['password']) ) {
		echo "<p>Please fill out all of the form fields!</p>";
	} else {
		$conn = new mysqli($hostname, $username, $password, $database);
		if ($conn->connect_error) die($conn->connect_error);
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);			
		$query  = "SELECT first_name, last_name FROM user WHERE username='$username' AND password='$password'"; 
		$result = $conn->query($query);    
		if (!$result) die($conn->error); 
		$rows = $result->num_rows;
		if ($rows==1) {
			$row = $result->fetch_assoc();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];	
			$goto = empty($_SESSION['goto']) ? 'index.php' : $_SESSION['goto'];			
			header('Location: ' . $goto);
			exit;		
		} else {
			echo "<p>Invalid username/password combination!</p>";
		}
	}
}
?>

<!--Sign_in Section-->
<div class="sign_in">
<div class="sign_in-text"><h1>Learn more about art</h1><h2>Explore your collections and favorite artists!</h2></div>
</div>

<fieldset style="width:30%"><legend>Sign in</legend>
<form method="POST" action="sign_in.php">
Username:<br><input type="text" name="username" size="40"><br>
Password:<br><input type="password" name="password" size="40"><br>
<input type="submit" name="submit" value="Submit">
</form>
</fieldset>

<?php include_once ('footer.php');?>

</body>
</html>
