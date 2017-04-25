<?php
    // Written by William O'Leary - 15155528 and Aaron Dunne - 15148602
    // Calling the database handler which will handle statements back and forth
    include 'dbh.php';
    // If statement to check if 'email' cookie has been set
    if(isset($_COOKIE['email'])) {
	    //If true the program will automatically log the user in.
	    $email = htmlspecialchars($_COOKIE['email'], ENT_QUOTES);
	    $password = htmlspecialchars($_COOKIE['password'], ENT_QUOTES);
	    // SQL statement to check if the email and password cookies are in the database 
	    $sql = "SELECT * FROM `user_details` WHERE email = '$email'"; //AND password = '$password'";
        $result = mysqli_query($connect,$sql);
        $row = $result -> fetch_assoc();
		$hash_pass = $row['password'];

		/* If credentials are invalid program redirects to clear cookies 
		through logout.php and sends user back to index.php*/
	    if((!$row )|| $row['banned'] == '1' || !password_verify($password, $hash_pass)) {
            echo '<script type="text/javascript">alert("Error: Credentials are not valid")</script>';
			header("location: logout.php");
        }else if($row['confirmed'] != '1') {
			/* If the creditentials are valdid but the account has not been activated as of yet, the user
			is redirected back to the homepage via logout.php */
			header("location: logout.php?NotActive");
        }else {
			
			header("location: userProfile.php");
		}
    }else {
        /* If the user has no cookies set then the program will verify 
		their credentials and set cookies */
	    $email = mysqli_real_escape_string($connect, strip_tags($_POST['email']));
	    $password = mysqli_real_escape_string($connect, strip_tags($_POST['password']));
	    $sql = "SELECT * FROM `user_details` WHERE email = '$email'"; //AND password = '$password'";
	    $result = mysqli_query($connect,$sql);
		$row = $result -> fetch_assoc();
		$hash_pass = $row['password'];
	
	    if(!$row || $row['banned'] == '1' || !password_verify($password, $hash_pass)) {
            "<script> alert('Error you have not entered valid credentials.');
            window.location.href='index.php';
            </script>";
        }else if($row['confirmed'] != '1') {
			header("location: logout.php?NotActive");
		}else {
		    // Setting the cookies that the website will use in functions such as auto login
			setcookie('RepScore',$row['reputation_score'],time() + (86400 * 30));
			setcookie('userID',$row['user_id'],time() + (86400 * 30));
		    setcookie('email',$email ,time() + (86400 * 30));
		    setcookie('password',$password ,time() + (86400 * 30));
		    header('Location: userProfile.php');
		} 
    }
?>