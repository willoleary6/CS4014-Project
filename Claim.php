<?php
	include 'dbh.php';
	$id = $_POST['claim'];
	$sql = "SELECT * from user_details WHERE email = '".$_COOKIE['email']."'";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	$score = $row['reputation_score'] + 10;
	$sql = "UPDATE user_details SET reputation_score = $score WHERE email ='".$_COOKIE['email']."'";
	$result = mysqli_query($connect,$sql);
	$user_id = $row['user_id'];
	$sql = "SELECT * from task_claims WHERE task_id = $id";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	$sql = "UPDATE task_claims SET user_id = $user_id WHERE task_id ='".$row['task_id']."'";
	$result = mysqli_query($connect,$sql);
	$sql = "UPDATE taskStatus SET status_id = '2' WHERE claim_id = '".$row['claim_id']."'";
	$result = mysqli_query($connect,$sql);
	header("location: userProfile.php");
?>