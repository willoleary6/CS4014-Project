<?php
 include 'dbh.php';
 include 'setCookie';
 
 if(isset($_COOKIE['email'])){
	 $email = $_COOKIE['email'];
	 $password = $_COOKIE['password'];
	 $sql = "SELECT * FROM `user_details` WHERE email = '$email' AND password = '$password'";
     $result = mysqli_query($connect,$sql);
     if(!$row = $result -> fetch_assoc()){
        header("location: logout.php");
    }else{
	        header("location: userProfile.php"); 
 } 
 }else{
 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password']);
 $sql = "SELECT * FROM `user_details` WHERE email = '$email' AND password = '$password'";
 $result = mysqli_query($connect,$sql);
 if(!$row = $result -> fetch_assoc()){
         echo "<script> alert('Error you have not entered valid credentials.');
         window.location.href='index.php';
         </script>";
   }else{
	setcookie("email", "", time() - 3600);
	setcookie("password", "", time() - 3600);
	$name ='email';
	setCookie($name,$email);
	$name = 'password';
	setCookie($name,$password);
	header("location: userProfile.php");
 }
 }
?>