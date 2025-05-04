<?php
session_start();
include '../main/db_connect.php';

// $success = "Your account has been created successfully";
// $error = $errorEmail = $errorPhone = "";

    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["citi_reg"])){
        $name = $_POST['name'];
        $dob = $_POST['dob'];       
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];       
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPass'];
        $house = $_POST['house'];
        $locality = $_POST['locality']; 
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];
        $state = $_POST['state'];
        $address = $house . ", " . $locality . ", " . $city . " - " . $pincode . ", " . $state;
        $location = $_POST['location'];
        $wasteType = $_POST['wasteType'];
        $freeDustbin = isset($_POST['freeDustbin']) ? "Yes" : "No";
        $interestRecycling = isset($_POST['interestRecycling']) ? "Yes" : "No";
        $termsCondition = isset($_POST['termsCondition']) ? "Agree" : "Disagree";

        $emailCheck = "SELECT * FROM `citizen` WHERE `email`='$email'";
        $phoneCheck = "SELECT * FROM `citizen` WHERE `phone`='$phone'";

        $emailResult = $conn->query($emailCheck);
        $phoneResult = $conn->query($phoneCheck);

        $hasError = false;

        if($emailResult->num_rows > 0) {
            $_SESSION['errorCitiEmail'] = "Email already exists!";
            $hasError = true;
        }
        if($phoneResult->num_rows > 0) {
            $_SESSION['errorCitiPhone'] = "Phone number already exists!";
            $hasError = true;
        }
        if($password !== $confirmPass){
            $_SESSION['errorCiti_PassNotMatch'] = "Please make sure the password is matched.";
            $hasError = true;
        }
        // echo $hasError;

        if($hasError === false) {
                $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO `citizen` (`name`, `dob`, `gender`, `phone`, `email`, `password`, `Address`, `location`, `wasteType`, `freeDustbin`, `interestRecycling`, `termsCondition`) VALUES ('$name', '$dob', '$gender', '$phone', '$email', '$hashed_password', '$address', '$location', '$wasteType', '$freeDustbin', '$interestRecycling', '$termsCondition')";
    
                if($conn->query($sql)==TRUE)
                {
                    $_SESSION['citi_submit'] = "Your account is succenfully created.";
                    echo "<script>
                            alert('You have successfully registered.');
                            window.location.href = '/Garbage_management_system/main/index.php#citi_log';
                        </script>";
                        exit();
                } else {
                    $_SESSION['error'] = "Sorry! There is some server issue.";
                }
        }

        else{
            header("Location:/Garbage_management_system/main/index.php#citi_reg");
            exit();
            // echo $conn->error;
            // echo $hasError;
        }
    }

$conn->close();

?>
