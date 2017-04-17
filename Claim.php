<?php
	include 'dbh.php';
	$id = $_POST['claim'];
	$sql = "SELECT * from tasks WHERE task_id = $id";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
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