<?php
    session_start();
    include '../main/db_connect.php';
    echo "outside";
    if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['add_to_cart']))) {
        echo "hello";
        $citi_id = $_POST['citi_id'];
        $bin_id = $_POST['bin_id'];
        $bin_row = "SELECT * FROM dustbin WHERE id = '$bin_id'";
        $run_bin = $conn->query($bin_row);
        $bin = $run_bin->fetch_assoc();

        $price = $bin['price'];

        $check_sql = "SELECT * FROM `cart` WHERE `citi_id` = '$citi_id' AND `bin_id` = '$bin_id'";
        $check_res = $conn->query($check_sql);

        if($check_res->num_rows == 0){
            $insert_query = "INSERT INTO cart (citi_id, bin_id, price) VALUES ('$citi_id', '$bin_id', '$price')";
            if ($conn->query($insert_query)) {
                $_SESSION['product_added'] = "Go to Cart";
                header("Location:/Garbage_Management_system/citizen/citi_dashboard.php#dustbin");
                exit();
            }
        // } else {
        //     echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
        // }
        }
    }
?>