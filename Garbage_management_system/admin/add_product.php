<?php 
session_start();
include '../main/db_connect.php';

if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['add_product'])){
    $name = $_POST['name'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $features = $_POST['features'];

    $image = $_FILES['product_image']['name'];
    $temp_image = $_FILES['product_image']['tmp_name'];
    $upload_path = "../photos/admin_img/" . $image;

    if(move_uploaded_file($temp_image, $upload_path)){
        $sql = "INSERT INTO `dustbin` (`name`, `image`, `size`, `type`, `stock`, `price`, `features`) VALUES ('$name', '$image', '$size', '$type', '$quantity', '$price', '$features')";
        if($conn->query($sql) == True){
            $_SESSION["added_success"] = "Product added successfully";
            header("Location: /Garbage_Management_System/admin/dashboard.php");
            exit();
        }
        else{
            $_SESSION["added_error"] = "There is some server issue, Please try after some time.";
            header("Location: /Garbage_Management_System/admin/dashboard.php");
            exit();
            
        }
    }
    else{
        $_SESSION['image_failed'] = "Image uploading failed.";
        header("Location: /Garbage_Management_System/admin/dashboard.php");
        exit();
    }
}
