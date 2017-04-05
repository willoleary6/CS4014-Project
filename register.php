<?php
 // calling the database handler which will handle statements back and forth
 include 'dbh.php';
 // recieving all the data posted from index.php
 $firstName = strip_tags($_POST['firstName']);
 $lastName = strip_tags($_POST['lastName']);
 $idNumber = strip_tags($_POST['idNumber']);
 $email = strip_tags($_POST['email']);
 $field = strip_tags($_POST['browser']);
 $password = strip_tags($_POST['password']);
 // sql statement to find out what the id of the major subject the user has chosen 
 $sql = "SELECT `subject_id` FROM `major_subjects` WHERE `subject_name` = '$field'";
 $result = mysqli_query($connect,$sql);
 $field  = mysqli_fetch_array($result);
 // sql statement to insert the new users details into the database
 $sql = "INSERT INTO `user_details`(`first_name`, `last_name`, `student_staff_id`, `email`, `subject_id`, `password`) 
 VALUES ('$firstName', '$lastName', '$idNumber', '$email', '$field[0]', '$password')";
 $result = mysqli_query($connect,$sql);
 // setting cookies in the users browser to so that they may automatically login in the future
 setcookie('email',$email ,time() + (86400 * 30));
 // cookie expires after a month
 setcookie('password',$password ,time() + (86400 * 30));
 // directs user to there profile;
 header("location: userProfile.php");
?>