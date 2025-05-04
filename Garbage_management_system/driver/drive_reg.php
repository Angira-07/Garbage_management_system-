<?php
session_start();
include '../main/db_connect.php';

// $errorDrivePhone = $errorDriveEmail = $errorDriveUsername = "";
// echo"hello";

if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['drive_reg'])){
    $name = $_POST['name'];
    $dob = $_POST['dob'];       
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];       
    $email = $_POST['email'];

    $house = $_POST['house'];
    $locality = $_POST['locality']; 
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $address = $house . ", " . $locality . ", " . $city . " - " . $pincode . ", " . $state;

    $licenseType = $_POST['licenseType'];
    $licenseNumber = $_POST['licenseNumber'];   
    $vehicleType = $_POST['vehicleType'];
    $vehicleNumber = $_POST['vehicleNumber'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];
    
    // var_dump($name, $dob, $gender, $phone, $email, $address, $licenseType, $licenseNumber, $vehicleType, $vehicleNumber, $username, $hashed_password);
    
    
    $emailCheck = "SELECT * FROM `driver` WHERE `email`='$email'";
    $phoneCheck = "SELECT * FROM `driver` WHERE `phone`='$phone'";
    $usernameCheck = "SELECT * FROM `driver` WHERE `username`='$username'";
    $emailResult = $conn->query($emailCheck);
    $phoneResult = $conn->query($phoneCheck);
    $usernameResult = $conn->query($usernameCheck);
    
    $hasError = false;
    
    if($emailResult->num_rows > 0) {
        $_SESSION['errorDriveEmail'] = "Email already exists!";
        $hasError = true;
        echo $hasError;
    }
    if($phoneResult->num_rows > 0) {
        $_SESSION['errorDrivePhone'] = "Phone number already exists!";
        $hasError = true;
        echo $hasError;
    }
    if($usernameResult->num_rows > 0) {
        $_SESSION['errorDriveUsername'] = "Username already exists!";
        $hasError = true;
        echo $hasError;
    } 
    if($password !== $confirmPass){
        $_SESSION['errorDrive_PassNotMatch'] = "Please make sure the password is matched.";
        $hasError = true;
        echo $hasError;
    }
    // echo $errorEmail . " " . $errorPhone . " " . $errorUsername;
    if($hasError === false) {
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO `driver` (`name`, `dob`, `gender`, `phone`, `email`, `address`, `licenseType`, `licenseNumber`, `vehicleType`, `vehicleNumber`, `username`, `password`) 
        VALUES ('$name', '$dob', '$gender', '$phone', '$email', '$address', '$licenseType', '$licenseNumber', '$vehicleType', '$vehicleNumber', '$username', '$hashed_password')";
        

        if($conn->query($sql)==TRUE)
        {
            $_SESSION['drive_submit'] = "Your account is succenfully created.";
            echo "<script>
                    alert('You have successfully registered.');
                    window.location.href = '/Garbage_management_system/main/index.php#driver_log';
                </script>";
                exit();
        }else{
            $_SESSION['error'] = "Sorry! There is some server issue.";
        }
    }

    else{
        header("Location:/Garbage_management_system/main/index.php#driver_reg");
        exit();
        // echo $conn->error;
        // echo $hasError;
    }
}


?>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver_Registration</title>
    <link rel="stylesheet" href="../driver/drive_reg.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../main/navigation.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="../main/footer.css?v=<?= time(); ?>">
</head>
<body> -->
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
            <h1>Drive Towards a Cleaner Tomorrow</h1>
            <p style="padding:10px; font-size:16px;">Fill in your details and become a waste warrior.</p>
        </div>
        <form action="drive_reg.php" method="POST">
             <?php
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
             <fieldset>
                <legend>Personal Details</legend>
                <div class="form-group">
                    <input type="text" name="name" required placeholder="Full Name">
                </div>

                <div class="form-group">
                    <input type="date" name="dob" required placeholder="Date of Birth">
                </div>

                <div class="form-group">
                    <select name="gender" required>
                        <option value="">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <div class="phone">
                        <input type="number" name="phone" pattern="[0-9]{10}" maxlength="10" placeholder="Phone Number">
                        <span style="text-align:left;" class="error"><?php if(!empty($errorPhone)){echo $errorPhone;} ?>
                    </div>
                    <button type="button" class="otp">Verify OTP</button>
                </div>

                <div class="form-group">
                    <input type="email" name="email" required placeholder="Email Address">
                    <span style="text-align:left;" class="error"><?php if(!empty($errorEmail)){echo $errorEmail;} ?>
                </div>
            </fieldset>
        
            <fieldset>
                <legend>Address & Location Details</legend>

                <div class="form-group">
                    <input type="text" name="house" required placeholder="House No. / Apartment Name">
                </div>

                <div class="form-group">
                    <input type="text" name="locality" placeholder="Street Name / Locality">
                </div>

                <div class="form-group">
                    <input type="text" name="city" required placeholder="City Name">
                </div>

                <div class="form-group">
                    <input type="number" name="pincode" required placeholder="Pincode">
                </div>

                <div class="form-group">
                    <input type="text" name="state" required placeholder="State Name">
                </div>

                <div class="form-group">
                    <input type="text" name="location" placeholder="Google Map Location (Optional)">
                </div>
            </fieldset>

            <fieldset>
            <legend>License & Vehicle Details</legend>
                <div class="form-group">
                    <input type="text" name="licenseType" required placeholder="License Type (e.g., LMV, HMV)">
                </div>
                <div class="form-group">
                    <input type="text" name="licenseNumber" placeholder="Driver's License Number" required><br><br>
                </div>
                <div class="form-group">
                    <select name="vehicleType" required>
                        <option value="">-- Select Vehicle Type --</option>
                        <option value="car">Car</option>
                        <option value="bike">Bike</option>
                        <option value="truck">Truck</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="vehicleNumber" placeholder="Vehicle Number" required>
                </div>
            </fieldset>
        
            <fieldset>
            <legend>Login Credentials</legend>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" required>
                    <span style="text-align:left;" class="error"><?php if(!empty($errorUsername)){echo $errorUsername;} ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirmPassword" id="confirmPassword" oninput="checkPasswordMatch()" placeholder="Confirm Password" required><br>
                    <span id="message"></span>
                </div>
            </fieldset>
            <div class="form-group">
                  <button name='submit' type="submit">Register</button>
            </div>
            <div class="form-group">
                <a href="/Garbage_management_system/driver/drive_log.php"><p>Already have an account?&nbsp;&nbsp;Login</p></a>
            </div>
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
      
<!-- <script>
    function checkPasswordMatch() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const message = document.getElementById("message");

    if (confirmPassword === "") {
    message.textContent = "";
  } else if (password === confirmPassword) {
    message.textContent = "Passwords match";
    message.className = "match";
  } else {
    message.textContent = "Passwords do not match";
    message.className = "mismatch";
  }
}
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html> -->