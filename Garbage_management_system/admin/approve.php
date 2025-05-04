<?php
include '../main/db_connect.php';

$error = "";
$id = $_GET['id'];
$table = $_GET['table'];

if($table === 'dustbin'){
    $sql = "UPDATE dustbin SET status = 'approved' Where id = '$id'";
} else if($table === 'driver'){
    $sql = "UPDATE driver SET isVerified = 1 Where id = '$id'";
}
else{
    $error = "Invalid table name!";
}

if($conn->query($sql)){
    header("Location:/Garbage_management_system/admin/dashboard.php#driver");
    exit();
}

?>