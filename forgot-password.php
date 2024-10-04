<?php
session_start();
include('includes/header.php');
include('config/dbcon.php');

if (isset($_POST['reset_password_btn'])) {
    $email = $_POST['email'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email address!";
    } else {
        // Check if email exists in the database
        $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // Generate a unique reset token
            $token = bin2hex(random_bytes(50));

            // Store the token and its expiration timestamp in the database
            $expire_time = date('Y-m-d H:i:s', strtotime('+30 minutes'));
            $update_query = "UPDATE users SET reset_token='$token', reset_token_expire='$expire_time' WHERE email='$email'";
            $update_result = mysqli_query($con, $update_query);

            if ($update_result) {
                // Send the reset link to the user's email
                $reset_link = "http://yourdomain.com/reset-password.php?token=$token";
                $subject = "Password Reset Request";
                $message = "Click on the following link to reset your password: $reset_link";
                $headers = "From: noreply@yourdomain.com";

                if (mail($email, $subject, $message, $headers)) {
                    $_SESSION['message'] = "Password reset link has been sent to your email.";
                } else {
                    $_SESSION['message'] = "Failed to send reset link!";
                }
            } else {
                $_SESSION['message'] = "Something went wrong!";
            }
        } else {
            $_SESSION['message'] = "No account found with this email!";
        }
    }

    // Redirect to the same page
    header('Location: forgot-password.php');
    exit();
}
?>

<div style="display: flex; justify-content: center; align-items: flex-start; height: 100vh; padding-top: 10vh;">
    <div style="width: 500px; border: 1px solid #ccc; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div>
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div>' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
            ?>
            <div style="text-align: center; margin-bottom: 20px;">
                <h4>Forgot Password</h4>
            </div>
            <div>
                <form action="forgot-password.php" method="POST" style="display: flex; flex-direction: column; align-items: center;">
                    <div style="margin-bottom: 15px; width: 100%;">
                        <label for="email">Email:</label>
                        <input type="email" name="email" placeholder="Enter your email" required style="width: 100%; padding: 10px; margin-top: 5px;">
                    </div>
                    <div>
                        <button type="submit" name="reset_password_btn" style="padding: 10px 20px; border-radius: 5px;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
