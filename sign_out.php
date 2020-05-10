<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign out</title>
</head>
<body>

<?php
$_SESSION = array();
session_destroy();
include_once 'header.php';
echo "<p>You are now logged out.</p>";
echo "<p><a href=\"index.php\">Return to homepage</a></p>";
include_once 'footer.php';
?>

</body>
</html>
