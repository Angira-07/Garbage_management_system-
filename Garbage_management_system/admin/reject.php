<?php
include '../main/db_connect.php';

$error = "";
$id = $_GET['id'];
$table = $_GET['table'];

if($table === 'dustbin'){
    $conn->query("DELETE FROM cart WHERE bin_id = '$id'");
    $sql = "DELETE FROM dustbin Where id = '$id'";
} else if($table === 'driver'){
    $sql = "DELETE FROM driver Where id = '$id'";
} else if($table === 'complaints'){
    $sql = "DELETE FROM complaints Where id = '$id'";
}
else{
    $error = "Invalid table name!";
}

if($conn->query($sql)){
    header("Location:/Garbage_management_system/admin/dashboard.php#$table");
    exit();
}

?>