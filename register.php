<?php
    // written by William O'Leary and Aaron Dunne
	// calling the database handler which will handle statements back and forth
	include 'dbh.php';
	// recieving all the data posted from index.php
	$firstName = strip_tags($_POST['firstName']);
	$lastName = strip_tags($_POST['lastName']);
	$idNumber = strip_tags($_POST['idNumber']);
	$email = strip_tags($_POST['email']);
	$field = strip_tags($_POST['browser']);
	$password = strip_tags($_POST['password']);
	$cpassword= strip_tags($_POST['cpassword']);
	// Array of allowed email domains able to register to the site
	$allowed = array('studentmail.ul.ie', 'ul.ie');
    if (isset($_POST['email'])) {
	    // Variables and key provided by Google reCAPTCHA
		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$privatekey = "6LeHgBoUAAAAAEYgL4dRfvjA8OmTh3r5zqDV4j7b";
		$response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
		$data = json_decode($response);
	    // If captcha is pressed, tests email validation 
		if(isset($data->success) AND $data->success == true) {
			// Make sure the address is valid
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			    $explodedEmail = explode('@', $email);
				$domain = array_pop($explodedEmail);
		        // If email provided has a domain that is not in the array
				if ( ! in_array($domain, $allowed)) {
					header('location: index.php?EmailFail=True');
				}
				$sql = "SELECT email FROM user_details WHERE email ='$email'";
				$result = mysqli_query($connect,$sql);
				$row = mysqli_fetch_row($result);
				if($row) {
					header('location: index.php?EmailInUse=true');
				}else {
                    // SQL statement to find out what the id of the major subject the user has chosen 
					$sql = "SELECT `subject_id` FROM `major_subjects` WHERE `subject_name` = '$field'";
					$result = mysqli_query($connect,$sql);
					$field  = mysqli_fetch_array($result);
					if(!$field) {
						header('location: index.php?FieldFail=true');
					}else {
			            // SQL statement to insert the new users details into the database
					    $sql = "INSERT INTO `user_details`(`first_name`, `last_name`, `student_staff_id`, `email`, `subject_id`, `password`) 
						                            VALUES ('$firstName', '$lastName', '$idNumber', '$email', '$field[0]', '$password')";
					    $result = mysqli_query($connect,$sql);
						$sql = "SELECT * FROM `user_details` WHERE email = '$email' AND password = '$password'";
						$result = mysqli_query($connect,$sql);
						$row = $result -> fetch_assoc();
					
						setcookie('userID',$row[user_id],time() + (86400 * 30));
						// Setting cookies in the users browser to so that they may automatically login in the future
						setcookie('email',$email ,time() + (86400 * 30));
						// Cookie expires after a month
						setcookie('password',$password ,time() + (86400 * 30));
						setcookie('RepScore',$row[reputation_score],time() + (86400 * 30));
						// Directs user to there profile;
						header("location: userProfile.php");
					}
				}
			}
		}
		// If captcha is not pressed
		else {
			header('location: index.php?CaptchaFail=True');
		}
	}else{
		echo "not working";
	}
?>