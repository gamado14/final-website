<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign in</title>
</head>
<body>

<?php
require_once 'login.php';
require_once 'functions.php';
include_once 'header.php';
?>

<?php
if (isset($_POST['submit'])) { 
	if ( empty($_POST['username']) || empty($_POST['password']) ) {
		$message = '<p class="error">These form is incmplete. Please, try again filling out all of the form fields.</p>';
	} else {
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
		$username = sanitizeMySQL($conn, $_POST['username']);
		$password = sanitizeMySQL($conn, $_POST['password']);			
		$salt1 = "*tm&h*";  
		$salt2 = "#pxg!@";  
		$password = hash('ripemd128', $salt1.$password.$salt2);
		$query  = "SELECT first_name, last_name FROM users WHERE username='$username' AND password='$password'"; 
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
			$message = '<p class="error">Oh no! It seems that the username or password combination is invalid! Please, try again.</p>';
			if (isset($message)) echo $message;
		}
	}
}
?>

<fieldset style="width:30%"><legend>Log-in</legend>
<form method="POST" action="">
Username:<br><input type="text" name="username" size="40"><br>
Password:<br><input type="password" name="password" size="40"><br>
<input type="submit" name="submit" value="Log-In">
</form>
</fieldset>

<?php include_once 'footer.php'; ?>

</body>
</html>