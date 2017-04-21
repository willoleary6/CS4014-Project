<?php
    // written by Aidan Cleere
    /*this file checks when a user opens a page if they have there cookies set
    and if not redirects them to log in*/
    if(isset($_COOKIE['email'])) {
        
    }
    else {
        header("location: index.php");
    }
?>