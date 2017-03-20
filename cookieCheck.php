<?php
if(isset($_COOKIE['email'])){
    $cookie = $_COOKIE['email'];
}
else{
    header("location: index.php");
}
?>