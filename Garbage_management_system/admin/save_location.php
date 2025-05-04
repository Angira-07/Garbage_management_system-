<?php
include '../main/db_connect.php'; // adjust as needed

if (isset($_POST['save_location'])) {
    $order_id = $_POST['order_id'];
    $lat = $_POST['latitude'];
    $lon = $_POST['longitude'];

    // First, update the dustbin linked to the order
    $dustbin_sql = "UPDATE `orders` SET latitude='$lat', longitude='$lon', order_status = 'Delivered' WHERE id = '$order_id'";
    $result = $conn->query($dustbin_sql);
    if ($result) {
        header("Location: dashboard.php"); // redirect back
        exit();
    } else{
        echo "<script>alert('Error updating dustbin location');</script>";
    }

}
?>
