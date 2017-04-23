<?php
    // written by William O'Leary - 15155528
    // calling the database handler which will handle statements back and forth
    include 'dbh.php';
    //if statement to check if 'email' cookie has been set
    if(isset($_COOKIE['email'])) {
	    //if true the program will automatically log the user in.
	    $email = htmlspecialchars($_COOKIE['email'], ENT_QUOTES);
	    $password = htmlspecialchars($_COOKIE['password'], ENT_QUOTES);
	    // sql statement to check if the email and password cookies are in the database 
	    $sql = "SELECT * FROM `user_details` WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($connect,$sql);
        $row = $result -> fetch_assoc();
		/*if credentials are invalid program redirects to clear cookies 
		through logout.php and sends user back to index.php*/
	    if((!$row )|| $row['banned'] == '1') {
            echo '<script type="text/javascript">alert("Error: Credentials are not valid")</script>';
			header("location: logout.php");
        }else {    
            /*if the creditentials are legitimate then the user will automatically 
			be sent to there profile page*/
		    header("location: userProfile.php"); 
		} 
    }else {
        /*if the user has no cookies set then the program will verify 
		their credentials and set cookies*/
	    //protecting against XXS attacks and sql injections
		$temp1 = strip_tags($_POST['email']);
		$temp2 = strip_tags($_POST['password']);
		$email = mysqli_real_escape_string($connect,$temp1);
	    $password = mysqli_real_escape_string($connect,$temp2);
	    $sql = "SELECT * FROM `user_details` WHERE email = '$email' AND password = '$password'";
	    $result = mysqli_query($connect,$sql);
		$row = $result -> fetch_assoc();
	    if(!$row || $row['banned'] == '1') {
             echo "<script> alert('Error you have not entered valid credentials.');
             window.location.href='index.php';
             </script>";
        }else {
		    //setting the cookies that the website will use in functions such as auto login
			setcookie('RepScore',$row[reputation_score],time() + (86400 * 30));
			setcookie('userID',$row[user_id],time() + (86400 * 30));
		    setcookie('email',$email ,time() + (86400 * 30));
		    setcookie('password',$password ,time() + (86400 * 30));
		    header('Location: userProfile.php');
		}
    }
?>