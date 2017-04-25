<?php
    //Written by Bernard Steemers and Aaron Dunne
	include 'dbh.php';
	include 'cookieCheck.php';
	//Variables taking in the values posted to them
	$new_First_Name = 	mysqli_real_escape_string($connect,strip_tags($_POST['EditFN']));
	$new_Last_Name = 	mysqli_real_escape_string($connect,strip_tags($_POST['EditLN']));
	$new_Student_Staff_Id =		mysqli_real_escape_string($connect,strip_tags($_POST['EditSTID']));
	$new_Email = 		mysqli_real_escape_string($connect,strip_tags($_POST['EditEmail']));
	$new_Password = 	mysqli_real_escape_string($connect,strip_tags($_POST['EditPassword']));	
	$new_field = mysqli_real_escape_string($connect,strip_tags($_POST['browser']));	
	$email = $_COOKIE['email'];
	$userID = $_COOKIE['userID'];
	$allowed = array('studentmail.ul.ie', 'ul.ie');
	
	$sql = "SELECT password FROM user_details WHERE email ='$email'";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_row($result);
	$password = $row[0];
			
	if (filter_var($new_Email, FILTER_VALIDATE_EMAIL)) {
	    $explodedEmail = explode('@', $new_Email);
		$domain = array_pop($explodedEmail);
		// If email provided has a domain that is not in the array
		if (!in_array($domain, $allowed)) {
			header('location: editDetails.php?EmailFail=True');
		}else{
			$sql = "SELECT email FROM user_details WHERE email ='$new_Email'";
			$result = mysqli_query($connect,$sql);
			$row = mysqli_fetch_row($result);
			if($row && !($new_Email == $email)) {
				header('location: editDetails.php?EmailInUse=true');
			}else {
				// SQL statement to find out what the id of the major subject the user has chosen 
				$sql = "SELECT `subject_id` FROM `major_subjects` WHERE `subject_name` = '$new_field'";
				$result = mysqli_query($connect,$sql);
				$field  = mysqli_fetch_array($result);
				if(!$field) {
					header('location: editDetails.php?FieldFail=true');
				}else {
					$options = array('cost' => 10); 
					if (password_needs_rehash($new_Password, PASSWORD_BCRYPT, $options)) {
						// New password is encrpyted before being stored in the database
						$new_Password = password_hash($new_Password, PASSWORD_BCRYPT, $options);
						
						$sql = "UPDATE user_details SET first_name= '$new_First_Name', last_name = '$new_Last_Name', student_staff_id = '$new_Student_Staff_Id', 
						email = '$new_Email', password = '$new_Password', subject_id = '$field[0]' WHERE user_id = '$userID'";

						if($result = mysqli_query($connect,$sql)) {
							$sql = "SELECT * FROM `user_details` WHERE email = '$new_Email'";
							$result = mysqli_query($connect,$sql);
							if(!$row = mysqli_fetch_assoc($result)) {
								header("location: editDetails.php");
							}else{
								
								// Setting cookies in the users browser to so that they may automatically login in the future
								setcookie('email',$new_Email ,time() + (86400 * 30));
								// Cookie expires after a month
								setcookie('password',$new_Password ,time() + (86400 * 30));
								setcookie('RepScore',$row['reputation_score'],time() + (86400 * 30));
								// Directs user to there profile;
								header("location: logout.php");
						     
							}
						}
					}
				}
			} 
		}
	} 
?>