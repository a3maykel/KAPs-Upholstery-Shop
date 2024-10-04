<?php
session_start();
include('../config/dbcon.php');
include('myfunctions.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

function sendemail_verify($name,$email,$verify_token)
{
    
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug = 2; 
    $mail->isSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "michaeumali234@gmail.com";
    $mail->Password = "aotv knuu mobl uwqo";
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("michaeumali234@gmail.com",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Email Verification from KAP's Upholstery Shop Website";
    
    $email_template = "
    <h2>Verify your Email (KAP's Upholstery Shop)</h2>
    <h3>You requested to register on KAP's Upholstery Shop. Please click the link below to verify your account.</h3> 
    <a href='http://localhost/kaps_upholstery/verify-email.php?token=$verify_token'> Click Me </a>
    ";

    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';

}

if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $verify_token = md5(rand());

    // Password policy regex: minimum 8 characters with at least one number
    $password_regex = '/^(?=.*\d).{8,}$/';

    if (!preg_match($password_regex, $password)) {
        $_SESSION['message'] = "Password must be minimum 8 characters long and contain at least one number!";
        header('Location: ../register.php');
        exit(); // Terminate script execution
    }

    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "Email already registered!";
        header('Location: ../register.php');
    } else {
        if ($password == $cpassword) {
            
            $insert_query = "INSERT INTO users(name,address,phone,email,password,verify_token,role_as) VALUES ('$name', '$address', '$phone', '$email', '$password','$verify_token','$role')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                sendemail_verify("$name", "$email", "$verify_token");
                $_SESSION['message'] = "Registered Successfully! <br> Please verify your Email Address";
                header('Location: ../register.php');
            } else {
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../register.php');
            }
        } else {
            $_SESSION['message'] = "Passwords do not match!";
            header('Location: ../register.php');
        }
    }
}
else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        $userdata = mysqli_fetch_array($login_query_run);

        if($userdata['verify_status'] == "1")
        {
            $_SESSION['auth'] = true;
            $userid = $userdata['id'];
            $username = $userdata['name'];
            $useremail = $userdata['email'];
            $role_as = $userdata['role_as'];
            

            $_SESSION['auth_user'] = [
                'user_id' => $userid,
                'name' => $username,
                'email' => $useremail,
                'role_as' => $role_as,
            ];     
        }
        else if($userdata['verify_status'] == "0")
        {
            redirect("../login.php", "Your account is not verified. Please verify your email address.");
        }

        $_SESSION['role_as'] = $role_as;

        if($role_as == 1)
        {
            redirect("../admin/index.php", "Welcome to Dashboard");
        }
        elseif($role_as == 2)
        {
            redirect("../admin/orders.php", "Welcome to Order List");
        }
        else 
        {
            redirect("../index.php", "Logged in Successfully");
        }
        
    }
    else 
    {
        redirect("../login.php", "Invalid Credentials");
    }
}

    else 
    {
        redirect("../login.php", "Invalid Credentials");
    }
     

?>

