<?php
include '../main/db_connect.php';

$id = $_GET['id'];
$sql = "UPDATE driver SET isBlocked = 0 WHERE id = '$id'";


if($conn->query($sql)){
    header("location:/Garbage_management_system/admin/dashboard.php#blocked");
    exit();
}
?>