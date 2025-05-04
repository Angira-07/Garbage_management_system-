<?php
// seasson_start(); 

$servername = "localhost:3307";  
$username = "root";
$password = ""; 
$database = "garbage_management_system";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    "<script>alert('Connection failed.');</script>";
} else {
    // echo "Connected successfully";
    "<script>alert('Connection successfully.');</script>";
}
?>