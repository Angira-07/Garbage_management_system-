<?php
session_start();
include '../main/db_connect.php';

$errorAdmin = $errorAdminPassword = "";

if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['admin_login'])){
    $user = $_POST['user'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE `username` = '$user'";
    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();

    if($admin){
        if(password_verify($password, $admin['password'])){
            $_SESSION['user'] = $admin;
                header("Location: /Garbage_management_system/admin/dashboard.php");
                exit();
        } else {
            $_SESSION['errorAdminPassword'] = "Invalid password!";
            header("Location: /Garbage_management_system/main/index.php");
            exit();
        }
    } else {
        $_SESSION['errorAdmin'] = "No user found with this username.";
        header("Location: /Garbage_management_system/main/index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Login</title>
    <link rel="stylesheet" href="/Garbage_management_system/admin/admin_log.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/Garbage_management_system/main/navigation.css?v=<?= time(); ?>">
</head>
<body>
    <!-- <nav id="navbar">
        <div id="logo">
            <div class="logo-image">
                <img src="/Garbage_management_system/photos/home/logo.png" alt="logo" width="40px">
            </div>
            <span class="text">
                <span class="text-1">Gogreen</span>
                <span class="text-2">Recycling</span>
            </span>
        </div>
        <div class="navigation">
            <ul class="nav-list">
                <li class="nav-item"><a href="/Garbage_management_system/main/index.php">Home</a></li>
                <li class="nav-item"><a href="#">About</a></li>
                <li class="nav-item"><a href="#">Services</a></li>
                <li class="nav-item"><a href="#">Contact</a></li>
            </ul>
            <div class="login">
                <button class="loginbtn">Login</button>
                <ul class="login-list">
                    <li class="login-item"><a href="/Garbage_management_system/admin/admin_log.php">Administration</a></li>
                    <li class="login-item"><a href="/Garbage_management_system/driver/drive_log.php">Garbage Collecter</a></li>
                    <li class="login-item"><a href="/Garbage_management_system/citizen/citi_log.php">Citizen</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="box">
        <div class="text">
            <h1>Engine Started? Let’s Log You In  </h1>
            <h3>Enter your credentials to hit the road.</h3>
        </div>
        <form method="POST" action="admin_log.php">
        
             <span class="error"><?php if(!empty($errorVerify)) echo $errorVerify; ?></span>
            <div class="form-group username">
                    <input type="text" name="user" placeholder="Username" required>
                    <span class="error"><?php if(!empty($errorUser)) echo $errorUser; ?></span>              
                </div>
            <div class="form-group password">
                    <input type="password" name="password" placeholder="Password" required>
                    <span class="error"><?php if(!empty($errorPassword)) echo $errorPassword; ?></span>
            </div>
            <div class="form-group checkbox">
                    <input type="checkbox" id="remember-me" name="remember-me" required>
                    <label for="remember-me">Remember Me</label>
                </div>
            <div class="form-group">
                    <button type="submit">Login</button>
                </div>
        </form>
    </div> -->
</body>
</html>