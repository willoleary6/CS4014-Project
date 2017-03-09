<?php
 include 'dbh.php';
 $email = $_POST['email'];
 $password = $_POST['password'];
 $sql = "SELECT * FROM `user_details` WHERE email = '$email' AND password = '$password'";
 $_SESSION['Error'] = "You left one or more of the required fields.";
 $result = mysqli_query($connect,$sql);
 if(!$row = $result -> fetch_assoc()){
         echo "<script> alert('Error you have made a mistake.');
         window.location.href='landing.php';
</script>";
   }else{
	header("location: index.html");
 }
?>