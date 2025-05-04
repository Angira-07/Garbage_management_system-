<?php
include '../main/db_connect.php';
    
if(($_SERVER["REQUEST_METHOD"] ==  "POST") && isset($_POST['complain'])){
    $com_id = $_POST['id'];
    $driver_id = $_POST['activeDriver'];
    $admin_status = $_POST['status'];
    if($admin_status === 'Approved'){
        $sql = "UPDATE complaints SET
                `admin_status` = '$admin_status', `driver_id` = '$driver_id'
                WHERE id = '$com_id'";
        if($conn->query($sql) == TRUE){
            header('location:dashboard.php#complain');
            exit();
        }
    }
    else if($admin_status === 'Rejected'){
        $sql = "UPDATE complaints SET
                `admin_status` = '$admin_status'
                WHERE id = '$com_id'";
        if($conn->query($sql) == TRUE){
            header('location:dashboard.php#complain');
            exit();
        }
    }
}
?>