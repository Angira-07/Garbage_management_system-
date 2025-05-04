<?php 
session_start();
//citizen login
$errorCitizen = $errorCitizenPassword = "";
if(isset($_SESSION['errorCitizenPassword'])){
    $errorCitizenPassword = $_SESSION['errorCitizenPassword'];
    unset($_SESSION['errorCitizenPassword']);
}
if(isset($_SESSION['errorCitizen'])){
    $errorCitizen = $_SESSION['errorCitizen'];
    unset($_SESSION['errorCitizen']);
}
//driver login
$errorDriver = $errorDriverPassword = $errorDriverVerify = "";
if(isset($_SESSION['errorDriver'])){
    $errorDriver = $_SESSION['errorDriver'];
    unset($_SESSION['errorDriver']);
}
if(isset($_SESSION['errorDriverPassword'])){
    $errorDriverPassword = $_SESSION['errorDriverPassword'];
    unset($_SESSION['errorDriverPassword']);
}
if(isset($_SESSION['errorDriverVerify'])){
    $errorDriverVerify = $_SESSION['errorDriverVerify'];
    unset($_SESSION['errorDriverVerify']);
}
//admin login
$errorAdmin = $errorAdminPassword = "";
if(isset($_SESSION['errorAdmin'])){
    $errorAdmin = $_SESSION['errorAdmin'];
    unset($_SESSION['errorAdmin']);
}
if(isset($_SESSION['errorAdminPassword'])){
    $errorAdminPassword = $_SESSION['errorAdminPassword'];
    unset($_SESSION['errorAdminPassword']);
}
//citizen registration
$errorCitiEmail = $errorCitiPhone = $errorCiti_PassNotMatch = "";
if(isset($_SESSION['errorCitiEmail'])){
    $errorCitiEmail = $_SESSION['errorCitiEmail'];
    unset($_SESSION['errorCitiEmail']);
}
if(isset($_SESSION['errorCitiPhone'])){
    $errorCitiPhone = $_SESSION['errorCitiPhone'];
    unset($_SESSION['errorCitiPhone']);
}
if(isset($_SESSION['errorCiti_PassNotMatch'])){
    $errorCiti_PassNotMatch = $_SESSION['errorCiti_PassNotMatch'];
    unset($_SESSION['errorCiti_PassNotMatch']);
}
if(isset($_SESSION['citi_submit'])){
    $citi_submit = $_SESSION['citi_submit'];
    unset($_SESSION['submit']);
}

//driver registration
$errorDrivePhone = $errorDriveEmail = $errorDriveUsername = "";
if(isset($_SESSION['errorDrivePhone'])){
    $errorDrivePhone = $_SESSION['errorDrivePhone'];
    unset($_SESSION['errorDrivePhone']);
}
if(isset($_SESSION['errorDriveEmail'])){
    $errorDriveEmail = $_SESSION['errorDriveEmail'];
    unset($_SESSION['errorDriveEmail']);
}
if(isset($_SESSION['errorDriveUsername'])){
    $errorDriveUsername = $_SESSION['errorDriveUsername'];
    unset($_SESSION['errorDriveUsername']);
}
if(isset($_SESSION['errorDrive_PassNotMatch'])){
    $errorDrive_PassNotMatch = $_SESSION['errorDrive_PassNotMatch'];
    unset($_SESSION['errorDrive_PassNotMatch']);
}
if(isset($_SESSION['citi_submit'])){
    $citi_submit = $_SESSION['citi_submit'];
    unset($_SESSION['submit']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="/Garbage_management_system/photos/home/apple-touch-icon.png">

    <link rel="stylesheet" href="\Garbage_management_system\main\index.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\main\citi_log.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\main\register.css?v=<?= time(); ?>">
    <!-- <link rel="stylesheet" href="\Garbage_management_system\main\footer.css?v=<?= time(); ?>"> -->
    <link rel="stylesheet" href="\Garbage_management_system\main\form.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="\Garbage_management_system\main\navigation.css?v=<?= time(); ?>">

</head>

<body>
    <nav id="navbar">
        <div id="logo">
            <div class="logo-image">
                <img src="/Garbage_management_system/photos/home/logo_2.png" alt="logo" width="180px"
                    style="padding:5px 10px;">
            </div>
            <!-- <span class="text">
                <span class="text-1">Gogreen</span>
                <span class="text-2">Recycling</span>
            </span> -->
        </div>
        <div class="navigation">
            <ul class="nav-list">
                <li class="nav-item"><a href="/Garbage_management_system/main/index.php">Home</a></li>
                <li class="nav-item"><a href="#second">About</a></li>
                <li class="nav-item"><a href="#forth">Services</a></li>
                <li class="nav-item"><a href="#six">Dustbins</a></li>
            </ul>
            <div class="login-box">
                <button class="loginbtn">Login</button>
                <ul class="login-list">
                    <li class="login-item" id="admin_loginBtn"><a href="#"
                            onclick="showCitizen('admin_log', 'main-content')">Administration</a>
                    </li>
                    <li class="login-item" id="drive_loginBtn"><a href="#"
                            onclick="showCitizen('driver_log', 'main-content')">Garbage
                            Collecter</a></li>
                    <li class="login-item" id="citi_loginBtn"><a href="#"
                            onclick="showCitizen('citi_log', 'main-content')">Citizen</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="login-pages">
        <section id="citi_log" class="login unvisible">
            <div class="container">
                <ion-icon onclick="closeForm('citi_log', 'main-content')" id="citi_close" name="close"></ion-icon>
                <div class="item">
                    <h1>🌿Welcome Back, Eco-Warrior! </h1>
                    <div class="paragraph">
                        <p>you're one click closer to building a greener tomorrow!</p>
                    </div>
                </div>
                <div class="form-item">
                    <h3>User Login</h3>
                    <form method="POST" action="../citizen/citi_log.php">
                        <!-- <div class="input-error"> -->
                        <div class="input-box">
                            <input type="text" name="user" id="citizenInput" required>
                            <label for="username">Emai Id / Phone no</label>
                            <span class="error">
                                <?php if(!empty($errorCitizen)) echo $errorCitizen; ?>
                            </span>
                        </div>
                        <!-- </div> -->
                        <!-- <div class="input-error"> -->
                        <div class="input-box">
                            <input type="password" name="password" required>
                            <label for="password">Password</label>
                            <span class="error">
                                <?php if(!empty($errorCitizenPassword)) echo $errorCitizenPassword; ?>
                                <!-- <span class="error">error</span> -->
                            </span>
                        </div>
                        <!-- </div> -->
                        <div class="remember-forgot">
                            <div class="remember">
                                <input type="checkbox" name="remember-me" checked>
                                <label for="remember-me">Remember Me</label>
                            </div>
                            <!-- <div class="forgot">
                                <a href="#"  onclick="showCitizen('citi_forgot', 'main-content')">Forgot Password</a>
                            </div> -->
                        </div>
                        <div class="btn">
                            <button name="citi_login" type="submit">Login</button>
                        </div>
                        <div class="register">
                            <p>New User?</p><a href="#" onclick="showCitizen('citi_reg', 'main-content')">
                                <p>Register Now</p>
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </section>
        <!-- <section id="citi_forgot" class="login unvisible">
            <h3>Reset Password</h3>
            <div class="container">
                <ion-icon onclick="closeForm('citi_forgot', 'main-content')" id="citi_close" name="close"></ion-icon>
                <div class="item">
                    <h1>Oops! It happens to the best of us.</h1>
                    <div class="paragraph">
                        <p>Enter your email below to receive a secure link to reset your password.</p>
                    </div>
                </div>
                <div class="form-item">
                    <form method="POST" action="../citizen/citi_forgot.php">
                        <div class="input-box">
                            <input type="email" name="email" required>
                            <label for="email">Enter your Email Id</label>
                        </div>
                        <div class="btn">
                            <button name="citi_forgot_password" type="submit">Send Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </section> -->

        <section id="driver_log" class="login unvisible">
            <h3>Garbage Collector Login</h3>
            <div class="container">
                <ion-icon onclick="closeForm('driver_log', 'main-content')" id="citi_close" name="close"></ion-icon>
                <div class="item">
                    <h1>🚛 Welcome Back, Clean City Hero! </h1>
                    <div class="paragraph">
                        <p>Your efforts keep the city cleaner, greener, and smarter — one collection at a time!</p> 
                    </div>
                </div>
                <div class="form-item">
                    <form method="POST" action="../driver/drive_log.php">
                        <span class="top-error">
                            <?php if(!empty($errorDriverVerify)) echo $errorDriverVerify; ?>
                        </span>
                        <!-- <span class="top-error">hello</span> -->
                        <div class="input-box">
                            <input type="text" name="user" required>
                            <label for="username">Username</label>
                            <span class="error">
                                <?php if(!empty($errorDriver)) echo $errorDriver; ?>
                            </span>
                        </div>
                        <!-- </div> -->
                        <!-- <div class="input-error"> -->
                        <div class="input-box">
                            <input type="password" name="password" required>
                            <label for="password">Password</label>
                            <span class="error">
                                <?php if(!empty($errorDriverPassword)) echo $errorDriverPassword; ?>
                            </span>
                        </div>
                        <!-- </div> -->
                        <div class="remember-forgot">
                            <div class="remember">
                                <input type="checkbox" name="remember-me" checked>
                                <label for="remember-me">Remember Me</label>
                            </div>
                            <!-- <div class="forgot">
                                <a href="citi_reg.php">Forgot Password</a>
                            </div> -->
                        </div>
                        <div class="btn">
                            <button name="driver_login" type="submit">Login</button>
                        </div>
                        <div class="register">
                            <p>New User?</p><a href="#" onclick="showCitizen('driver_reg', 'main-content')">
                                <p>Register Now</p>
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </section>
        <section id="admin_log" class="login unvisible">
            <h3>Admin Login</h3>
            <div class="container">
                <ion-icon onclick="closeForm('admin_log', 'main-content')" id="citi_close" name="close"></ion-icon>
                <div class="item">
                    <h1>Welcome Back, Eco-Warrior! </h1>
                    <div class="paragraph">
                        <p>you're one click closer to building a greener tomorrow!</p>
                    </div>
                </div>
                <div class="form-item">
                    <form method="POST" action="../admin/admin_log.php">
                        <!-- <div class="input-error"> -->
                        <div class="input-box">
                            <input type="text" name="user" required>
                            <label for="username">Username</label>
                            <span class="error">
                                <?php if(!empty($errorAdmin)) echo $errorAdmin; ?>
                            </span>
                        </div>
                        <!-- </div> -->
                        <!-- <div class="input-error"> -->
                        <div class="input-box">
                            <input type="password" name="password" required>
                            <label for="password">Password</label>
                            <span class="error">
                                <?php if(!empty($errorAdminPassword)) echo $errorAdminPassword; ?>
                                <!-- <span class="error">error</span> -->
                            </span>
                        </div>
                        <!-- </div> -->
                        <div class="remember-forgot">
                            <div class="remember">
                                <input type="checkbox" name="remember-me" checked>
                                <label for="remember-me">Remember Me</label>
                            </div>
                            <!-- <div class="forgot">
                                <a href="citi_reg.php">Forgot Password</a>
                            </div> -->
                        </div>
                        <div class="btn">
                            <button name="admin_login" type="submit">Login</button>
                        </div>
                        <!-- <div class="register">
                            <p>New User?</p><a href="/Garbage_management_system/citizen/citi_reg.php">
                                <p>Register Now</p>
                            </a>
                        </div> -->
                    </form>
                </div>

            </div>
        </section>
    </div>
    <div id="register-pages">
        <div id="citi_reg" class="register unvisible">
            <div class="container">
                <ion-icon onclick="closeForm('citi_reg', 'main-content')" class="close" name="close"
                    style="cursor: pointer;"></ion-icon>

                <div class="item">
                    <!-- <h3>Login</h3> -->
                    <h1>🏡 Become a Smart Citizen! </h1>
                    <div class="paragraph">
                        <p>Register Now to access waste pickup requests, track services, and join the movement for a cleaner, greener city.
                            Your small step helps build a sustainable tomorrow!</p>
                    </div>
                </div>
                <div class="form-item">
                    <form action="../citizen/citi_reg.php" method="post" id="citi_reg_form">
                        <fieldset class="step  active">
                            <legend>Personal Details</legend><br>
                            <div class="form-group">
                                <input type="text" name="name" id="citi_name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g,'')" required placeholder=" ">
                                <label for="name">Full Name</label>
                            </div>
                            <div class="form-group parent">

                                <div class="form-sub-group" id="citi-dob">
                                    <input type="date" name="dob" id="citi_birth" required placeholder=" ">
                                    <label for="dob">Date of Birth</label>
                                </div>
                                <div class="form-sub-group" id="required">
                                    <select name="gender" id="citi_gender" required>
                                        <option value="" disabled selected hidden></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>


                            <div class="phone">
                                <div class="form-group" id="tel">
                                    <input type="tel" name="phone" id="citi_phone" oninput="this.value = this.value.replace(/[^0-9]/g,'')" minlength="10" maxlength="10" required placeholder=" ">
                                    <label for="phone">Phone Number</label>
                                    <span class="error">
                                        <?php if(!empty($errorCitiPhone)){echo $errorCitiPhone;} ?>
                                    </span>
                                </div>
                                <button type="button" class="otp">Verify OTP</button>
                            </div>

                            <div class="form-group email">
                                <input type="email" name="email" id="citi_email" required placeholder=" ">
                                <label for="email">Email Address</label>
                                <span class="error">
                                    <?php if(!empty($errorCitiEmail)){echo $errorCitiEmail;} ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <input type="password" id="citi_password" name="password" required placeholder=" ">
                                <label for="password"> Password</label>
                                <span class="error">
                                     <?php if(!empty($errorCiti_PassNotMatch)){echo $errorCiti_PassNotMatch;} ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <input id="citi_confirmPass" type="password" name="confirmPass"
                                    oninput="checkPasswordMatch('citi_password', 'citi_confirmPass', 'citi_message')" required placeholder=" ">
                                <label for="confirmPass">Confirm Password</label>
                                <span id="citi_message" class="error"></span>
                            </div>
                            <!-- <ion-icon class="next" name="arrow-forward"></ion-icon> -->
                        </fieldset><br>

                        <fieldset class="step active">
                            <legend>Address & Location Details</legend><br>

                            <div class="form-group">
                                <input type="text" name="house" id="citi_house" required placeholder=" ">
                                <label for="house">House No. / Apartment Name</label>
                            </div>

                            <div class="form-group">
                                <input type="text" name="locality" id="citi_locality" required placeholder=" ">
                                <label for="locality">Street Name / Locality</label>
                            </div>

                            <div class="form-group parent">
                                <div class="form-sub-group">
                                    <input type="text" name="city" id="citi_city" required placeholder=" ">
                                    <label for="city">City</label>
                                </div>

                                <div class="form-sub-group">
                                    <input type="number" name="pincode" id="citi_pincode" oninput="this.value = this.value.replace(/[^0-9]/g,'')" required placeholder=" ">
                                    <label for="pincode">Pincode</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="state" id="citi_state" required placeholder=" ">
                                <label for="state">State</label>
                            </div>

                            <div class="form-group">
                                <input type="text" name="location" placeholder=" ">
                                <label for="location">Google Map Location (Optional)</label>
                            </div>
                            <!-- <ion-icon class="prev" name="arrow-back"></ion-icon> -->
                            <!-- <ion-icon class="next" name="arrow-forward"></ion-icon> -->
                        </fieldset><br>

                        <fieldset class="step active">
                            <legend>Waste Preferences (Optional) </legend><br><br>
                            <div class="form-group" id="optional">
                                <select name="wasteType">
                                    <!-- <option value=""  disabled></option> -->
                                    <option value="organic">Organic</option>
                                    <option value="plastic">Plastic</option>
                                    <option value="ewaste">E-Waste</option>
                                    <option value="medical">Medical</option>
                                    <option value="general">General</option>
                                </select>
                                <label for="wasteType">Type of Waste</label>
                            </div>
                            <div class="checkbox">
                                <label>Would You Like a Free Dustbin?</label>
                                <input type="checkbox" name="freeDustbin" value="yes" checked>
                            </div>
                            <div class="checkbox">
                                <label>Interested in Recycling Program?</label>
                                <input type="checkbox" name="interestRecycling" value="yes" checked>
                            </div><br>

                            <div class="checkbox agreement">
                                <label for="terms">I agree to the &nbsp;<a href="#">Terms & Conditions</a></label>
                                <input type="checkbox" name="termsCondition" value="agree" required>
                            </div><br>
                            <div class="btn">
                                <button type="submit" name="citi_reg"
                                    class="submit-btn">Submit
                                </button>
                            </div><br><br><br>
                            <div class="redirect">
                                <p>Already have an account?</p>
                                <a href="#" onclick="showCitizen('citi_log', 'main-content')">
                                    <p>Login</p>
                                </a>
                            </div>
                            <!-- <ion-icon class="prev" name="arrow-back"></ion-icon> -->
                        </fieldset>
                    </form>
                    <!-- <script>
                        showCitizen('citi_log', 'main-content');
                    </script> -->
                </div>
            </div>
        </div>
        <div id="driver_reg" class="register unvisible">
            <div class="container">
                <ion-icon onclick="closeForm('driver_reg', 'main-content')" class="close" name="close"
                    style="cursor: pointer;"></ion-icon>

                <div class="item">
                    <!-- <h3>Login</h3> -->
                    <h1>🚚 Join the Clean-Up Crew! </h1>
                    <div class="paragraph">
                        <p>Register as a Driver and become a part of our mission to build a cleaner, smarter city.
                            Manage pickups, track routes, and make an impact — every mile you drive matters!</p>
                    </div>
                </div>
                <div class="form-item">
                    <form action="../driver/drive_reg.php" method="post" id="drive_reg_form">
                        <fieldset class="step  active">
                            <legend>Personal Details</legend><br>
                            <div class="form-group">
                                <input type="text" name="name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g,'')" required placeholder=" ">
                                <label for="name">Full Name</label>
                            </div>
                            <div class="form-group parent">

                                <div class="form-sub-group" id="dob">
                                    <input type="date" name="dob" required placeholder=" ">
                                    <label for="dob">Date of Birth</label>
                                </div>
                                <div class="form-sub-group" id="required">
                                    <select name="gender" required>
                                        <option value="" disabled selected hidden></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>


                            <div class="phone">
                                <div class="form-group" id="tel">
                                    <input type="tel" name="phone" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g,'')" maxlength="10" required placeholder=" ">
                                    <label for="phone">Phone Number</label>
                                    <span class="error">
                                        <?php if(!empty($errorDrivePhone)){echo $errorDrivePhone;} ?>
                                    </span>
                                </div>
                                <button type="button" class="otp">Verify OTP</button>
                            </div>

                            <div class="form-group email">
                                <input type="email" name="email" required placeholder=" ">
                                <label for="email">Email Address</label>
                                <span class="error">
                                    <?php if(!empty($errorDriveEmail)){echo $errorDriveEmail;} ?>
                                </span>
                            </div>

                            <!-- <ion-icon class="next" name="arrow-forward"></ion-icon> -->
                        </fieldset><br>

                        <fieldset class="step active">
                            <legend>Address & Location Details</legend><br>

                            <div class="form-group">
                                <input type="text" name="house" required placeholder=" ">
                                <label for="house">House No. / Apartment Name</label>
                            </div>

                            <div class="form-group">
                                <input type="text" name="locality" required placeholder=" ">
                                <label for="locality">Street Name / Locality</label>
                            </div>

                            <div class="form-group parent">
                                <div class="form-sub-group">
                                    <input type="text" name="city" required placeholder=" ">
                                    <label for="city">City</label>
                                </div>

                                <div class="form-sub-group">
                                    <input type="number" name="pincode" oninput="this.value = this.value.replace(/[^0-9]/g,'')" required placeholder=" ">
                                    <label for="pincode">Pincode</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="state" required placeholder=" ">
                                <label for="state">State</label>
                            </div>

                            <div class="form-group">
                                <input type="text" name="location" placeholder=" ">
                                <label for="location">Google Map Location (Optional)</label>
                            </div>
                            <!-- <ion-icon class="prev" name="arrow-back"></ion-icon> -->
                            <!-- <ion-icon class="next" name="arrow-forward"></ion-icon> -->
                        </fieldset><br>

                        <fieldset class="step active">
                            <legend>License & Vehicle Details</legend><br>
                            <div class="form-group">
                                <input type="text" name="licenseType" required placeholder=" ">
                                <label for="licenseType">License Type (e.g., LMV, HMV)</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="licenseNumber" required placeholder=" ">
                                <label for="licenseNumber">Driver's License Number</label>
                            </div>
                            <div class="form-group">
                                <select name="vehicleType" required>
                                    <option value="" disabled selected hidden></option>
                                    <option value="car">Car</option>
                                    <option value="bike">Bike</option>
                                    <option value="truck">Truck</option>
                                </select>
                                <label for="vehicleType">-- Select Vehicle Type --</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="vehicleNumber" placeholder=" " required>
                                <label for="vehicleNumber">Vehicle Number</label>
                            </div>
                            <!-- <ion-icon class="prev" name="arrow-back"></ion-icon> -->
                            <!-- <ion-icon class="next" name="arrow-forward"></ion-icon> -->
                        </fieldset><br>

                        <fieldset class="step active">
                            <legend>Login Credentials</legend><br>
                            <div class="form-group">
                                <input type="text" name="username" placeholder=" " required>
                                <label for="username">Username</label>
                                <span style="text-align:left;" class="error">
                                    <?php if(!empty($errorDriveUsername)){echo $errorDriveUsername;} ?>
                            </div>

                            <div class="form-group">
                                <input type="password" id="drive_password" name="password" required placeholder=" ">
                                <label for="password"> Password</label>
                                <span class="error">
                                     <?php if(!empty($errorDrive_PassNotMatch)){echo $errorDrive_PassNotMatch;} ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <input id="drive_confirmPass" type="password" name="confirmPass"
                                    oninput="checkPasswordMatch('drive_password', 'drive_confirmPass', 'drive_message')" required placeholder=" ">
                                <label for="confirmPass">Confirm Password</label>
                                <span id="drive_message" class="error"></span>
                            </div><br>

                            <div class="checkbox agreement">
                                <label for="terms">I agree to the &nbsp;<a href="#">Terms & Conditions</a></label>
                                <input type="checkbox" name="termsCondition" value="agree" required>
                            </div><br>

                            <div class="btn">
                                <button type="submit" name="drive_reg" class="submit-btn">Submit</button>
                            </div><br><br><br>

                            <div class="redirect">
                                <p>Already have an account?</p>
                                <a href="#" onclick="showCitizen('driver_log', 'main-content')">
                                    <p>Login</p>
                                </a>
                            </div><br>
                            <!-- <ion-icon class="prev" name="arrow-back"></ion-icon> -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- citizen login -->
<?php if ($errorCitizen || $errorCitizenPassword): ?>
<script>
    window.addEventListener('load', function () {
        showCitizen('citi_log', 'main-content');
    });
</script>
<?php endif; ?>

<!-- driver login -->
<?php if ($errorDriver || $errorDriverPassword || $errorDriverVerify): ?>
<script>
    window.addEventListener('load', function () {
        showCitizen('driver_log', 'main-content');
    });
</script>
<?php endif; ?>

<!-- admin login -->
<?php if ($errorAdmin || $errorAdminPassword): ?>
<script>
    window.addEventListener('load', function () {
        showCitizen('admin_log', 'main-content');
    });
</script>
<?php endif; ?>

<!-- citizen registration -->
<?php if($errorCitiEmail || $errorCitiPhone || $errorCiti_PassNotMatch): ?>
<script>
    window.addEventListener('load', function () {
        showCitizen('citi_reg', 'main-content');
    });
</script>
<?php endif; ?>

<!-- driver registration -->
<?php if($errorDriveEmail || $errorDrivePhone || $errorDriveUsername): ?>
<script>
    window.addEventListener('load', function () {
        showCitizen('drive_reg', 'main-content');
    });
</script>
<?php endif; ?>

    
    <div id="main-content" class="main">

        <section id="home">
            <!-- <img style="z-index: ;" src="/Garbage_management_system/photos/home/p1.jpg" alt=""> -->
            <div class="welcome-message">
                <div class="heading">Competive And Reliable Business Waste Collection!</div>
                <div class="paragraph">We’ll work with you to deliver your dumpster promptly when you need it, and
                    create
                    proper custom pickup schedule that makes sense, whether it’s daily,</div>
                <a href="#"><button onclick="showCitizen('citi_reg', 'main-content')" class="btn">Get
                        Started</button></a>
            </div>
        </section>
            <!-- -------------------second------------------ -->
            <section id="second">
                <div class="box-2">
                    <div class="image">
                        <div id="photo">
                            <img src="/Garbage_management_system/photos/s2/p3.webp" alt="second">
                        </div>
                        <div class="inner-text">
                            <div class="inner">
                                <img src="/Garbage_management_system/photos/s2/i1.png" alt="">
                                <div class="inner-box">
                                    <h2>Trusted 97% Satisfaction
                                    </h2>
                                    <h3>We understand that we must lead by example are committed to further improving health
                                        &
                                        safety.
                                    </h3>
                                </div>
                            </div>
                            <div class="inner">
                                <img src="/Garbage_management_system/photos/s2/i2.png" alt="">
                                <div class="inner-box">
                                    <h2>Sustainable Management
                                    </h2>
                                    <h3>Our team of more than 6000 employees carry out all essential operations to support
                                        economy. collection.
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <p class="highlight">Providing Services For 90,000 Customers!
                        </p>
    
                        <h1>Reliable, Safe & Trusted Services To Meet All Your Waste Requirements.
                        </h1>
    
                        <p class="description">We have already made huge strides in our sustainability journey by investing
                            in
                            plastic recycling and energy from infrastructure and low carbon, leading to reduction in carbon
                            emissions.Our team of experienced professionals works tirelessly to ensure that every stage of
                            the
                            waste management process — from collection and transportation to treatment and disposal — is
                            carried
                            out with the utmost care and responsibility. We leverage innovative technologies and data-driven
                            insights to optimize operations, reduce waste going to landfills, and promote recycling and
                            reuse
                            wherever possible. With a strong commitment to environmental stewardship, we strive to make a
                            lasting, positive impact on both communities and the planet.
                        </p>
                    </div>
                </div>
            </section>
            <!-- ----------------third------------------ -->
            <section id="third">
                <div class="box-3">
                    <div class="text">
                        <div class="left-para">
                            <span class="bold">Recycling Wastage Save Environment !</span>
                            <h1>Simple Steps Wastage to Recycling Item Processing</h1>
                        </div>
                        <div class="right-para">
                            <p>Waste management is a crucial part of environmental sustanability. Recycling helps reduce
                                pollution,conserve natural resources,and minimize landfill waste.
                                The process of converting waste into reusable matrials involves several systematics steps.
                            </p>
                        </div>
    
                    </div>
                    <div class="cards-containers">
    
                        <div class="cards-1">
                            <div class="cimg">
                                <img src="../photos/s3/i3.png" alt="third" width="50px">
                            </div>
                            <h3>Collection Wastage</h3>
                            <p>Gathering waste from homes,industries,and commercial areas.</p>
                        </div>
    
                        <div class="cards-2">
                            <div class="cimg">
                                <img src="../photos/s3/i4.png" alt="" width="70px">
                            </div>
                            <h3>Pickup Wastage</h3>
                            <p>Transporting collected waste to recycling centers or processing units.</p>
                        </div>
    
                        <div class="cards-3">
                            <div class="cimg">
                                <img src="../photos/s3/i5.png" alt="">
                            </div>
                            <h3>Reduce Wastage</h3>
                            <p>Minimizing waste through reuse,responsible consumption, and waste management.</p>
                        </div>
    
                        <div class="cards-4">
                            <div class="cimg">
                                <img src="../photos/s3/i6.png" alt="" width="55px">
                            </div>
                            <h3>Recycling Process</h3>
                            <p>Converting waste into reusable materials for new product creation.</p>
                        </div>
    
                    </div>
                </div>
            </section>
        <!-- ---------------------forth--------------------- -->
        <section id="forth">
            <div class="box-4">
                <div class="photo">
                    <img src="/Garbage_management_system/photos/s4/p12.jpg" alt="">
                </div>
                <div class="text">
                    <h3 style="color: #14623D;">Why Choose Us__________</h3>
                    <h2 style="font-family: 'Jacques Francois'; font-size: 50px;">Your Sustainable Choice for
                        Waste Management.</h2>
                    <div class="hello">
                        <p style="color: #202b25; font-size: 20px; font-family: 'Roboto'; font-weight: bold;">We believe
                            that waste management is not just about disposal—it’s about creating a system that benefits
                            both
                            the environment and the community. Our solutions are designed to be reliable,
                            cost-effective,
                            and accessible, making it easier for individuals and businesses to adopt sustainable waste
                            management practices. Through innovation and a deep commitment to environmental
                            responsibility,
                            we aim to build a future where waste is managed efficiently, and our cities remain clean and
                            livable.</p>
                    </div>
                    <div class="features">
                        <div class="feature">
                            <img src="/Garbage_management_system/photos/s4/i7.png" alt="">
                            <h3>Large Volume Pickup</h3>
                        </div>
                        <div class="feature">
                            <img src="/Garbage_management_system/photos/s4/i8.png" alt="">
                            <h3>Easy Online Scheduling</h3>
                        </div>
                        <div class="feature">
                            <img src="/Garbage_management_system/photos/s4/i9.png" alt="">
                            <h3>Same Day Service</h3>
                        </div>
                        <div class="feature">
                            <img src="/Garbage_management_system/photos/s4/i10.png" alt="">
                            <h3>Environmentally Friendly</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- -------------------------section-5------------------------- -->
        <section id="five">
            <div class="box-5">
                <div class="text">
                    <div class="services-content">
                        <h4>Ecology Survive With Sustainable Service!</h4>
                        <h1>Time Is The Best Way To Think About Recycling</h1>
                        <p>Recycling is notjust learing which bnin to throw an item into.
                            Its's about appreciatig the resources that went into making the item
                            and understang the value of these materials.You will truly understand
                            the value of these materials.You will truly understand recyclingif you change your mindset.
                        </p>
                    </div>
                    <div class="service-items">

                        <span class="item"><ion-icon name="checkmark-done-circle-outline"></ion-icon>Reduce Green House
                            Gas</span>
                        <span class="item"><ion-icon name="checkmark-done-circle-outline"></ion-icon>Conserve Natural
                            Resources</span>
                        <span class="item"><ion-icon name="checkmark-done-circle-outline"></ion-icon>Conserve Natural
                            Resources</span>
                        <!-- </ul></div><div><ul> -->
                        <span class="item"><ion-icon name="checkmark-done-circle-outline"></ion-icon> Protects
                            Ecosystems</span>
                        <span class="item"><ion-icon name="checkmark-done-circle-outline"></ion-icon> Economic
                            Benefits</span>

                    </div>
                    <div class="contact-button">
                        <button onclick="showCitizen('citi_reg', 'main-content')">Join Us</button>
                    </div>
                </div>

                <!----------form------------->
                <div class="dusbin-content">
                    <div class="header">
                        <h1><img src="../photos/s5/dustbin.png" alt="dustbin" />Order for Dustbin</h1>
                    </div>
                    <form action="#" onsubmit="return false;">
                        <fieldset>
                            <legend>User Details</legend>

                            <div class="form-group">
                                <input type="text" name="name" required placeholder="Full Name" />

                            </div>
                            <div class="form-group">
                                <input type="text" name="number" required placeholder="Phone no." />
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" required placeholder="Email ID" />
                            </div>

                            <div class="form-group">
                                <select name="User type" required>
                                    <option value="">Select user type</option>
                                    <option value="locality">Locality</option>
                                    <option value="business">Business</option>
                                    <option value="apartment">Apartment</option>
                                    <option vlaue="school">School</option>
                                    <option vlaue="hospital">Hospital</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Location Details</legend>
                            <div class="form-group">
                                <input type="textarea" name="address" required placeholder="Address" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="number" required placeholder="Pin code" />
                            </div>

                            <div class="form-group">
                                <input type="text" name="city" required placeholder="City" />
                            </div>

                            <div class="form-group">
                                <input type="text" name="State" required placeholder="State" />
                            </div>
                            <div class="form-group">
                                <input type="google-map" name="location" required placeholder="Google Map Location" />
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Dustbin Requirement</legend>
                            <div class="form-group">
                                <select name="dustbinType" required>
                                    <option value="">Select dustbin type</option>
                                    <option value="green">Organic Waste Bin(Green)</option>
                                    <option value="blue">Plastic Waste Bin (Blue)</option>
                                    <option value="red">E-Waste Bin (Red)</option>
                                    <option value="yellow">Medical Waste Bin (Yellow)</option>
                                    <option value="black">General Waste Bin (Black)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="dustbinSize" required>
                                    <option value="">Select dustbin size</option>
                                    <option>10L</option>
                                    <option>20L</option>
                                    <option>50L</option>
                                    <option>100L</option>
                                    <option>500L</option>
                                    <option>1000L</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="number" name="quantity" min="1" required placeholder="Quanity required" />
                            </div>

                            <div class="form-group">
                                <select name="materialType" required>
                                    <option value="">Select material type</option>
                                    <option value="plastic">Plastic</option>
                                    <option value="metal">Metal</option>
                                    <option value="fibre">Fibre</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="lidType" id="">
                                    <option value="lid">Select lid type</option>
                                    <option value="open">Open</option>
                                    <option value="metal">Flip Lid</option>
                                    <option value="pedal">Pedal</option>
                                    <option value="covered">Covered</option>
                                </select>
                            </div>

                            <legend>Special Features</legend>
                            <div class="form-group">
                                <div class="features">
                                    <label><input name="hasWheels" type="checkbox" checked="checked" />Wheels</label>
                                    <label><input name="hasRFIDTracking" type="checkbox" checked="checked" />RFID
                                        Tracking(for Smart Waste Managemnt)</label>
                                    <label><input name="hasLockableLid" type="checkbox" checked="checked" />Lockable Lid
                                    </label>
                                </div>
                            </div>
                        </fieldset>

                        <div class="submit-btn">
                            <button type="submit">Submit Order</button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
        <!-- ---------------------section-6--------------------- -->
         <section id="six">
            <div class="box-6">
                <div class="text">
                    <h1>This is Our Dustbins</h1>
                    <p>We are committed to making waste management easy and accessible for everyone. Our user-friendly
                        platform allows you to quickly locate the nearest dustbin in your area, ensuring that you can
                        dispose of your waste responsibly and efficiently. With just a few clicks, you can find the
                        closest dustbin, view its capacity, and even get directions to it. Join us in our mission to
                        keep our city clean and green!</p>
                </div>
                <div class="map">
                    <!-- <h1>Map</h1>
                    <p>Find the nearest dustbin location on the map.</p> -->
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                    <div id="map" style="height: 400px; width: 100%; padding:10px;"></div>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                    <script src="../main/show_dustbin.js"></script>
                </div>
            </div>

         </section>

    </div>

    <footer>
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
    </footer>

    <script src="\Garbage_management_system\main\main.js?v=<?= time(); ?>"></script>

    <!-- for icons -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>