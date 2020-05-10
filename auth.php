<?php
if (!isset($_SESSION['first_name']) || !isset($_SESSION['last_name']) ) {
	$_SESSION['goto'] = basename($_SERVER['PHP_SELF']);
	if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
		$_SESSION['goto'] .= '?'.$_SERVER['QUERY_STRING'];	
	}
	
	header("Location: sign_in.php");
}
?>