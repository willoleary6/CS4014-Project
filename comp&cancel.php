<?php
	include 'dbh.php';
	$identifier = $_POST['identifier'];
	$task_id = $_POST['task_id'];
	//id for completed task is 1
	if($identifier == "1")
	{
		$sql = "SELECT * from user_details WHERE email = '".$_COOKIE['email']."'";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$user_id = $row['user_id'];
		$sql = "SELECT * from task_claims WHERE task_id = $task_id";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$sql = "UPDATE task_claims SET user_id = $user_id WHERE task_id ='".$row['task_id']."'";
		$result = mysqli_query($connect,$sql);
		$sql = "UPDATE taskStatus SET status_id = '5' WHERE claim_id = '".$row['claim_id']."'";
		$result = mysqli_query($connect,$sql);
		header("location: userProfile.php");
	}
	else //id 2 is for canceled task
	{
		$sql = "SELECT * from user_details WHERE email = '".$_COOKIE['email']."'";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$score = $row['reputation_score'] - 15;
		$sql = "UPDATE user_details SET reputation_score = $score WHERE email ='".$_COOKIE['email']."'";
		$result = mysqli_query($connect,$sql);
		$user_id = $row['user_id'];
		$sql = "SELECT * from task_claims WHERE task_id = $task_id";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$sql = "UPDATE task_claims SET user_id = $user_id WHERE task_id ='".$row['task_id']."'";
		$result = mysqli_query($connect,$sql);
		$sql = "UPDATE taskStatus SET status_id = '6' WHERE claim_id = '".$row['claim_id']."'";
		$result = mysqli_query($connect,$sql);
		header("location: userProfile.php");
	}
?>