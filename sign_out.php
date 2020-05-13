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
include_once 'header.php';
?>
<div style="height: 100px;"></div>


<!--thanks Section-->
<div class="thanks">
<div class="thanks-text"><h1>We hope to see you again!</h1><h2>You are now logged out.</h2></div>
<div class="thanks-image"><img src="images/img-thanks.jpg" alt="img-thanks"/></div>
</div>

<div class="clear"></div>
<?php
include_once 'footer.php';
?>
</body>
</html>
