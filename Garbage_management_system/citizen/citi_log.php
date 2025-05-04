<?php
session_start();
include '../main/db_connect.php';

$errorUser = $errorPassword = "";

if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['citi_login'])){
    $user = $_POST['user'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `citizen` WHERE (`email` = '$user' OR `phone` = '$user')";
    $result = $conn->query($sql);
    $citizen = $result->fetch_assoc();

    if($citizen){
        if(password_verify($password, $citizen['password'])){
            $_SESSION['citizen_ph'] = $citizen['phone'];
            $_SESSION['citizen_email'] = $citizen['email'];
            header("Location: /Garbage_management_system/citizen/citi_dashboard.php");
            exit();
        } else {
            // $errorPassword = "Invalid password!";
            $_SESSION['errorCitizenPassword'] = "Invalid password!";
            header("Location: /Garbage_management_system/main/index.php");
            exit();
            // $_SESSION['message-type'] = "success";
        }
    }else{
        // $errorUser = "No user found with this email or phone number.";
        $_SESSION['errorCitizen'] = "No user found with this email or phone number.";
        header("Location: /Garbage_management_system/main/index.php");
            exit();
        // $_SESSION['message-type'] = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen_Login</title>
    <link rel="stylesheet" href="/Garbage_management_system/citizen/citi_log.css?v=<?= time(); ?>">
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
            <h1>Welcome Back, Eco-Warrior! </h1>
            <h3>Login to manage your smart city services.</h3>
        </div>
        <form method="POST" action="citi_log.php">
            <div class="form-group username">
                <input type="text" name="user" placeholder="Emai Id / Phone no" required>
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
                <a href="citi_reg.php">Forgot Password</a>
                <a href="/Garbage_management_system/citizen/citi_reg.php"><p>Don't Have an account?</p></a>
        </form>
    </div> -->


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