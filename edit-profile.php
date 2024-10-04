<?php
session_start();

include('includes/header.php');
include('functions/userfunctions.php'); 

// Check if user is logged in
if (!isset($_SESSION['auth_user']['user_id'])) {
    // If no user is logged in, redirect to login page
    redirect('login.php', 'You must be logged in to view this page.');
    exit();
}

$userID = $_SESSION['auth_user']['user_id'];

// Fetch user data using MySQLi
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Check if user exists
if (!$userData) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    User not found.
                </div>
            </div>
        </div>
    </div>
    <?php
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    // Password policy: minimum 8 characters with at least one number
    $passwordPolicy = "/^(?=.*\d).{8,}$/";

    // Validate password policy and matching passwords
    if (!preg_match($passwordPolicy, $password)) {
        $_SESSION['message'] = "Password must be at least 8 characters long and contain at least one number.";
        header('Location: edit-profile.php');
        exit();
    } elseif ($password !== $repeatPassword) {
        $_SESSION['message'] = "Passwords do not match.";
        header('Location: edit-profile.php');
        exit();
    } else {
        // Update user data in the database
        $updateQuery = "UPDATE users SET name = ?, address = ?, phone = ?, password = ? WHERE id = ?";
        $updateStmt = $con->prepare($updateQuery);
        $updateStmt->bind_param("ssssi", $name, $address, $phone, $password, $userID);

        // Execute the SQL query
        if ($updateStmt->execute()) {
            redirect('profile.php', 'Profile updated successfully.');
        } else {
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            Failed to update profile. Please try again later.
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
?>

<div style="width: 80%; margin: 48px auto 20px auto; border-radius: 10px;">
    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2>Edit Profile</h2>
        <form method="POST" action="">
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="name" style="font-size: 1.5em;">Name:</label>
                <input type="text" id="name" required name="name" value="<?= htmlspecialchars($userData['name']); ?>" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="address" style="font-size: 1.5em;">Address:</label>
                <input type="text" id="address" required name="address" value="<?= htmlspecialchars($userData['address']); ?>" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="phone" style="font-size: 1.5em;">Phone:</label>
                <input type="text" id="phone" required name="phone" value="<?= htmlspecialchars($userData['phone']); ?>" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="password" style="font-size: 1.5em;">Change Password:</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" value="<?= htmlspecialchars($userData['password']); ?>" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePasswordVisibility('password')">
                            <i class="fa fa-eye" id="togglePasswordIcon-password"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="repeat_password" style="font-size: 1.5em;">Repeat Password:</label>
                <div class="input-group">
                    <input type="password" id="repeat_password" name="repeat_password" value="<?= htmlspecialchars($userData['password']); ?>" class="form-control" required>
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePasswordVisibility('repeat_password')">
                            <i class="fa fa-eye" id="togglePasswordIcon-repeat_password"></i>
                        </span>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>

<script>
function togglePasswordVisibility(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById('togglePasswordIcon-' + fieldId);
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function validateForm() {
    const password = document.getElementById('password').value;
    const repeatPassword = document.getElementById('repeat_password').value;
    const passwordPolicy = /^(?=.*\d).{8,}$/;

    if (!password.match(passwordPolicy)) {
        alert('Password must be at least 8 characters long and contain at least one number.');
        return false;
    }

    if (password !== repeatPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}
</script>

<?php include('includes/footer.php'); ?>
