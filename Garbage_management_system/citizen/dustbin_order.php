<?php
include '../main/db_connect.php';


if(($_SERVER["REQUEST_METHOD"] === "POST") && isset($_POST['order'])){
    $citi_id = $_POST['citi_id'];
    $citi_name = $_POST['name'];
    $citi_phone = $_POST['phone'];
    $citi_email = $_POST['email'];
    $useType = $_POST['useType'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $location = $_POST['location'];
    $dustbinType = $_POST['dustbinType'];
    $dustbinSize = $_POST['dustbinSize'];
    $quantity = $_POST['quantity'];
    $materialType = $_POST['materialType'];
    $lidType = $_POST['lidType'];
    $hasWheels = isset($_POST['hasWheels']) ? $_POST['hasWheels'] : "No";
    // echo "Has Wheels: $hasWheels";
    $hasRFIDTraking = isset($_POST['hasRFIDTracking']) ? "Yes" : "No";
    $hasLockableLid = isset($_POST['hasLockableLid']) ? "Yes" : "No";

    $sql = "INSERT INTO `dustbinrequests` (`citizenId`, `name`, `phone`, `email`, `useType`, `address`, `pincode`, `city`, `state`, `location`, `dustbinType`, `dustbinSize`, `quantity`, `materialType`, `lidType`, `hasWheels`, `hasRFIDTracking`, `hasLockableLid`, `requestDate`) VALUES ('$citi_id','$citi_name', '$citi_phone', '$citi_email', '$useType', '$address', '$pincode', '$city', '$state', '$location', '$dustbinType', '$dustbinSize', '$quantity', '$materialType', '$lidType', '$hasWheels', '$hasRFIDTraking', '$hasLockableLid', current_timestamp())";

    if ($conn->query($sql)) {
        session_start();
        $_SESSION['message'] = "Ordered Placed Successfully.";
        $_SESSION['msg_type'] = "success";
    } else {
        session_start();
        $_SESSION['message'] = "Sorry! there is a issue.";
        $_SESSION['msg_type'] = "error";
    }
    
    header("Location: ../citizen/citi_dashboard.php#dustbin");
    exit();
}


?>