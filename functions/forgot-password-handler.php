<?php
session_start();
include('../config/dbcon.php');

// Include your functions here

if(isset($_POST['reset_password_btn']))
{
    $email = $_POST['email'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email address!";
        redirect('forgot-password.php', 'Invalid email address!');
    }

    // Check if email exists in the database
    // Assuming you have a database connection file included
    include('db_connection.php'); // Adjust the path as necessary

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        // Generate a unique reset token
        $token = bin2hex(random_bytes(50));

        // Insert token into database or update existing one
        $query = "UPDATE users SET reset_token='$token', reset_token_expire=DATE_ADD(NOW(), INTERVAL 30 MINUTE) WHERE email='$email'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            // Send reset link to user
            $reset_link = "http://yourdomain.com/reset-password.php?token=$token";
            $subject = "Password Reset Request";
            $message = "Click on the following link to reset your password: $reset_link";
            $headers = "From: noreply@yourdomain.com";

            if(mail($email, $subject, $message, $headers)) {
                // Email sent successfully
                $_SESSION['message'] = "Password reset link has been sent to your email.";
                redirect('login.php', 'Password reset link has been sent to your email.');
            } else {
                $_SESSION['message'] = "Failed to send reset link!";
                redirect('forgot-password.php', 'Failed to send reset link!');
            }
        } else {
            $_SESSION['message'] = "Something went wrong!";
            redirect('forgot-password.php', 'Something went wrong!');
        }
    }
    else
    {
        // No account found with the email
        $_SESSION['message'] = "No account found with this email!";
        redirect('forgot-password.php', 'No account found with this email!');
    }
}
else
{
    $_SESSION['message'] = "Unauthorized access!";
    redirect('forgot-password.php', 'Unauthorized access!');
}

// Close the database connection
mysqli_close($con);

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}
?>
