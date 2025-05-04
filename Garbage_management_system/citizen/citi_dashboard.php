<?php
session_start();
include '../main/db_connect.php';

$success = $error = "";

if(!(isset($_SESSION['citizen_ph']))){
    header("location:/Garbage_management_system/main/index.php#citi_log");
    exit();
}
$email = $_SESSION['citizen_email'];
$phone = $_SESSION['citizen_ph'];

$sql= "SELECT * FROM `citizen` WHERE `email` = '$email' OR `phone`= '$phone'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if(($_SERVER["REQUEST_METHOD"] ==  "POST") && isset($_POST['edit'])){
    $house = $_POST['house'];
    $locality = $_POST['locality']; 
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $address = $house . ", " . $locality . ", " . $city . " - " . $pincode . ", " . $state;
    $location = $_POST['location'];

    $id = $user['id'];

    $sql = "UPDATE `citizen` SET `Address` = '$address', `location` = '$location' WHERE `id` =  $id";

    if($conn->query($sql)==TRUE)
            {
                $success = "Your account has been successfully updated.";
                header("Location: ../citizen/citi_dashboard.php#user-content");
                exit();
            }else{
                $error = "Sorry! There is some server issue.";
            }
}

if(isset($_POST['update_phone_btn'])){
    $update_value = $_POST['update_phone'];
    $update_id = $_POST['update_phone_id'];
    $update = "UPDATE `citizen` SET phone = '$update_value' WHERE id = '$update_id'";
    if($conn->query($update)){
        header('location:citi_dashboard.php');
        exit();
    };
 };
if(isset($_POST['update_email_btn'])){
    $update_value = $_POST['update_email'];
    $update_id = $_POST['update_email_id'];
    $update = "UPDATE `citizen` SET email = '$update_value' WHERE id = '$update_id'";
    if($conn->query($update)){
        header('location:citi_dashboard.php');
        exit();
    };
 };
if(isset($_POST['update_update_btn'])){
    $update_quantity = $_POST['update_quantity'];
    $update_price = $_POST['update_cart_price'];
    $update_id = $_POST['update_quantity_id'];
    $price = $update_quantity * $update_price;
    $update = "UPDATE `cart` SET quantity = '$update_quantity', price = $price WHERE id = '$update_id'";
    if($conn->query($update)){
        header('location:citi_dashboard.php');
        exit();
    };
 };

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    $remove = "DELETE FROM `cart` WHERE id = '$remove_id'";
    $res = $conn->query($remove);
    header('location:citi_dashboard.php');
    exit();
};

if(isset($_GET['delete_all'])){
    $remove = "DELETE FROM `cart`";
    $res = $conn->query($remove);
    header('location:citi_dashboard.php');
 }

function getTotalOrderDelivered($conn, $citi_id) {
    $status = 'Delivered';
    $totalCitizens = "SELECT COUNT(*) AS total FROM orders WHERE order_status = '$status' and citi_id = '$citi_id'";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}
function getTotalOrderPending($conn, $citi_id) {
    $status = 'Processing';
    $totalCitizens = "SELECT COUNT(*) AS total FROM orders WHERE order_status = '$status' and citi_id = '$citi_id'";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}

$success = "";
if(($_SERVER["REQUEST_METHOD"] ==  "POST") && isset($_POST['complain_submit'])){
    $citi_id = $_POST['id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $complain_address = $_POST['complain_address'];
    echo $citi_id;
    $complain = $conn->query("INSERT INTO `complaints` (`citi_id`, `type`, `description`, `location`) VALUES ('$citi_id', '$type', '$description', '$complain_address')");
    if($complain === TRUE){
        $_SESSION['success'] = "Complain summited succesfully";
        header('location:citi_dashboard.php#complain');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen_Dashboard</title>
    <link rel="stylesheet" href="\Garbage_management_system\citizen\citi_dashboard.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\citizen\user_content.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\citizen\dustbin_order.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\citizen\dustbin_order.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\citizen\cart.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="main">
        <div class="menu">
            <a id="1" class="menu-item" onclick="showPage('dashboard'), activeMenu('1'), removeHash()">
                <span class="icon">
                    <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="title">
                    Dashboard
                </span>
            </a>
            <a id="2" class="menu-item active" onclick="toggleSubMenu('dustbin-sub-menu'), removeHash()">
                <span class="icon">
                    <ion-icon name="trash-bin-outline"></ion-icon>
                </span>
                <span class="title">
                    Request Dustbin
                </span>
            </a>
            <div id="dustbin-sub-menu" class="submenu">
                <a id="d-1" class="menu-item" onclick="showPage('order-delivered'), activeMenu('d-1'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Delivered Dustbin
                    </span>
                </a>
                <a id="d-2" class="menu-item" onclick="showPage('order-pending'), activeMenu('d-2'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Pending Delivery
                    </span>
                </a>
                <a id="d-3" class="menu-item" onclick="showPage('dustbin'), activeMenu('d-3'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Dustbins
                    </span>
                </a>
            </div>
            <a id="3" class="menu-item" onclick=" removeHash(), toggleSubMenu('complain-sub-menu')">
                <span class="icon">
                    <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                </span>
                <span class="title">
                    Complain / Feedback
                </span>
            </a>
            <div id="complain-sub-menu" class="submenu">
                <a id="c-1" class="menu-item" onclick="showPage('newComplain'), activeMenu('c-1'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        New complain
                    </span>
                </a>
                <a id="c-2" class="menu-item" onclick="showPage('complainStatus'), activeMenu('c-2'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Complain Status
                    </span>
                </a>
            </div>

            <!-- <a id="7" class="menu-item" onclick="window.location.href='/Garbage_management_system/admin/log_out.php'">
                <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="title">
                    Log Out
                </span>
            </a> -->

        </div>
        <div class="container">
            <nav class="navbar">
                <!-- <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div> -->
                <div class="user">
                    <span>
                        <ion-icon id="profile_icon" name="person-outline"></ion-icon>
                    </span>
                    <span class="welcome">
                        <span class="name">
                            <?php echo "<p>Welcome, " . $user['name'] . "</p>"; ?>
                        </span>
                        <span class="time">
                            <?php echo date("l: F d,Y"); ?>
                        </span>
                    </span>
                </div>

                <div id="user-content">
                    <span class="name">
                        <?php echo "<p>Hello, " . $user['name'] . "</p>"; ?>
                    </span>
                    <div class="contact">
                        <div class="phone">
                            <?php echo "
                                <form action='' method='post' style='display:flex; align-items:center;'>
                                    <input type='hidden' name='update_phone_id'  value='{$user['id']}' >
                                    <input type='number' name='update_phone' value='{$user['phone']}' style='width:auto; min-width:50px; border:none; background:transparent; height: 20px;' >
                                    <button type='submit' name='update_phone_btn' style='background:none; border:none;'>
                                            <ion-icon name='create-outline' style'font-size: 20px;'></ion-icon>
                                    </button>                                            
                                </form> ";
                            ?>
                        </div>
                        <div class="email">
                            <?php echo "
                                <form action='' method='post' style='display:flex; align-items:center;'>
                                    <input type='hidden' name='update_email_id'  value='{$user['id']}' >
                                    <input type='email' name='update_email' value='{$user['email']}' style='width:auto; min-width:50px; border:none; background:transparent; height: 20px;' >
                                    <button type='submit' name='update_email_btn' style='background:none; border:none;'>
                                            <ion-icon name='create-outline' style'font-size: 20px;'></ion-icon>
                                    </button>                                            
                                </form> ";
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="address">
                        <h1>Address<ion-icon id='edit_add' name='create-outline'></ion-icon></h1>
                        <?php echo "<p>{$user['Address']},{$user['location']}</p>"; ?>
                    </div>
                    <div class="address_edit">
                        <form id="add" action="citi_dashboard.php" method="POST">
                            <span style='cursor:pointer;'
                                onclick="document.querySelector('.address_edit').style.display='none';"><ion-icon
                                    name='close-sharp'></ion-icon></span>
                            <?php
                                // $address[] = explode(', ', $user['Address']);
                                // $city_pincode[] = explode(' - ', $address[2]);
                                // $house = $address[0]; $locality = $address[1]; $city = $city_pincode[0]; $pincode = $city_pincode[1]; $state = $address[4];

                                if(!empty($success)){
                                    echo "<div class='message success'>";
                                    echo $success;
                                    echo "<span style='cursor:pointer;' onclick=\"document.querySelector('.message').style.display='none';\"><ion-icon name='close-circle-outline'></ion-icon><span>";
                                    echo "</div>";
                                }
                                if(!empty($error)){
                                    echo "<div class='message error'>";
                                    echo $error;  
                                    echo "<span style='cursor:pointer;' onclick=\"document.querySelector('.message').style.display='none';\"><ion-icon name='close-circle-outline'></ion-icon><span>";
                                    echo "</div>";
                                } 
                                ?>
                            <div class='form-group'>
                                <!-- <label>House No. / Apartment Name</label> -->
                                <input type='text' name='house' placeholder='House No. / Apartment Name' required>
                            </div>

                            <div class='form-group'>
                                <!-- <label>Street Name / Locality</label> -->
                                <input type='text' name='locality' placeholder='Street Name / Locality' required>
                            </div>

                            <div class='form-group'>
                                <!-- <label>City</label> -->
                                <input type='text' name='city' placeholder='City Name' required>
                            </div>

                            <div class='form-group'>
                                <!-- <label>Pincode</label> -->
                                <input type='number' name='pincode' placeholder='Pincode' required>
                            </div>

                            <div class='form-group'>
                                <!-- <label>State</label> -->
                                <input type='text' name='state' placeholder='State Name' required>
                            </div>

                            <div class='form-group'>
                                <!-- <label>Google Map Location</label> -->
                                <input type='text' name='location' placeholder='Google Map Location (Optional)'
                                    required>
                            </div>
                            <div class='form-group btn'>
                                <button type='submit' name='edit' class='submit-btn'>Update</button>
                            </div>
                        </form>
                    </div>

                    <form class="delete" action="delete_account.php" method="POST">
                        <input type="hidden" name="phone" value="<?= $user['phone']?>">
                        <button onclick="return confirm('are your sure you want to delete this?');" class="delete"
                            type="submit" name="delete">Delete My Account</button>
                    </form>

                </div>
                <div class="top-box">
                    <div class="cart-icon">
                        <?php  
                            $citi_id = $user['id'];
                            $cart_query = "SELECT COUNT(*) AS total FROM `cart` WHERE citi_id = '$citi_id'";
                            $cart_result = $conn->query($cart_query);
                            if($cart_result){
                                $row = $cart_result->fetch_assoc();
                                echo "<div class='total-cart'>";
                                echo $row['total'];
                                echo "</div>";
                            }
                            else{
                                echo "<div class='total-cart'>";
                                echo"0";
                                echo "</div>";
                            }
                        ?>
                        <ion-icon id="cart_icon" name="cart-outline"></ion-icon>
                    </div>
                    <!-- <div class="notification">
                        <ion-icon name="notifications-outline"></ion-icon>
                    </div> -->
                    <div class="logout" onclick="window.location.href='/Garbage_management_system/citizen/log_out.php'">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </div>
                </div>
                <div id="cart">
                    <div id="cart-details" class="hidden">
                        <?php
                        
                        $citi_id = $user['id'];
                        
                        $cart_query = "SELECT * FROM `cart` WHERE citi_id = '$citi_id'";
                        $cart_result = $conn->query($cart_query);
                        // echo $citi_id;
                        $total = 0;
                        $count = 0;
    
                        if($cart_result->num_rows > 0){
                            while($cart_rows = $cart_result->fetch_assoc()){
    
                                $bin_id = $cart_rows['bin_id'];
                                $bin_query = "SELECT * FROM `dustbin` WHERE id = '$bin_id'";
                                $bin_result = $conn->query($bin_query);
    
                                if($bin_result->num_rows > 0){
                                    $bin_row = $bin_result->fetch_assoc();
    
                                    $quantity = $cart_rows['quantity'] ? $cart_rows['quantity'] : 1;
                                    $sub_total = $bin_row['price'] * $quantity;
                                    $total += $sub_total;
    
                                    $cart_id = $cart_rows['id'];
                                    echo    
                                        "<div id='product' class='product-container'>
                                            <a href='?remove={$cart_rows['id']}' onclick=\"return confirm('remove item from cart?')\" class='delete-btn'><ion-icon name='trash'></ion-icon></a>
                                            <div class='product-box img'>
                                                <img src='/Garbage_management_system/photos/admin_img/{$bin_row['image']}' height = '100px' alt='product image'>                                         
                                            </div>
    
                                            <!-- Middle: Form Inputs -->
                                            <div class='product-box first'>
                                                <div class='productDetails name'><strong>{$bin_row['name']} for {$bin_row['type']}</strong></div>
                                                <div class='productDetails '><strong>Use for:</strong> {$bin_row['type']}</div>
                                                <div class='productDetails '><strong>Features:</strong> included {$bin_row['features']}</div>
                                                <div class='productDetails '><strong>Size: </strong>{$bin_row['size']}</div>
                                                <div class='productDetails price'>&#8377;<strong>{$bin_row['price']}</strong></div>
                                                </div>
                                            <div class='product-box time'>
                                                <form action='' method='post'>
                                                    <input type='hidden' name='update_quantity_id'  value='{$cart_rows['id']}' >
                                                    <input type='hidden' name='update_cart_price'  value='{$bin_row['price']}' >
                                                    <div class='productDetails price'><strong>Qty: </strong></div>
                                                    <input type='number' id='quantity_input' name='update_quantity' min='1'  value='{$cart_rows['quantity']}' >
                                                    <button type='submit' name='update_update_btn' style='background:none; border:none;'>
                                                    <ion-icon id='update_quantity_icon' name='checkmark-done-circle' style='font-size:24px;'></ion-icon>
                                                    </button>                                            
                                                </form> 
                                                    <div class='productDetails price'>Total Price: &#8377;<strong>{$cart_rows['price']}</strong></div>
                                                    </div>
                                                    </div><br>";
                                                }
                                                $count++;
                                            }
                                            // <ion-icon id='update_quantity_icon' name='checkmark-done-circle'><input type='submit' value='update' name='update_update_btn'></ion-icon>
                                            echo 
                                            "<div class='bottom'> 
                                                <div class='remove_all'>
                                                    <a href='?delete_all' onclick=\"return confirm('remove item from cart?')\" class='delete-btn'><ion-icon name='trash'></ion-icon> Remove all</a>
                                                </div>
                                                <div class='order_proceed'>
                                                    <div class='order_details_column' style='display: flex; flex-direction:column; gap:5px;'>
                                                        <div class='productDetails price'>Price Details(" . ($count > 1 ? "{$count} items" : "{$count} item") . ") : &#8377;<strong> {$total}</strong></div>
                                                        <div class='askDetails'><strong>Payment Method: </strong>Cash On Delivery</div>
                                                    </div>
                                                    <form action='order_placed.php' method='POST'>
                                                       <input type='hidden' name='citi_id'  value='{$user['id']}' >
                                                       <input type='hidden' name='citi_id'  value='{$user['id']}' >
                                                       <button name='order_roduct' class='add-product-btn edit' id='orderProduct' onclick=\"return confirm('Your order is placed')\">Proceed to Order</button>
                                                   </form>
                                                </div>
                                            </div>";
                                
                            }
                            else{
                                echo "<p>Your cart is empty</p>";
                            }
                    // echo "<div id='askForPlaced'>
                    //         <div class='askDetails'>Price Details(" . ($count > 1 ? "{$count} items" : "{$count} item") . ") : &#8377;<strong> {$total}</strong></div>
                    //         <div class='askDetails'><strong>Payment Method: </strong>Cash On Delivery</div>
                    //         <form action='order_placed.php' method='POST'>
                    //             <input type='hidden' name='citi_id'  value='{$user['id']}' >
                    //             <button name='order_roduct' class='add-product-btn edit' id='orderProduct'>Proceed to Order</button>
                    //         </form>
    
                    //     </div>";
                    //    echo $total; 
                    ?>
                    </div>
                </div>
            </nav>

            <div class="body">
                <div id="dashboard" class="body-item active">
                    <div class="box-items">
                        <div id="veri" class="box" onclick="showDriverDetails('order-delivered'),selectedBox('veri'), showPage('order-delivered'), activeMenu('d-1'), toggleSubMenu('dustbin-sub-menu')">
                            <span class="icon">
                                <ion-icon name="car-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalOrderDelivered($conn, $user['id']); ?>
                                <p>Total Order Delivered</p>
                            </span>
                        </div>
                        <div id="unveri" class="box" onclick="showDriverDetails('order-pending'),selectedBox('unveri'), toggleSubMenu('dustbin-sub-menu'), showPage('order-pending'), activeMenu('d-2')">
                            <span class="icon">
                                <ion-icon name="alert-circle-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalOrderPending($conn, $user['id']); ?>
                                <p>Order Pending to Deliver</p>
                            </span>
                        </div>
                        <!-- <div id="blo" class="box" onclick="showDriverDetails('complain_status'),selectedBox('blo')">
                            <span class="icon">
                                <ion-icon name="ban-outline"></ion-icon>
                            </span>
                            <span class="number">

                                <p>Blocked Drivers</p>
                            </span>
                        </div> -->
                    </div>
                    <div class="details">
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                        <div id="map" style="height: 350px; width: 100%; padding:10px;"></div>
                        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                        <script src="../main/show_dustbin.js"></script>


                    </div>
                </div>

                <div id="dustbin" class="body-item">
                    <section class="show">
                        <?php 
                            $sql = "SELECT * FROM `dustbin`";
                            $res = $conn->query($sql);
                            if($res->num_rows > 0){
                                while($rows = $res->fetch_assoc()){
                                    if($rows['stock'] > 0){
                                        $bin_id = $rows['id'];
                                        $user_id = $user['id'];
                                        $check_sql = "SELECT * FROM `cart` WHERE `citi_id` = '$user_id' AND `bin_id` = '$bin_id'";
                                        $check_res = $conn->query($check_sql);
                                        echo    
                                            "<div id='product' class='product-container'>
                                                <div class='product-box img'>
                                                    <img src='/Garbage_management_system/photos/admin_img/{$rows['image']}' height = '200px' alt='product image'>                                         
                                                </div>

                                                <div class='product-box first'>
                                                    <div class='productDetails name'><strong>{$rows['name']} for {$rows['type']}</strong></div>
                                                    <div class='productDetails '><strong>Use for:</strong> {$rows['type']}</div>
                                                    <div class='productDetails '><strong>Features:</strong> included {$rows['features']}</div>
                                                    <div class='productDetails '><strong>Size: </strong>{$rows['size']}</div>
                                                    <div class='productDetails price'>&#8377;<strong>{$rows['price']}</strong></div>
                                                    </div>

                                                    <div class='product-box right'>";

                                                        if($check_res->num_rows > 0){
                                                            echo "<button type='submit' id='go-to-cart' class='add-to-cart'>Go to Cart</button>";
                                                        } 
                                                        else {
                                                            echo "<form method='POST' action='add_to_cart.php'>
                                                                <input type='hidden' name='citi_id' value='{$user['id']}'>
                                                                <input type='hidden' name='bin_id' value='{$rows['id']}'>
                                                                <button type='submit' name='add_to_cart' class='add-to-cart'>Add to Cart</button>
                                                            </form>";
                                                        }
                                                        
                                                echo "</div>
                                                    </div><br>";
                                                }
                                                else{
                                                    echo    
                                                    "<div id='product' class='product-container'>
                                                    <div class='product-box img'>
                                                    <img src='/Garbage_management_system/photos/admin_img/{$rows['image']}' height = '200px' alt='product image'>                                         
                                                    </div>
                                                    
                                                    <!-- Middle: Form Inputs -->
                                                    <div class='product-box first'>
                                                    <div class='productDetails name'><strong>{$rows['name']} for {$rows['type']}</strong></div>
                                                    <div class='productDetails '><strong>Use for:</strong> {$rows['type']}</div>
                                                    <div class='productDetails '><strong>Features:</strong> included {$rows['features']}</div>
                                                    <div class='productDetails '><strong>Size: </strong>{$rows['size']}</div>
                                                    <div class='productDetails price'><strong style='color:red;'>Out of Stock</strong></div>
                                                    </div>
        
                                               
                                            </div><br>";
                                            
                                    }
                                }
                                
                            }
                        ?>
                    </section>
                </div>
                <div id="order-delivered" class="body-item">
                    <table id="verified_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Order by</th>
                                <th>Product Details</th>
                                <th>Price Details</th>
                                <th>Order status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $citi_id = $user['id'];
                        $sql = "SELECT 
                                orders.id AS order_id,
                                dustbin.name AS bin_name,
                                citizen.name AS citi_name,
                                orders.*, 
                                dustbin.*, 
                                citizen.*
                            FROM orders
                            JOIN dustbin ON orders.bin_id = dustbin.id
                            JOIN citizen ON orders.citi_id = citizen.id
                            Where citi_id = $citi_id and order_status = 'Delivered'";
                    
                        $res = $conn->query($sql);
                        if($res->num_rows > 0){
                            while($rows = $res->fetch_assoc()){
                                if($rows['order_status'] === 'Delivered'){
                                    echo "<tr>
                                            <td> <img src='/Garbage_management_system/photos/admin_img/{$rows['image']}' height='100px' width='100px' alt='order image'></td>
                                            <td> {$rows['citi_name']}</td>
                                            <td> <strong>{$rows['bin_name']} for {$rows['type']}</strong> <br> {$rows['size']} for {$rows['type']} with {$rows['features']}</td>
                                            <td>&#8377;<strong>{$rows['total_amount']}<br>Qty: <strong>{$rows['quantity']}</td>
                                            <td>{$rows['order_status']}</td>
                                        </tr>";
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>
                <div id="order-pending" class="body-item">
                    <table id="verified_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Order by</th>
                                <th>Product Details</th>
                                <th>Price Details</th>
                                <th>Order status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                        $sql = "SELECT 
                                orders.id AS order_id,
                                dustbin.name AS bin_name,
                                citizen.name AS citi_name,
                                orders.*, 
                                dustbin.*, 
                                citizen.*
                            FROM orders
                            JOIN dustbin ON orders.bin_id = dustbin.id
                            JOIN citizen ON orders.citi_id = citizen.id
                            Where citi_id = $citi_id and order_status = 'Processing'";
                    
                        $res = $conn->query($sql);
                        if($res->num_rows > 0){
                            while($rows = $res->fetch_assoc()){
                                if($rows['order_status'] === 'Processing'){
                                    // echo    
                                    //     "<div class='order-container'>
                                    //         <div class='order-box img'>
                                    //             <img src='/Garbage_management_system/photos/admin_img/{$rows['image']}' height = '100px' width='100px' alt='order image'>                                         
                                    //             <div class='productDetails price'>Total Price: &#8377;<strong>{$rows['total_amount']}</strong></div>
                                    //             <div class='productDetails price'>Qty: <strong>{$rows['quantity']}</strong></div>
                                    //             <div class='productDetails price'>Order Status: <strong>{$rows['order_status']}</strong></div>
                                    //         </div>
                            
                                    //         <!-- Middle: Form Inputs -->
                                    //         <div class='order-box first'>
                                    //             <div class='productDetails name'>Order by: <strong>{$rows['citi_name']}</strong></div>
                                    //             <div class='productDetails name'>Product: <strong>{$rows['bin_name']} for {$rows['type']}</strong></div>
                                    //             <div class='productDetails '>Details: {$rows['size']} for {$rows['type']} with {$rows['features']}</div>
                                    //         </div>
                                            
                                    // </div>";
                                    echo "<tr>
                                            <td> <img src='/Garbage_management_system/photos/admin_img/{$rows['image']}' height='100px' width='100px' alt='order image'></td>
                                            <td> {$rows['citi_name']}</td>
                                            <td> <strong>{$rows['bin_name']} for {$rows['type']}</strong> <br> {$rows['size']} for {$rows['type']} with {$rows['features']}</td>
                                            <td>&#8377;<strong>{$rows['total_amount']}<br>Qty: <strong>{$rows['quantity']}</td>
                                            <td>{$rows['order_status']}</td>
                                        </tr>";
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>

                <div id="newComplain" class="body-item">
                    <span class="success"><?php if(isset($_SESSION['success'])) {echo $_SESSION['success'];}  unset($_SESSION['success']);?></span>
                    <form action="" method="post">
                        <fieldset>
                            <legend>Personal Details</legend>
                            <div class="complain-box">
                                <label for="name">Your Name: </label>
                                <input type="text" name="name" value="<?= $user['name'] ?>" readonly>

                            </div>
                            <div class="complain-box">
                                <label for="name">Phone No.: </label>
                                <input type="text" name="name" value="<?= $user['phone'] ?>" readonly>
                            </div>
                            <div class="complain-box">
                                <label for="name">Email Id: </label>
                                <input type="text" name="email" value="<?= $user['email'] ?>" readonly>
                            </div>
                            <div class="complain-box">
                                <label for="name">You are from: </label>
                                <input type="text" name="address" value="<?= $user['Address'] ?>" readonly>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Complain Details</legend>
                            <div class="complain-box">
                                <label for="type">Complain Type</label>
                                <select name="type" id="complain_type">
                                    <option value="" selected disabled hidden>-- select --</option>
                                    <option value="Missed Pickup">Missed Pickup</option>
                                    <option value="Overflowing Dustbin">Overflowing Dustbin</option>
                                </select>
                            </div>
                            <div class="complain-box">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="4" cols="30"></textarea>
                            </div>
                            <div class="complain-box">
                                <label for="address">Address</label>
                                <input type="text" id="complaint_address" name="complain_address" required>
                            </div>
                        </fieldset>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>" readonly>
                        <button name="complain_submit" class="complain-btn">Submit</button>

                    </form>
                </div>
                <div id="complainStatus" class="body-item">
                    <table id="pendingComplain_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Complain_ID</th>
                                <!-- <th>Complained By</th> -->
                                <th>Complain Type with Description</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Pickup-Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $sql = "SELECT * from complaints";
                                
                                $result = $conn->query($sql);
                                // $driver = $conn->query("SELECT * FROM driver WHERE isBlocked=0 AND isVerified=1");
                                // $num = 1;
                                if ($result->num_rows >= 0) {
                                        // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td><{$row['type']}<br>{$row['description']}</td>
                                                <td>{$row['location']}</td>
                                                <td>{$row['admin_status']}</td>
                                                <td>{$row['pickup_status']}</td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr>
                                            <td colspan='5'>0 results</td>
                                        </tr>";
                                }
                                ?>
                    </table>
                </div>
                <div id="profile" class="body-item">
                    <!-- <form method='POST' action='citi_reg.php'>
                                <fieldset>
                                    <legend>Personal Details</legend>
                                        <div class='form-group'>
                                            <label>Full Name</label>
                                            <input type='text' name='name' value="<?php echo $user['name']?>" placeholder='Full Name'>
                                        </div>

                                        <div class='form-group'>
                                            <label>Date of Birth</label>
                                            <input type='date' name='dob' value="<?php echo $user['dob']?>" placeholder='Date of Birth'>
                                        </div>

                                        <div class='form-group'>
                                            <label>Gender</label>
                                            <select name='gender'>
                                                <option value="<?php echo $user['gender']?>">Male</option>
                                                <option value='male'>Male</option>
                                                <option value='female'>Female</option>
                                                <option value='other'>Other</option>
                                            </select>
                                        </div>

                                        <div class='form-group'>
                                            <label>Phone no.</label>
                                            <div class='phone'>
                                                <input type='number' name='phone' value="<?php echo $user['phone']?>" placeholder='Phone Number'>
                                            </div>                                        </div>

                                        <div class='form-group email'>
                                            <label>Email id</label>
                                            <input type='email' name='email' value="<?php echo $user['email']?>" placeholder='Email Address'>
                                        </div>
                                    </fieldset>


                                    <fieldset>
                                        <legend>Address & Location Details</legend>

                                        <div class='form-group'>
                                            <label>House No. / Apartment Name</label>
                                            <input type='text' name='house' placeholder='House No. / Apartment Name'>
                                        </div>

                                        <div class='form-group'>
                                            <label>Street Name / Locality</label>
                                            <input type='text' name='locality' placeholder='Street Name / Locality'>
                                        </div>
                                        <div class="form-group1">
                                            <div class='form-group'>
                                                <label>City</label>
                                                <input type='text' name='city' placeholder='City Name'>
                                            </div>
    
                                            <div class='form-group'>
                                                <label>Pincode</label>
                                                <input type='number' name='pincode' placeholder='Pincode'>
                                            </div>
                                        </div>

                                        <div class='form-group'>
                                            <label>State</label>
                                            <input type='text' name='state' placeholder='State Name'>
                                        </div>

                                        <div class='form-group'>
                                            <label>Google Map Location</label>
                                            <input type='text' name='location' placeholder='Google Map Location (Optional)'>
                                        </div>
                                    </fieldset>
                                    <div class='form-group btn'>
                                        <button type='submit' class='submit-btn'>Submit</button>
                                    </div>
                    </form> -->
                </div>
            </div>
        </div>
    </div>

    <script src="/Garbage_management_system/citizen/citi_script.js?v=<?= time(); ?>"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous">
        </script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        let table1 = new DataTable('#table1');
        let table2 = new DataTable('#table2');
        let table3 = new DataTable('#table3');
    </script>
</body>

</html>