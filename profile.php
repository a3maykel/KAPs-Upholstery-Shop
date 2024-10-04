<?php
session_start();

include('includes/header.php');
include('functions/userfunctions.php'); 

function getRoleName($role_as)
{
    switch ($role_as) {
        case 0:
            return "Customer";
        case 1:
            return "Administrator";
        case 2:
            return "Clerk";
        default:
            return "Unknown";
    }
}

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
?>

<div style="width: 80%; margin: 48px auto 20px auto; border-radius: 10px;">
    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding-left: 100px;">
        <div style="display: flex;">
            <div style="flex-basis: 50%;">
                <div style="margin-bottom: 40px;"></div>
                <h2 style="margin-bottom: 30px; font-size: 36px;" class="fa fa-user-circle-o"> User Details</h2>
                <?php
                foreach (['Name' => 'name', 'Address' => 'address', 'Phone' => 'phone'] as $label => $field) {
                    echo "<div style='margin-bottom: 20px;'><strong style='font-size: 18px;'>$label:</strong><br><div style='border: 1px solid #ccc; padding: 10px; width: 464px; font-size: 16px; border-radius: 5px;'>". htmlspecialchars($userData[$field]) ."</div></div>";
                }
                ?>
                <div style="margin-bottom: 20px;">
                    <strong style="font-size: 18px;">Password:</strong><br>
                    <div style="position: relative; display: flex; align-items: center;">
                        <input type="password" id="password" value="<?= htmlspecialchars($userData['password']); ?>" style="border: 1px solid #ccc; padding: 10px; width: 100%; font-size: 16px; border-radius: 5px;" readonly>
                        <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; background: none; border: none; cursor: pointer;">
                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>
                <div style="margin-bottom: 40px;"></div>
            </div>
            <div style="flex-basis: 50%; display: flex; flex-direction: column; justify-content: space-between; margin-top: 107px;">
                <?php
                foreach (['Email' => 'email', 'Role' => 'role_as', 'Account Created' => 'created_at'] as $label => $field) {
                    $borderStyle = ($field === 'email') ? 'border: 1px solid #ccc;' : '';
                    if ($field == 'role_as') {
                        $value = getRoleName($userData[$field]);
                    } else {
                        $value = htmlspecialchars($userData[$field]);
                    }
                    echo "<div style='margin-bottom: 20px;'><strong style='font-size: 18px;'>$label:</strong><br><div style='$borderStyle padding: 10px; width: 100%; font-size: 16px; border-radius: 5px;'>$value</div></div>";
                }
                ?>
                <div style="align-self: flex-end; margin-top: auto;">
                    <a href="edit-profile.php" class="btn btn-primary" style="font-size: 16px; border-radius: 5px;">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePasswordIcon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        togglePasswordIcon.classList.remove('fa-eye');
        togglePasswordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        togglePasswordIcon.classList.remove('fa-eye-slash');
        togglePasswordIcon.classList.add('fa-eye');
    }
}
</script>

<?php include('includes/footer.php'); ?>
