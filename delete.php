<?php
    //Written by Bernard Steemers
	include 'dbh.php';
	include 'cookieCheck.php';
	$userID = mysqli_real_escape_string($connect,strip_tags($_COOKIE['userID']));
	
	// Clear all user data 
	
	$sql = "UPDATE taskStatus a
			JOIN task_claims b
			ON a.claim_id = b.claim_id
			SET a.status_id = 6
			WHERE b.user_id = '$userID';

	      UPDATE task_claims b
			JOIN taskStatus a
			ON a.claim_id = b.claim_id
			SET b.user_id = 2
			WHERE b.user_id = '$userID';

              UPDATE taskStatus a
			JOIN task_claims b
			ON a.claim_id = b.claim_id
			JOIN tasks c
			ON b.task_id = c.task_id
			SET a.status_id = 7
			WHERE c.user_id = '$userID';

	       UPDATE task_claims b
			JOIN taskStatus a
			ON a.claim_id = b.claim_id
			JOIN tasks c
			ON b.task_id = c.task_id
			SET c.user_id = 2
			WHERE c.user_id = '$userID';
               
                DELETE FROM user_details
			WHERE user_id = '$userID'";
 	echo "$userID";
	if(mysqli_query($connect, $sql))
 	{
 		header("location:logout.php");
 	}
 	else
 	{
		header("location:userProfile.php");
 	}
	
?>