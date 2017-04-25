<?php
	// set the expiration date to one hour ago
	setcookie("email", "", time() - 3600);
	
	if (isset($_GET['NotActive'])) { 
		header("location: index.php?NotActive");
	}
	else {
		header("location: index.php");
	}
?>