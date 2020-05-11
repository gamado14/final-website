<?php 
require_once 'login.php';

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);	
	
	$salt1 = "s*qm&h*";  
	$salt2 = "pxg!@";  
	$username = $_SERVER['PHP_AUTH_USER'];  
	$password = hash('ripemd128', $salt1.$_SERVER['PHP_AUTH_PW'].$salt2);
	$query  = "SELECT first_name, last_name FROM users WHERE username='$username' AND password='$password'"; 
	$result = $conn->query($query);    
	if (!$result) die($conn->error); 
	
	$rows = $result->num_rows;
	if ($rows==1) {
		$row = $result->fetch_assoc();
		echo "Hello ".$row['first_name']." ".$row['last_name'].", you are now logged in!";
	} else {
		die("Invalid username / password combination");
	}
} else {
	header('WWW-Authenticate: Basic realm="Restricted Section"');
	header('HTTP/1.0 401 Unauthorized');
	die ("Please enter your username and password");
}
?>
