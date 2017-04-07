<?php
	require 'dbh.php';

		$newpass = $_POST['newpass'];
		$newpass1 = $_POST['newpass1'];
		$post_email = $_POST['email'];
		$code = $_GET['code'];

	// If passwords given match
	if($newpass == $newpass1) {
		$enc_pass = md5($newpass);
		
		// Updates account with new password in the database
		$sql = "UPDATE user_details SET password='$newpass' WHERE email='$post_email'";
		mysqli_query($connect,$sql);
		
		// Resets password_reset to 0 on account of changed password
		$sql = "UPDATE user_details SET password_reset='0' WHERE email='$post_email'";
		mysqli_query($connect,$sql);
		
		// Returns to the login page
		echo "Your password has been successfully updated.<p>To return to the login page, <a href='index.php'>Click here</a>";
	
	}
	else {
		echo "Passwords do not match. <a href='recover.php?code=$code&email=$post_email'>Click here to return and try again.</a>";
	}
?>
