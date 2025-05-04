<?php
session_start();
include '../main/db_connect.php';

if (!isset($_SESSION['user'])) {
    header("Location:/Garbage_management_system/main/index.php#admin");
    exit();
}

$username = $_SESSION['user']['username'];
$sql= "SELECT * FROM `admin` WHERE `username` = '$username'";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();

function getTotalDustbin($conn) {
    $totalCitizens = "SELECT COUNT(*) AS total FROM dustbin";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}
function getTotalOrders($conn) {
    $totalCitizens = "SELECT COUNT(*) AS total FROM orders";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}
function getTotalOrderRequest($conn) {
    $totalCitizens = "SELECT COUNT(*) AS total FROM orders WHERE order_status = 'Processing'";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}
function getTotalPendingGarbageRequest($conn) {
    $totalCitizens = "SELECT COUNT(*) AS total FROM complaints WHERE pickup_status != 'Completed' And admin_status = 'Approved'";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}
function getTotalCitizens($conn) {
    $totalCitizens = "SELECT COUNT(*) AS total FROM citizen";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}

// Query all unverified drivers
function getTotalDrivers($conn){
    $pendingDriver = "SELECT * FROM driver WHERE isVerified = 1 AND isBlocked = 0";
    $drivers = $conn->query($pendingDriver);
    $totalDrive = 0;
    while($rows = $drivers->fetch_assoc()){
        $totalDrive++;
    }
    return $totalDrive;
}

function getTotalUnverfied($conn){
    $pendingDriver = "SELECT * FROM `driver` WHERE isVerified = 0";
    $drivers = $conn->query($pendingDriver);
    $totalDrive = 0;
    while($rows = $drivers->fetch_assoc()){
        $totalDrive++;
    }
    return $totalDrive;
}

function getTotalBlocked($conn){
    $pendingDriver = "SELECT * FROM `driver` WHERE isBlocked = 1";
    $drivers = $conn->query($pendingDriver);
    $totalDrive = 0;
    while($rows = $drivers->fetch_assoc()){
        $totalDrive++;
    }
    return $totalDrive;
}

if(isset($_POST['update_order_status_btn'])){
    $id = $_POST['order_id'];
    $status = 'Delivered';
    $res = $conn->query("UPDATE orders SET order_status = '$status' WHERE id = $id");
    if($res == TRUE){
        header('location:dashboard.php#Order');
        exit();
    }
    else{
        header('location:citi_dashboard.php');
        exit();
        
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Dashboard</title>
    <link rel="stylesheet" href="\Garbage_management_system\admin\dashboard.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\admin\dustbin_detail.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\admin\add_product.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\admin\dustbin_order.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="main">
        <div class="menu">
            <a id="1" class="menu-item active" onclick="showPage('dashboard'), activeMenu('1'), removeHash()">
                <span class="icon">
                    <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="title">
                    Dashboard
                </span>
            </a>
            <a id="2" class="menu-item" onclick="showPage('citizen'), activeMenu('2'), removeHash()">
                <span class="icon">
                    <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">
                    Manage Citizen
                </span>
            </a>
            <a id="3" class="menu-item"
                onclick="showPage('driver'), activeMenu('3'), showDriverDetails('overall'), Un_selectBox(), removeHash()">
                <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                </span>
                <span class="title">
                    Manage Driver
                </span>
            </a>
            <a id="4" class="menu-item"
                onclick="showPage('dustbin'), activeMenu('4'), showDustbinDetails('dustbinDashboard'), removeHash(), Un_selectBox()">
                <span class="icon">
                    <ion-icon name="trash-outline"></ion-icon>
                </span>
                <span class="title">
                    Dustbin Requests
                </span>
            </a>
            <a id="5" class="menu-item" onclick="toggleSubMenu('complain-sub-menu'), removeHash()">
                <span class="icon">
                    <ion-icon name="document-text-outline"></ion-icon>
                </span>
                <span class="title">
                    Waste Reports
                </span>
            </a>
            <div id="complain-sub-menu" class="submenu">
                <a id="c-1" class="menu-item" onclick="showPage('pending_complains'), activeMenu('c-1'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Need Attention
                    </span>
                </a>
                <a id="c-2" class="menu-item" onclick="showPage('approved_complaines'), activeMenu('c-2'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Approved Complains
                    </span>
                </a>
                <a id="c-3" class="menu-item" onclick="showPage('rejected_complains'), activeMenu('c-3'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Rejected Complains
                    </span>
                </a>
                <a id="c-4" class="menu-item" onclick="showPage('completed_complains'), activeMenu('c-4'), removeHash()">
                    <!-- <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span> -->
                    <span class="title">
                        Completed Complains
                    </span>
                </a>
            </div>

            <!-- <a id="6" class="menu-item" onclick="showPage('payments'), activeMenu('6'), removeHash()">
                <span class="icon">
                    <ion-icon name="card-outline"></ion-icon>
                </span>
                <span class="title">
                    Payments
                </span>
            </a> -->
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
                <div class="user" style="margin-left: 20px;">
                    <span class="welcome">
                        <span class="name">
                            <?php echo "<p>Welcome, " . $admin['username'] . "</p>"; ?>
                        </span>
                        <span class="time">
                            <?php echo date("l: F d,Y"); ?>
                        </span>
                    </span>
                </div>
                <div class="top-box">
                    <div class="notification">
                        <ion-icon name="notifications-outline" id="notification-icon"></ion-icon>
                        <?php
                            if(getTotalUnverfied($conn) > 0){
                                echo "<ion-icon class='alert' name='ellipse'></ion-icon>";
                            }
                        ?>
                        <div class="notification-content">
                            <?php
                                $unverified = getTotalUnverfied($conn);
                                $orderRequests = getTotalOrderRequest($conn);
                        
                                if ($unverified > 0 || $orderRequests > 0) {
                                    if ($unverified > 0) {
                                        echo "<p>$unverified driver awaiting verification</p><br>";
                                    }
                                    if ($orderRequests > 0) {
                                        echo "<p>$orderRequests dustbin order request(s)</p>";
                                    }
                                } else {
                                    echo "<p>No notification</p>";
                                }
                            ?>
                        </div>
                        <script>
                            document.getElementById('notification-icon').addEventListener('click', function () {
                                let content = document.querySelector('.notification-content');
                                if (content.style.display === 'none') {
                                    content.style.display = 'block';

                                }
                                else {
                                    content.style.display = 'none';
                                }
                            })
                        </script>
                    </div>
                    <div class="logout" onclick="window.location.href='/Garbage_management_system/admin/log_out.php'">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </div>
                </div>
            </nav>
            <div class="body">
                <div id="dashboard" class="body-item active">
                    <div class="box-items">
                        <div class="box" onclick="activeMenu('2'), showPage('citizen')">
                            <span class="icon">
                                <ion-icon name="people-circle"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalCitizens($conn); ?>
                                <p>Total Citizens</p>
                            </span>
                        </div>
                        <div class="box"
                            onclick="activeMenu('3'), showPage('driver'), showDriverDetails('verified'), selectedBox('veri')">
                            <span class="icon">
                                <ion-icon name="car-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalDrivers($conn); ?>
                                <p>Active Drivers</p>
                            </span>
                        </div>
                        <div class="box" onclick="toggleSubMenu('complain-sub-menu'), showPage('approved_complaines'), activeMenu('c-2'), removeHash()">
                            <span class="icon">
                                <ion-icon name="hourglass-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalPendingGarbageRequest($conn); ?>
                                <p>Pending Garbage Pickup Requests</p>
                            </span> 
                        </div>
                        <div class="box" onclick="activeMenu('4'), showPage('dustbin'), showDustbinDetails('dustbinOrder'),selectedBox('dustbin_request')">
                            <span class="icon">
                                <ion-icon name="calendar-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalOrders($conn); ?>
                                <p>Total Dustbin Orders</p>
                            </span>
                        </div>
                    </div>
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                    <div id="map" style="height: 370px; width: 100%; padding:10px;"></div>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                    <script src="../main/show_dustbin.js"></script>

                </div>
                <div id="citizen" class="body-item">
                    <table id="table1" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone No.</th>
                                <th>Email Id.</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT *  from `citizen`";
                            $result = $conn->query($sql);
                            $num = 1;
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $num. "</td>
                                            <td>" . $row["name"]. "</td>
                                            <td>" . $row["phone"]. "</td>
                                            <td>" . $row["email"]. "</td>
                                            <td>" . $row["Address"]. "</td>";
                                    $num++;
                                }
                            } else {
                                echo "<tr>
                                        <td colspan='4'>0 results</td>
                                    </tr>";
                            }
                            ?>
                    </table>
                </div>
                <div id="driver" class="body-item">
                    <div class="box-items">
                        <div id="veri" class="box" onclick="showDriverDetails('verified'),selectedBox('veri')">
                            <span class="icon">
                                <ion-icon name="car-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalDrivers($conn); ?>
                                <p>Active Drivers</p>
                            </span>
                        </div>
                        <div id="unveri" class="box" onclick="showDriverDetails('unverified'),selectedBox('unveri')">
                            <span class="icon">
                                <ion-icon name="alert-circle-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalUnverfied($conn); ?>
                                <p>Unverified Drivers</p>
                            </span>
                        </div>
                        <div id="blo" class="box" onclick="showDriverDetails('blocked'),selectedBox('blo')">
                            <span class="icon">
                                <ion-icon name="ban-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalBlocked($conn); ?>
                                <p>Blocked Drivers</p>
                            </span>
                        </div>
                    </div>
                    <div class="details">
                        <div id="overall" class="detail active">
                            <!-- <h1>Hello</h1> -->
                        </div>
                        <div id="verified" class="detail">
                            <table id="verified_table" border="1" cellspacing="0" cellpadding="10">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone No.</th>
                                        <th>Email Id.</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM driver WHERE isVerified = 1 AND isBlocked = 0";
                                    $result = $conn->query($sql);
                                    $num = 1;
                                    if ($result->num_rows >= 0) {
                                            // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $num . "</td>
                                                    <td>" . $row["name"]. "</td>
                                                    <td>" . $row["username"]. "</td>
                                                    <td>" . $row["phone"]. "</td>
                                                    <td>" . $row["email"]. "</td>
                                                    <td>" .$row["address"]. "</td>
                                                    <td>";
                                                    if($row["isBlocked"] == 1){
                                                        echo "<button><a href='unblock.php?id=". $row["id"] ."'>Unblock</a></button>";
                                                    } else {
                                                        echo "<button><a href='block.php?id=". $row["id"] ."'>Block</a></button>";
                                                    }
                                            echo "</td>
                                                </tr>";
                                            $num++;
                                        }
                                    } else {
                                        echo "<tr>
                                                <td colspan='4'>0 results</td>
                                            </tr>";
                                    }
                                    ?>
                            </table>
                        </div>
                        <div id="unverified" class="detail">
                            <table id="unverified_table" border="1" cellspacing="0" cellpadding="10">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM driver WHERE isVerified = 0";
                                    $result = $conn->query($sql);
                                    $num = 1;
                                    if ($result->num_rows >= 0) {
                                            // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $num. "</td>
                                                    <td>" . $row["name"]. "</td>
                                                    <td>" . $row["username"]. "</td>
                                                    <td><button><a href='approve.php?table=driver&id=" . $row['id'] . "'>Verify</a></button> 
                                                    <button><a href='reject.php?table=driver&id=" . $row['id'] . "'>Reject</a></button></td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr>
                                                <td colspan='4'>0 results</td>
                                            </tr>";
                                    }
                                    ?>
                            </table>
                        </div>
                        <div id="blocked" class="detail">
                            <table id="blocked_table" border="1" cellspacing="0" cellpadding="10">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Phone No.</th>
                                        <th>Email Id.</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM driver WHERE isBlocked = 1";
                                    $result = $conn->query($sql);
                                    $num = 1;
                                    if ($result->num_rows >= 0) {
                                            // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $num . "</td>
                                                    <td>" . $row["name"]. "</td>
                                                    <td>" . $row["username"]. "</td>
                                                    <td>" . $row["phone"]. "</td>
                                                    <td>" . $row["email"]. "</td>
                                                    <td>" .$row["address"]. "</td>
                                                    <td>";
                                                    if($row["isBlocked"] == 1){
                                                        echo "<button><a href='unblock.php?id=". $row["id"] ."'>Unblock</a></button>";
                                                    } else {
                                                        echo "<button><a href='block.php?id=". $row["id"] ."'>Block</a></button>";
                                                    }
                                            echo "</td>
                                                </tr>";
                                            $num++;
                                        }
                                    } else {
                                        echo "<tr>
                                                <td colspan='4'>0 results</td>
                                            </tr>";
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="dustbin" class="body-item">
                    <div class="box-items">
                        <div id="dustbin_add" class="box"
                            onclick="showDustbinDetails('dustbinProducts'),selectedBox('dustbin_add')">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalDustbin($conn); ?>
                                <p>Products</p>
                            </span>
                        </div>
                        <div id="dustbin_request" class="box"
                            onclick="showDustbinDetails('dustbinOrder'),selectedBox('dustbin_request')">
                            <span class="icon">
                                <ion-icon name="cube-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalOrderRequest($conn); ?>
                                <p>Dustbin Requests</p>
                            </span>
                        </div>
                    </div>
                    <div class="dustbinDetails">
                        <div id="dustbinDashboard" class="detail active">
                        </div>

                        <div id="dustbinProducts" class="detail">
                            <section class="add">
                                <div id="add-product-icon">
                                    <ion-icon name="add"></ion-icon>
                                </div>

                                <form id="addProduct" class="form-container" method="POST" action="add_product.php"
                                    enctype="multipart/form-data">

                                    <div class="form-box img">
                                        <!-- <img src="../photos/admin_img/bin.png" alt="Bin Background" width="100px"> -->

                                        <label for="file-upload" class="upload-label">
                                            <ion-icon name="cloud-upload-outline"></ion-icon> &nbsp;
                                            <p id="file-name"> Add Product Image</p>
                                            <input type="file" id="file-upload" name="product_image"
                                                onchange="showFileName();" hidden required>
                                        </label>
                                    </div>

                                    <div class="form-box">
                                        <input class="form-input" type="text" name="name"
                                            placeholder="Enter the Product Name" required>

                                        <select class="form-input" name="features" required>
                                            <option value="" disabled selected hidden>-- Select Features --</option>
                                            <option value="Wheels">Wheels</option>
                                            <option value="Lockable Lid">Lockable Lid</option>
                                        </select>

                                        <input class="form-input" type="text" name="size"
                                            oninput="this.value = this.value.replace(/[^L0-9]/g,'')"
                                            placeholder="Size (e.g. 10L,20L,50L)" required>
                                    </div>
                                    <div class="form-box">
                                        <select class="form-input" name="type" required>
                                            <option value="" selected disabled hidden>-- Select Dustbin Type --</option>
                                            <option value="Organic Waste">Organic Waste</option>
                                            <option value="E-waste">E-waste</option>
                                            <option value="Medical Waste">Medical Waste</option>
                                            <option value="General Waste">General Waste</option>
                                        </select>

                                        <input class="form-input" type="number" name="price" placeholder="Price"
                                            required>

                                        <input class="form-input" type="number" name="quantity"
                                            oninput="this.value = this.value.replace(/[^L0-9]/g,'')"
                                            placeholder="Quantity Available" required>
                                    </div>

                                    <!-- Right: Meta Info -->
                                    <div class="form-box right">
                                        <button class="add-product-btn" type="submit" name="add_product">Add
                                            Product</button>
                                    </div>
                                </form>
                            </section>
                            <section class="show">
                                <?php 
                                    $sql = "SELECT * FROM `dustbin`";
                                    $res = $conn->query($sql);
                                    if($res->num_rows > 0){
                                        while($rows = $res->fetch_assoc()){
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
                                                            <div class='productDetails '><strong>Available Quantity: </strong>{$rows['stock']}</div>
                                                            <div class='productDetails price'>&#8377;<strong>{$rows['price']}</strong></div>
                                                            </div>
                                                        <div class='product-box time'>
                                                            <div class='productDetails price'><strong>Product added Time</strong><p>{$rows['createTime']}</p></div>
                                                            <div class='productDetails price'><strong>Last updated Time</strong><p>{$rows['updateTime']}</p></div>
                                                        </div>

                                                        <div class='product-box right'>
                                                            <button class='add-product-btn delete' onclick=\"return confirm('are your sure you want to delete this?');\"><a href='reject.php?table=dustbin&id=" . $rows['id'] . "'>Delete Product</a></button>
                                                            <button onclick=\" selectedBox('dustbin_request')\" name='edit_roduct' class='add-product-btn edit' id='requestEditProduct'><a href='dashboard.php?edit=". $rows["id"] ."'>Edit Product</a></button>
                                                        </div>
                                                    </div><br>";
                                        }
                                        
                                    }
                                ?>
                            </section>
                            <section id="edit_product" class="edit_product">
                                <?php
                                    if(isset($_GET['edit'])){
                                        // header("Location: /Garbage_Management_System/admin/dashboard.php#productDetails");
                                        // exit();
                                        $edit_id = $_GET['edit'];
                                        $edit_query = "SELECT * FROM `dustbin` WHERE id = $edit_id";
                                        $edit_result = $conn->query($edit_query);
                                        if($edit_result->num_rows > 0){
                                          while($rows = $edit_result->fetch_assoc()){
                                ?>

                                <form id="editProductForm" class="form-container" method="POST" action="edit_product.php"
                                enctype="multipart/form-data">
                                    
                                        <ion-icon id="edit-close-product-icon" name="close"></ion-icon>
                                    
                                    <div class="form-box img" style="background-image: url(/Garbage_Management_System/photos/admin_img/<?= $rows['image']?>)">
                                        <!-- <img src="../photos/admin_img/bin.png" alt="Bin Background" width="100px"> -->

                                        <label for="file-upload" class="upload-label">
                                            <ion-icon name="cloud-upload-outline"></ion-icon> &nbsp;
                                            <p id="file-name"> Update Product Image</p>
                                            <input type="file" id="file-upload" name="product_image"
                                                onchange="showFileName();" style="display: none;">
                                        </label>
                                    </div><br>
                                    <div class="upper-form-box">
                                    <div class="form-box">
                                        <input class="form-input" type="text" name="name"
                                            placeholder="Enter the Product Name" value="<?= $rows['name'] ?>" required>

                                        <select class="form-input" name="features" required>
                                            <option value="<?= $rows['features'] ?>"><?= $rows['features'] ?></option>
                                            <option value="Wheels">Wheels</option>
                                            <option value="Lockable Lid">Lockable Lid</option>
                                        </select>

                                        <input class="form-input" type="text" name="size"
                                            oninput="this.value = this.value.replace(/[^L0-9]/g,'')"
                                            placeholder="Size (e.g. 10L,20L,50L)" value="<?= $rows['size'] ?>" required>
                                    </div>
                                    <div class="form-box">
                                        <select class="form-input" name="type" required>
                                            <option value="<?= $rows['type'] ?>"><?= $rows['type'] ?></option>
                                            <option value="Organic Waste">Organic Waste</option>
                                            <option value="E-waste">E-waste</option>
                                            <option value="Medical Waste">Medical Waste</option>
                                            <option value="General Waste">General Waste</option>
                                        </select>

                                        <input class="form-input" type="number" name="price" placeholder="Price"
                                        value="<?= $rows['price'] ?>" required>

                                        <input class="form-input" type="number" name="quantity"
                                            oninput="this.value = this.value.replace(/[^L0-9]/g,'')"
                                            placeholder="Quantity Available" value="<?= $rows['stock'] ?>" required>
                                    </div>
                                          </div>
                                          <input type="hidden" name="edit" value="<?= $edit_id ?>">
                                        <button id="editiProductBtn" class="add-product-btn" type="submit" name="edit_product">Update
                                            Product</button>
                                </form>
                                <?php
                                            };
                                        };
                                        echo "<script>document.querySelector('.edit_product').style.display = 'flex';</script>";
                                    };
                                ?>
                                <!-- <script>
                                    showDustbinDetails('dustbinProducts'); 
                                    selectedBox('dustbin_add');
                                </script> -->
                            </section>
                        </div>
                        <div id="dustbinOrder" class="detail">
                            <!-- <div class="show"> -->
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
                                    ORDER BY FIELD(orders.order_status, 'Processing', 'Delivered')";
                            
                                $res = $conn->query($sql);
                                if($res->num_rows > 0){
                                    while($rows = $res->fetch_assoc()){
                                            echo "<tr>
                                                    <td> <img src='/Garbage_management_system/photos/admin_img/{$rows['image']}' height='100px' width='100px' alt='order image'></td>
                                                    <td> {$rows['citi_name']}</td>
                                                    <td> <strong>{$rows['bin_name']} for {$rows['type']}</strong> <br> {$rows['size']} for {$rows['type']} with {$rows['features']}</td>
                                                    <td>&#8377;<strong>{$rows['total_amount']}<br>Qty: <strong>{$rows['quantity']}</td>
                                                    <td>";
                                                        if($rows['order_status'] === 'Delivered'){
                                                                echo "<div class='productDetails price'>Order Status: <strong>{$rows['order_status']}</strong></div>";
                                                        }
                                                        else{
                                                            echo
                                                            "<form action='' method='post'>
                                                                <input type='hidden' name='order_id'  value='{$rows['order_id']}' >
                                                                <button type='button' class='add-order-btn' onclick='openDeliveryModal({$rows['order_id']})'>Mark As Delivered Product</button>
                                                            </form>";
                                                        }
                                            echo    "</td>
                                                </tr>";
                                            
                                        }
                                    }
                                ?>
                            </table>

                            <!-- Delivery Location Modal -->
                            <div id="deliveryModal" style="display:none; position:fixed; top:10%; left:10%; width:80%; height:100%; background:white; z-index:9999; border:1px solid #ccc; padding:15px;">
                                <h3>Set Dustbin Location</h3>
                                <form action="save_location.php" method="post">
                                    <input type="hidden" name="order_id" id="orderIdInput">
                                    <div id="select-map" style="height:400px;"></div>
                                    <input type="hidden" name="latitude" id="latitudeInput">
                                    <input type="hidden" name="longitude" id="longitudeInput">
                                    <br>
                                    <div class="button" style="display:flex; gap:10px;">
                                        <button type="submit" class='add-order-btn' name="save_location">Save Location</button>
                                        <button type="button" class='add-order-btn' style="background-color: #ad3011;;" onclick="closeDeliveryModal()">Cancel</button>
                                    </div>
                                </form>
                            </div>

                                
                            <!-- </div> -->
                        </div>
                    </div>


                </div>
                <div id="reports" class="body-item">
                </div>
                <div id="pending_complains"  class="body-item">
                    <table id="pendingComplain_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Complain_ID</th>
                                <th>Complained By</th>
                                <th>Complain Type with Description</th>
                                <th>Address</th>
                                <th>Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT 
                            complaints.id AS com_id,
                            citizen.name AS citi_name,
                            complaints.*
                            FROM complaints
                            JOIN citizen ON complaints.citi_id = citizen.id
                            WHERE admin_status = 'Pending'";
                            
                            $result = $conn->query($sql);
                            // $num = 1;
                            if ($result->num_rows >= 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <td>{$row['com_id']}</td>
                                    <td>{$row['citi_name']}</td>
                                    <td>{$row['type']}<br>{$row['description']}</td>
                                    <td>{$row['location']}</td>
                                    <td>
                                    <form action='approve_complain.php' method='POST'>
                                        <label for='driver'>Assigned Driver</label>
                                        <select name='activeDriver' id='drivers'>
                                            <option value='' selected default></option>";
                                            
                                            $driver = $conn->query("SELECT * FROM driver WHERE isBlocked=0 AND isVerified=1");
                                                    if ($driver->num_rows > 0) {
                                                        while ($drive = $driver->fetch_assoc()) {
                                                            echo "<option value='{$drive['id']}'>{$drive['name']}</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No Available Drivers</option>";
                                                    }
                                                
                                                    echo  "</select>
                                                    <label for='status'>Update Status</label>
                                                    <select name='status' id='complain_status'>
                                                        <option value='Pending'selected disabled>Pending</option>
                                                        <option value='Approved'>Approved</option>
                                                        <option value='Rejected'>Rejected</option>
                                                    </select>
                                                    <input type='hidden' name='id' value='{$row['id']}'>
                                                    <button name='complain'>Update</button>
                                                </form>
                                                
                                                </td>
                                                </tr>";
                                                // <button type='button' onclick=\"openForm({$row['com_id']})\">Update Status</button> 
                                }
                            } else {
                                echo "<tr>
                                        <td colspan='5'>0 results</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div id="complainUpdate" style="display:none; margin-top:20px;">
                        <form action="approve_complain.php" method="POST">
                            <label for="driver">Assigned Driver</label>
                            <select name="activeDriver" id="drivers">
                                <option value="" selected default></option>
                                <?php
                                    if ($driver->num_rows > 0) {
                                        while ($drive = $driver->fetch_assoc()) {
                                            echo "<option value='{$drive['id']}'>{$drive['name']}</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Available Drivers</option>";
                                    }
                                ?>
                            </select>
                            <label for="status">Update Status</label>
                            <select name="status" id="complain_status">
                                <option value="Pending"selected disabled>Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            <input type="hidden" name="id" id="com_id">
                            <button name="complain">Update</button>
                        </form>
                    </div>
                </div>
                <div id="approved_complaines" class="body-item">
                    <table id="approvedComplain_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Complain_ID</th>
                                <th>Complained By</th>
                                <th>Assigned To</th>
                                <th>Complain Type with Description</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Pickup Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT 
                            complaints.id AS com_id,
                            citizen.name AS citi_name,
                            driver.name AS driver_name,
                            complaints.*
                            FROM complaints
                            JOIN citizen ON complaints.citi_id = citizen.id
                            JOIN driver ON complaints.driver_id = driver.id
                            WHERE admin_status = 'Approved'";
                            
                            $result = $conn->query($sql);
                            $driver = $conn->query("SELECT * FROM driver WHERE isBlocked=0 AND isVerified=1");
                            // $num = 1;
                            if ($result->num_rows >= 0) {
                                    // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['com_id']}</td>
                                            <td>{$row['citi_name']}</td>
                                            <td>{$row['driver_name']}</td>
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
                <div id="rejected_complains" class="body-item">
                  <table id="approvedComplain_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Complain_ID</th>
                                <th>Complained By</th>
                                <th>Complain Type with Description</th>
                                <th>Address</th>
                                <th>Status</th>
                                <!-- <th>Pickup Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT 
                            complaints.id AS com_id,
                            citizen.name AS citi_name,
                            complaints.*
                            FROM complaints
                            JOIN citizen ON complaints.citi_id = citizen.id
                            WHERE admin_status = 'Rejected'";
                            
                            $result = $conn->query($sql);
                            $driver = $conn->query("SELECT * FROM driver WHERE isBlocked=0 AND isVerified=1");
                            $hasData = false;
                            if ($result->num_rows >= 0) {
                                    // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $hasdata= true;
                                    echo "<tr>
                                            <td>{$row['com_id']}</td>
                                            <td>{$row['citi_name']}</td>
                                            <td><{$row['type']}<br>{$row['description']}</td>
                                            <td>{$row['location']}</td>
                                            <td>{$row['admin_status']}</td>
                                        </tr>";
                                }
                            }
                            else if(!$hasData) {
                                echo "<tr>
                                        <td colspan='5'>0 results</td>
                                    </tr>";
                            }
                            ?>
                    </table>
                </div>
                <div id="completed_complains" class="body-item">
                    <table id="approvedComplain_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Complain_ID</th>
                                <th>Complained By</th>
                                <th>Complain Type with Description</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Pickup Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT 
                            complaints.id AS com_id,
                            citizen.name AS citi_name,
                            complaints.*
                            FROM complaints
                            JOIN citizen ON complaints.citi_id = citizen.id
                            WHERE pickup_status = 'Completed'";
                            $result = $conn->query($sql);
                            $driver = $conn->query("SELECT * FROM driver WHERE isBlocked=0 AND isVerified=1");
                            // $num =  1;
                            $hasData  = false;
                            if ($result->num_rows >= 0) {
                                while($row = $result->fetch_assoc()) {
                                    $hasData = true;
                                    echo "<tr>
                                            <td>{$row['com_id']}</td>
                                            <td>{$row['citi_name']}</td>
                                            <td><{$row['type']}<br>{$row['description']}</td>
                                            <td>{$row['location']}</td>
                                            <td>{$row['admin_status']}</td>
                                            <td>{$row['pickup_status']}</td>
                                        </tr>";
                                }
                            }else if(!$hasData) {
                                echo "<tr>
                                        <td colspan='6'>0 results</td>
                                    </tr>";
                            }
                            ?>
                    </table>
                </div>
                <div id="payments" class="body-item">
                    <h1>Hello Payments</h1>
                </div>
                <div id="logOut" class="body-item">
                </div>
            </div>
        </div>
    </div>




    <script src="../admin/dashboard.js?v=<?php echo time(); ?>"></script>


    <!-- Leaflet CSS + JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
    let map, marker;

    function openDeliveryModal(orderId, address) {
        document.getElementById("deliveryModal").style.display = "block";
        document.getElementById("orderIdInput").value = orderId;

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address + ', West Bengal, India')}`)
            .then(response => response.json())
            .then(data => {
                let lat = 22.9786;  // Approx center of West Bengal
                let lon = 87.7470;

                if (data.length > 0) {
                    lat = parseFloat(data[0].lat);
                    lon = parseFloat(data[0].lon);
                }

                // Reset map container if already exists
                if (map) {
                    map.remove();
                    document.getElementById("select-map").innerHTML = "<div id='select-map' style='height: 300px;'></div>";
                }

                map = L.map('select-map').setView([lat, lon], 10); // Zoom level 10 fits West Bengal
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                marker = L.marker([lat, lon], {draggable: true}).addTo(map);
                document.getElementById("latitudeInput").value = lat;
                document.getElementById("longitudeInput").value = lon;

                marker.on('dragend', function (e) {
                    const {lat, lng} = marker.getLatLng();
                    document.getElementById("latitudeInput").value = lat;
                    document.getElementById("longitudeInput").value = lng;
                });

                map.on('click', function (e) {
                    marker.setLatLng(e.latlng);
                    document.getElementById("latitudeInput").value = e.latlng.lat;
                    document.getElementById("longitudeInput").value = e.latlng.lng;
                });
            })
            .catch(error => {
                console.error("Geocoding error:", error);
                alert("Could not find address. Please place the pin manually within West Bengal.");
            });
    }

    function closeDeliveryModal() {
        document.getElementById("deliveryModal").style.display = "none";
    }
</script>





    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous">
        </script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        // let table1 = new DataTable('#table1');
        // let table2 = new DataTable('#verified_table');
        // let table3 = new DataTable('#unverified_table');
        // let table4 = new DataTable('#blocked_table');
        // let table5 = new DataTable('#user_dustbin');
        // let table6 = new DataTable('#dustbin_details');
    </script>
</body>

</html>