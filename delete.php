<?php
    //Written by Bernard Steemers
	include 'dbh.php';
	include 'cookieCheck.php';
	
	$email = $_COOKIE['email'];
	$password = $_COOKIE['password'];
	$userID = $_COOKIE['userID'];
	
	
	$sql = "DELETE * FROM user_details Where user_id = '$userID'";
 	if(mysqli_query($connect, $sql))
 	{
 		echo "Records were deleted successfully.";
 	}
 	
	//$ql = "DELETE * FROM tasks Where user_id = '$user_id'";
  	//$deleteTasks = mysqli_query($connect, $sql);
?>