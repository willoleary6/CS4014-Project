<?php
    require_once 'config.php';
    $connect= mysqli_connect(hostname, user, password, db_name)
    or die("Connection failed : ".mysqli_connect_error());
?>