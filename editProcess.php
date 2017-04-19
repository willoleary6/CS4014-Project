<?php
    //Written by Bernard Steemers
	include 'dbh.php';
	include 'cookieCheck.php';
	//Variables taking in the values posted to them
	$new_First_Name = 	strip_tags($_POST['EditFN']);
	$new_Last_Name = 	strip_tags($_POST['EditLN']);
	$new_Student_Staff_Id =		strip_tags($_POST['EditSTID']);
	$new_Email = 		strip_tags($_POST['EditEmail']);
	$new_Password = 	strip_tags($_POST['EditPassword']);	
	$email = $_COOKIE['email'];
	$password = $_COOKIE['password'];
	$userID = $_COOKIE['userID'];
	// SQL updating the users info from the form they entered
	$sql = "UPDATE user_details SET first_name= '$new_First_Name', last_name = '$new_Last_Name',
	student_staff_id = '$new_Student_Staff_Id', email = '$new_Email', password = '$new_Password' 
	WHERE user_id = '$userID'";
	// if the query worked succesfully then the user will be logged out
	if($result = mysqli_query($connect,$sql)) {
		header("location: logout.php");
	}else {
		echo '<script type="text/javascript">alert("Error: Unable to update details.")</script>';
		header("location: EditDetails.php");
	}
	
?>