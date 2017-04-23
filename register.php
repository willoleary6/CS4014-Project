<?php
    // written by William O'Leary and Aaron Dunne
	// calling the database handler which will handle statements back and forth
	include 'dbh.php';
	// recieving all the data posted from index.php
	$firstName = mysqli_real_escape_string($connect,strip_tags($_POST['firstName']));
	$lastName = mysqli_real_escape_string($connect,strip_tags($_POST['lastName']));
	$idNumber = mysqli_real_escape_string($connect,strip_tags($_POST['idNumber']));
	$email = mysqli_real_escape_string($connect,strip_tags($_POST['email']));
	$field = mysqli_real_escape_string($connect,strip_tags($_POST['browser']));
	$password = mysqli_real_escape_string($connect,strip_tags($_POST['password']));
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
					    $confirmcode = rand();
						$sql = "INSERT INTO `user_details`(`first_name`, `last_name`, `student_staff_id`, `email`, `subject_id`, `password`,`confirmed`, `confirm_code`) 
						                            VALUES ('$firstName', '$lastName', '$idNumber', '$email', '$field[0]', '$password', '0', '$confirmcode')";
					    $result = mysqli_query($connect,$sql);
						$sql = "SELECT * FROM `user_details` WHERE email = '$email' AND password = '$password'";
						$result = mysqli_query($connect,$sql);
						$row = $result -> fetch_assoc();
						
						$message =
						"
						We see that you have recently created an account with us. To complete the process, please 
						click on the link below to register and verify your account.
					
						Link:
						https://cs-4014-project.000webhostapp.com/emailconfirm.php?email=$email&code=$confirmcode
					
						From the team at the University of Limerick
						";
					
						mail($email, "Account Email Verification", $message, "From: do-not-reply@cs4014.ul.ie");
					
						echo "
							<h2><strong>Account created</strong></h2>
							Success! Your new account has been created. A confirmation email has been sent to your email inbox. You cannot log on unless your email is verified.
						";
					
						setcookie('userID',$row['user_id'],time() + (86400 * 30));
						// Setting cookies in the users browser to so that they may automatically login in the future
						setcookie('email',$email ,time() + (86400 * 30));
						// Cookie expires after a month
						setcookie('password',$password ,time() + (86400 * 30));
						setcookie('RepScore',$row['reputation_score'],time() + (86400 * 30));
						// Directs user to there profile;
						//header("location: userProfile.php");
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