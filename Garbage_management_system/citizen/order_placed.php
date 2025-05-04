<?php
    include '../main/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $citi_id = $_POST['citi_id'];
    $citizen = "SELECT * FROM `citizen` WHERE id = '$citi_id'";
    $run = $conn->query($citizen);
    $citi = $run->fetch_assoc();
    $address = $citi['Address'];
                    
    $cart_query = "SELECT * FROM `cart` WHERE citi_id = '$citi_id'";
    $cart_result = $conn->query($cart_query);
    
    if($cart_result->num_rows > 0){
        while($cart_rows = $cart_result->fetch_assoc()){

            $bin_id = $cart_rows['bin_id'];
            $quantity =$cart_rows['quantity'];
            $price =$cart_rows['price'];

            $order = "INSERT INTO `orders` (`citi_id`, `bin_id`, `quantity`, `total_amount`, `payment_status`, `delivery_address`, `order_status`) VALUES ('$citi_id', '$bin_id', '$quantity', '$price', 'Pending', '$address', 'Processing')";

            if ($conn->query($order)) {
                $remove_from_cart = "DELETE FROM `cart` WHERE id = '{$cart_rows['id']}'";
                $conn->query($remove_from_cart);
            } else {
                echo "Error placing order: " . $conn->error;
            }
        }
        header("Location: /Garbage_management_system/citizen/citi_dashboard.php");
        exit();
    }
}
?>