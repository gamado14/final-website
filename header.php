<!DOCTYPE html>
<html>
<head>
<title>Art Thread</title>
<link rel="stylesheet" type="text/css" href="art_thread.css" />
</head>
<body>
<header>
	<a href="index.php"><img src="images/logo-art-thread.png" width="70" height="70"></a>
	<h1>Art Thread</h1>
	<?php
	if (isset($_SESSION['first_name']) && isset($_SESSION['last_name']) ) {
		echo "<h3>Welcome, ".$_SESSION['first_name']." ".$_SESSION['last_name'];
		echo " | <small><a href=\"sign_out.php\">Logout</a></small></h3>";
	}
	?>
</header>
<div id="body">
