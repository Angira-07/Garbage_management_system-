<?php 
session_start();
include '../main/db_connect.php';
// var_dump($_POST);
// var_dump($_FILES);

if(isset($_POST['edit_product'])){
    $id = $_POST['edit'];
    $name = $_POST['name'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $features = $_POST['features'];

    if(!empty($_FILES['product_image']['name'])){
        $image = $_FILES['product_image']['name'];
        $temp_image = $_FILES['product_image']['tmp_name'];
        $upload_path = "../photos/admin_img/" . $image;

        if(move_uploaded_file($temp_image, $upload_path)){
            $sql = "UPDATE `dustbin` SET `name` = '$name', `image` = '$image', `size` = '$size', `type` = '$type', `stock` = '$quantity', `price` = '$price', `features` = '$features' WHERE `dustbin`.`id` = $id";
        }
        else{
            $_SESSION['image_failed'] = "Image uploading failed.";
            header("Location: /Garbage_Management_System/admin/dashboard.php#productDetails");
            exit();
        }
    }
    else{
        $sql = "UPDATE dustbin SET name = '$name', size = '$size', type = '$type', stock = '$quantity', price = '$price', features = '$features' WHERE id = $id";
        
    }
    if($conn->query($sql) === True){
        $_SESSION["added_success"] = "Product added successfully";
        header("Location: /Garbage_Management_System/admin/dashboard.php#productDetails");
        exit();
    }
    else{
        $_SESSION["added_error"] = "There is some server issue, Please try after some time.";
        header("Location: /Garbage_Management_System/admin/dashboard.php#productDetails");
        exit();
        echo "<script>console.log('query runn issue')</script>";
    }

}
    
    
?>