<?php
 include 'dbh.php';
 $firstName = $_POST['firstName'];
 $lastName = $_POST['lastName'];
 $idNumber = $_POST['idNumber'];
 $email = $_POST['email'];
 //$field = $_POST['field'];
 $field = 1;
$password = $_POST['password'];
$sql = "INSERT INTO `user_details`(`first_name`, `last_name`, `student/staff_id`, `email`, `subject_id`, `password`) 
VALUES ('$firstName', '$lastName', '$idNumber', '$email', '$field', '$password')";
$result = mysqli_query($connect,$sql);
header("location: index.html"); 	



 ?>