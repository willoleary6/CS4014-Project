<?php
function setcookie($name,$value){
setcookie($name, $value, time() + (86400 * 30), "/"); 
}?>