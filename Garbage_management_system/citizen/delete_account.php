<?php
session_start();

if(isset($_POST['delete'])){
    include '../main/db_connect.php';
    $phone = $_POST['phone'];
    $sql = "DELETE FROM `citizen` WHERE `phone` = '$phone'";
    if($conn->query($sql)){
        // echo "Hello";
        header("Location: ..\citizen\citi_reg.php");
        exit();
    }
}

?>