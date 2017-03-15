<?php
 include 'dbh.php';
 $firstName = strip_tags($_POST['firstName']);
 $lastName = strip_tags($_POST['lastName']);
 $idNumber = strip_tags($_POST['idNumber']);
 $email = strip_tags($_POST['email']);
 $field = strip_tags($_POST['browser']);
 $password = strip_tags($_POST['password']);
 $sql = "SELECT `subject_id` FROM `major_subjects` WHERE `subject_name` = '$field'";
 $result = mysqli_query($connect,$sql);
 $field  = mysqli_fetch_array($result);
 
 
 $sql = "INSERT INTO `user_details`(`first_name`, `last_name`, `student/staff_id`, `email`, `subject_id`, `password`) 
 VALUES ('$firstName', '$lastName', '$idNumber', '$email', '$field[0]', '$password')";
 $result = mysqli_query($connect,$sql);
 header("location: test.html");
 ?>