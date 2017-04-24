<?php 
	include 'dbh.php';
	$identifier = $_POST['value'];
	$user_id = $_POST['id'];
	$sql = "SELECT * from user_details WHERE user_id = $user_id";
	$result = mysqli_query($connect,$sql);
	$claimaint = mysqli_fetch_assoc($result);
	if($identifier == 1){
		$score = $claimaint['reputation_score'] + 5;
		$sql = "UPDATE user_details SET reputation_score = $score WHERE user_id = $user_id";
		$result = mysqli_query($connect,$sql);
	}
	else if($identifier == 2){
		$score = $claimaint['reputation_score'] - 5;
		$sql = "UPDATE user_details SET reputation_score = $score WHERE user_id = $user_id";
		$result = mysqli_query($connect,$sql);
	}
	header("location: userProfile.php");