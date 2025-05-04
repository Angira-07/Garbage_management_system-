<?php
session_start();
include '../main/db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendMail($email, $reset_token){
    
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
    require '../PHPMailer/Exception.php';;


    $mail = new PHPMailer(true);

    try {
        //Server settings
                        //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'emailid';                     //SMTP username
        $mail->Password   = 'password';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('emailid', 'Waste Heroes');
        $mail->addAddress($email);     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link from Waste Heroes';
        $mail->Body    = "We received a request to reset the password for your Driver account.
        Click the link below to set a new password and get back to managing your assigned pickups.<br>

        👉 <a href='http://localhost/Garbage_management_system/citi_update_password.php?email=$email&reset_token=$reset_token'>Reset Password Link</a><br>

        If you didn’t request this change, you can safely ignore this email.<br>
        Thanks,<br>
        Waste Heroes Team</b>";
    
        $mail->send();
        return true; //to run the rest code below => of alert
    } catch (Exception $e) {
        echo "<script>alert('Mailer Error: " . $mail->ErrorInfo . "');</script>";
         return false;
    }
}


if(isset($_POST['citi_forgot_password'])){
    $email = $_POST['email'];
    $sql = "SELECT * FROM `citizen` WHERE `email` = '$email' ";
    $result = $conn->query($sql);
    if($result){
        if($result->num_rows == 1){
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/kolkata');
            $date = date("Y-m-d");
            $store = "UPDATE `citizen` SET `reset_token` = '$reset_token', `reset_token_expire` = '$date' WHERE `email` = '$email'";
            if(($conn->query($store)) && (sendMail($email, $reset_token))){
                echo "<script>
                    alert('Passsword Reset Link SEnt to mail');
                    window.location.href = '../main/index.php';
                </script>";
            }
            else{
                echo "<script>
                    alert('Server Down! try again later ');
                    window.location.href = '../main/index.php';
                </script>";
            }
        }
        else{ 
            echo "<script>
                alert('Email not found');
                window.location.href = '../main/index.php';
            </script>";
        }
    } else{
        echo "<script>
            alert('Bad Request');
            window.location.href = '../main/index.php';
        </script>";
    }
}

?>
