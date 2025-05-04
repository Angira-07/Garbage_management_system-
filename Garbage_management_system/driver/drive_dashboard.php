<?php
session_start();
include '../main/db_connect.php';

if(!(isset($_SESSION['user']))){
    header("location:/Garbage_management_system/main/index.php#driver_log");
    exit();
}
$username = $_SESSION['user']['username'];
$sql= "SELECT * FROM `driver` WHERE `username` = '$username'";
$result = $conn->query($sql);
$driver = $result->fetch_assoc();


if(isset($_POST['update_phone_btn'])){
    $update_value = $_POST['update_phone'];
    $update_id = $_POST['update_phone_id'];
    $update = "UPDATE `driver` SET phone = '$update_value' WHERE id = '$update_id'";
    if($conn->query($update)){
        header('location:drive_dashboard.php');
        exit();
    };
 };
if(isset($_POST['update_email_btn'])){
    $update_value = $_POST['update_email'];
    $update_id = $_POST['update_email_id'];
    $update = "UPDATE `driver` SET email = '$update_value' WHERE id = '$update_id'";
    if($conn->query($update)){
        header('location:drive_dashboard.php');
        exit();
    };
 };

if(isset($_POST['pickup_update'])){
    $id = $_POST['id'];
    $status = $_POST['status'];
    $update = "UPDATE `complaints` SET pickup_status = '$status' WHERE id = '$id'";
    if($conn->query($update)){
        header('location:drive_dashboard.php');
        exit();
    };
}
function getTotalPending($conn, $driver_id) {
    // $driver_id = $driver['id'];
    $totalCitizens = "SELECT COUNT(*) AS total FROM complaints WHERE pickup_status != 'Completed' and driver_id = '$driver_id'";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}
function getTotalCompleted($conn, $driver_id) {
    $totalCitizens = "SELECT COUNT(*) AS total FROM complaints WHERE pickup_status = 'Completed' and driver_id = '$driver_id'";
    $citizens = $conn->query($totalCitizens);
    $rows = $citizens->fetch_assoc();
    return $rows['total'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver_Dashboard</title>
    <link rel="stylesheet" href="\Garbage_management_system\driver\drive_dashboard.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\citizen\user_content.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head>
<body>
    <div class="main">
        <div class="menu">       
                <a id="1" class="menu-item" onclick="showPage('dashboard','1')">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">
                        Dashboard
                    </span>
                </a>
                <a id="3" class="menu-item" onclick="showPage('pending_complains', '3')">
                    <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <span class="title">
                        Pickup Complain
                    </span>
                </a>
                <a id="4" class="menu-item" onclick="showPage('complete_complains', '4')">
                    <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <span class="title">
                        Completed Complain
                    </span>
                </a>

            
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
                            <?php echo "<p>Welcome, " . $driver['name'] . "</p>"; ?>
                        </span>
                        <span class="time">
                            <?php echo date("l: F d,Y"); ?>
                        </span>
                    </span>
                </div>
                <div id="user-content">
                    <span class="name">
                        <?php echo "<p>Hello, " . $driver['name'] . "</p>"; ?>
                    </span>
                    <div class="contact">
                        <div class="phone">
                            <?php echo "
                                <form action='' method='post' style='display:flex; align-items:center;'>
                                    <input type='hidden' name='update_phone_id'  value='{$driver['id']}' >
                                    <input type='number' name='update_phone' value='{$driver['phone']}' style='width:auto; min-width:50px; border:none; background:transparent; height: 20px;' >
                                    <button type='submit' name='update_phone_btn' style='background:none; border:none;'>
                                            <ion-icon name='create-outline' style'font-size: 20px;'></ion-icon>
                                    </button>                                            
                                </form> ";
                            ?>
                        </div>
                        <div class="email">
                            <?php echo "
                                <form action='' method='post' style='display:flex; align-items:center;'>
                                    <input type='hidden' name='update_email_id'  value='{$driver['id']}' >
                                    <input type='email' name='update_email' value='{$driver['email']}' style='width:auto; min-width:50px; border:none; background:transparent; height: 20px;' >
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
                        <?php echo "<p>{$driver['address']}</p>"; ?>
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
                    <div class="notification">
                        <ion-icon name="notifications-outline"></ion-icon>
                    </div>
                    <div class="logout" onclick="window.location.href='/Garbage_management_system/driver/log_out.php'">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </div>
                </div>
            </nav>
            <div class="body">
                <div id="dashboard" class="body-item active">
                    <div class="box-items">
                        <div class="box">
                            <span class="icon">
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalCompleted($conn, $driver['id']); ?>
                                <p>Active Completed Pickups</p>
                            </span>
                        </div>
                        <div class="box">
                            <span class="icon">
                                <ion-icon name="hourglass-outline"></ion-icon>
                            </span>
                            <span class="number">
                                <?php echo getTotalPending($conn, $driver['id']); ?>
                                <p>Pending Garbage pickups</p>
                            </span>
                        </div>
                    </div>
                    <div class="details" style="width: 100%; position: absolute; right: 0;">

                    </div>
                </div>
                <div id="pending_complains"  class="body-item">
                    <table id="pendingComplain_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Complain_ID</th>
                                <th>Complained By</th>
                                <th>Complain Type with Description</th>
                                <th>Address</th>
                                <th>Update Pickup Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $driver_id = $driver['id'];
                            $sql = "SELECT 
                            complaints.id AS com_id,
                            citizen.name AS citi_name,
                            complaints.*
                            FROM complaints
                            JOIN citizen ON complaints.citi_id = citizen.id
                            WHERE admin_status = 'Approved' and driver_id = '$driver_id'";
                            
                            $result = $conn->query($sql);
                            $hasData = false;
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    if($row['pickup_status'] !== 'Completed'){
                                        $hasData = true;
                                        echo "<tr>
                                        <td>{$row['com_id']}</td>
                                        <td>{$row['citi_name']}</td>
                                        <td>{$row['type']}<br>{$row['description']}</td>
                                        <td>{$row['location']}</td>
                                        <td>
                                            <form action='' method='POST'>
                                                <label for='status'>Update Status</label>
                                                <select name='status' id='complain_status'>
                                                    <option value='Not Started'" . ($row['pickup_status'] == 'Not Started' ? ' selected' : '') . ">Not Started</option>
                                                    <option value='On the Way'" . ($row['pickup_status'] == 'On the Way' ? ' selected' : '') . ">On the Way</option>
                                                    <option value='Completed'" . ($row['pickup_status'] == 'Completed' ? ' selected' : '') . ">Completed</option>
                                                </select>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <button name='pickup_update'>Update</button>
                                            </form>
                                        
                                        </td>
                                        </tr>";
                                    }
                                }
                            }
                            if (!$hasData) {
                                echo "<tr><td colspan='5'>No pending complaints found</td></tr>";
                            }
                        
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="complete_complains"  class="body-item">
                    <table id="pendingComplain_table" border="1" cellspacing="0" cellpadding="10">
                        <thead>
                            <tr>
                                <th>Complain_ID</th>
                                <th>Complained By</th>
                                <th>Complain Type with Description</th>
                                <th>Address</th>
                                <th>Pickup Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $driver_id = $driver['id'];
                            $sql = "SELECT 
                            complaints.id AS com_id,
                            citizen.name AS citi_name,
                            complaints.*
                            FROM complaints
                            JOIN citizen ON complaints.citi_id = citizen.id
                            WHERE pickup_status = 'Completed' AND driver_id = '$driver_id'";
                            
                            $result = $conn->query($sql);
                            $hasData = false;
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                        $hasData = true;
                                        echo "<tr>
                                        <td>{$row['com_id']}</td>
                                        <td>{$row['citi_name']}</td>
                                        <td>{$row['type']}<br>{$row['description']}</td>
                                        <td>{$row['location']}</td>
                                        <td>{$row['pickup_status']}</td>
                                        </tr>";
                                                // <button type='button' onclick=\"openForm({$row['com_id']})\">Update Status</button> 
                                    
                                }
                            }
                            if (!$hasData) {
                                echo "<tr><td colspan='5'>No pending complaints found</td></tr>";
                            }
                        
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="drive-script.js?v=<?= time(); ?>"></script>





<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous">
</script>
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        let table1 = new DataTable('#table1');
        let table2 = new DataTable('#table2');
        let table3 = new DataTable('#table3');
    </script>
</body>
</html>