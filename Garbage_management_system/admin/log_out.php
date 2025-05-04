<?php
session_start();          
session_unset();         
session_destroy();      
header("Location:/Garbage_management_system/main/index.php"); 
exit();
?>
