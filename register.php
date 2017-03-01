<?php
 include 'dbh.php';
 $firstName = $_POST['firstName'];
 $lastName = $_POST['lastName'];
 $idNumber = $_POST['idNumber'];
 $email = $_POST['email'];
 $field = $_POST['field'];
 $password = $_POST['password'];
 $userType = '1';
$sql = "insert into users(first_name, last_name, student/staff_id, email, major_subject, password,) 
VALUES ('$firstName', '$lastName', '$idNumber', '$email', '$field', '$password')";
$result = mysqli_query($connect,$sql);

header("location: index.html"); 	
}

 ?>
 