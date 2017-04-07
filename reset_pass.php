<?php
	require 'dbh.php';

<<<<<<< HEAD
		$newpass = $_POST['newpass'];
		$newpass1 = $_POST['newpass1'];
		$post_email = $_POST['email'];
		$code = $_GET['code'];

	// If passwords given match
	if($newpass == $newpass1) {
		$enc_pass = md5($newpass);
=======
	$newpass = $_POST['newpass'];
	$newpass1 = $_POST['newpass1'];
	$post_email = $_POST['email'];
	$code = $_GET['code'];

	// If passwords given match
	if($newpass == $newpass1) {
		$encrypt_pass = md5($newpass);
>>>>>>> 2b5039df02694994416d3de70eb670114dab3b29
		
		// Updates account with new password in the database
		$sql = "UPDATE user_details SET password='$newpass' WHERE email='$post_email'";
		mysqli_query($connect,$sql);
		
		// Resets password_reset to 0 on account of changed password
		$sql = "UPDATE user_details SET password_reset='0' WHERE email='$post_email'";
		mysqli_query($connect,$sql);
		
		// Returns to the login page
<<<<<<< HEAD
		echo "Your password has been successfully updated.<p>To return to the login page, <a href='index.php'>Click here</a>";
	
=======
		echo "Your password has been successfully updated.<p>To return to the login page, <a href='index.php'>Click here</a>"
>>>>>>> 2b5039df02694994416d3de70eb670114dab3b29
	}
	else {
		echo "Passwords do not match. <a href='recover.php?code=$code&email=$post_email'>Click here to return and try again.</a>";
	}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 2b5039df02694994416d3de70eb670114dab3b29
