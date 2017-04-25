<?php
    setcookie("tags", "", time() - 3600);
    header("location:taskStream.php");	 
?>