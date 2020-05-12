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
<?php include_once 'header.php';?>


<div class="clear"></div>

<div class="welcome">
<div class="welcome-text"><h1>Welcome to Art Thread!</h1><h2>Go to your collection or explore some art.</h2></div>
<div class="welcome-image"><img src="images/img-welcome.jpg" alt="img-welcome"/></div>
</div>

<div class="clear"></div>

<?php include_once ('footer.php');?>

</body>
</html>
