<?php
	include 'dbh.php';
	
	$first_name = 	strip_tags($_POST['EditFN']);
	$last_name = 	strip_tags($_POST['EditLN']);
	$student_staff_id =		strip_tags($_POST['EditSTID']);
	$email = 		strip_tags($_POST['EditEmail']);
	$password = 	strip_tags($_POST['EditPassword']);	
	
	include 'cookieCheck.php';
	
	$email = $_COOKIE['email'];
	$password = $_COOKIE['password'];
	$sql = "SELECT user_id FROM `user_details` WHERE email = '$email' AND password = '$password'";
	$result = mysqli_query($connect,$sql);
	if(!$row = mysqli_fetch_array($result))
	{
        echo 'couldnt get user id';
	}else
	{
			$userID = $row[0]; 
			echo $userID;
							
			$sql = "UPDATE user_details SET first_name='$first_name',last_name = '$last_name',student_staff_id = '$student_staff_id',email = '$email',password = '$password' WHERE user_id = '$userID'";
											
			//$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
											
			$result = mysqli_query($connect,$sql);
			echo 'success';
	}
	
?>