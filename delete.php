<?php
    //Written by Bernard Steemers
	include 'dbh.php';
	include 'cookieCheck.php';
	
	$email = $_COOKIE['email'];
	$password = $_COOKIE['password'];
	$userID = $_COOKIE['userID'];
	
	
	$sql = "UPDATE taskStatus a
			JOIN task_claims b
			ON a.claim_id = b.claim_id
			SET a.status_id = 6
			WHERE b.user_id = '$userID'";

	$sql = "UPDATE task_claims b
			JOIN taskStatus a
			ON a.claim_id = b.claim_id
			SET b.user_id = 2
			WHERE b.user_id = '$userID'";

	$sql = "UPDATE taskStatus a
			JOIN task_claims b
			ON a.claim_id = b.claim_id
			JOIN tasks c
			ON b.task_id = c.task_id
			SET a.status_id = 7
			WHERE c.user_id = '$userID'";

	$sql = "UPDATE task_claims b
			JOIN taskStatus a
			ON a.claim_id = b.claim_id
			JOIN tasks c
			ON b.task_id = c.task_id
			SET c.user_id = 2
			WHERE c.user_id = '$userID'";

	$sql =	"DELETE FROM user_details
			WHERE user_id = '$userID'";
 	if(mysqli_query($connect, $sql))
 	{
 		header("location:logout.php");
 	}
 	else
 	{
 		echo "Error Occured";
 	}
	
?>


