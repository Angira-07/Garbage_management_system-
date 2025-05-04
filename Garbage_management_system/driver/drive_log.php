<?php
session_start();
include '../main/db_connect.php';

// $errorUser = $errorPassword = $errorVerify = "";

if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['driver_login'])){
    $user = $_POST['user'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `driver` WHERE `username` = '$user'";
    $result = $conn->query($sql);
    $driver = $result->fetch_assoc();

    if($driver){
        if(password_verify($password, $driver['password'])){
            if($driver['isBlocked'] == 0){
                if($driver['isVerified'] == 1){
                    $_SESSION['user'] = $driver;
                    header("Location: /Garbage_management_system/driver/drive_dashboard.php");
                    exit();
                } else {
                    $_SESSION['errorDriverVerify'] = "Your account is pending admin approval.";
                    header("Location: /Garbage_management_system/main/index.php");
                    exit();
                    header("Location: /Garbage_management_system/main/index.php");
                    exit();
                }
            }
            else{
                $_SESSION['errorDriverVerify'] = "Your account is blocked. Please Contact admin.";
                header("Location: /Garbage_management_system/main/index.php");
                exit();
            }
        } else {
            $_SESSION['errorDriverPassword'] = "Invalid password!";
            header("Location: /Garbage_management_system/main/index.php");
            exit();
        }
    } else {
        $_SESSION['errorDriver'] = "No user found with this username.";
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
    <title>Driver_Login</title>
    <link rel="stylesheet" href="/Garbage_management_system/driver/drive_log.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/Garbage_management_system/main/navigation.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="/Garbage_management_system/main/footer.css?v=<?= time(); ?>">
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
        <form method="POST" action="drive_log.php">
        
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
            <div class="form-group links">
                <a href="drive_reg.php"><p>Forgot Password</p></a>
                <a href="/Garbage_management_system/driver/drive_reg.php"><p>Don't Have an account?</p></a>
            </div>
        </form>
    </div>
 -->
    <!-- <footer>
        <div class="footer">
            <div class="links">
                <span class="link-box about">
                        <h1>About</h1>
                        <p>Loaction based Garbage Management System for smart city</p>
                </span>

                <span class="link-box quickLinks">
                        <h1>Quick Links</h1>
                        <a href="home.html">home</a>
                        <a href="features.html">Features</a>
                        <a href="project.html">Project</a>
                        <a href="contact.html">Contact</a>
                </span>

                <span class="link-box contact">
                        <h1>Contact</h1>
                        <p>Email: abc@gmail.com</p>
                        <p>Ph : 821141341241</p>
                </span>
            </div>
            <div class="footer-bottom">
                <div class="copyRights">
                    <p>@copy smart city. All rights reserved.</p>
                </div>
                <div class="icon">
                    <ion-icon class="facebook" name="logo-facebook"></ion-icon>
                    <ion-icon class="youtube" name="logo-youtube"></ion-icon>
                    <ion-icon class="twitter" name="logo-twitter"></ion-icon>
                    <ion-icon class="instagram" name="logo-instagram"></ion-icon>
                    <ion-icon class="linkedin" name="logo-linkedin"></ion-icon>
                </div>
            </div>
        </div>
    </footer> -->
</body>
</html>