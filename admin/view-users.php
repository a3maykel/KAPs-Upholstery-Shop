<?php

// Include necessary files and initialize database connection
include('../middleware/adminMiddleware.php');
include('includes/header.php');


function generateHashedPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}


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

// Check if user ID is provided in the URL
if(isset($_GET['userid']))
{
    $userID = $_GET['userid'];

    // Fetch user data based on user ID
    $userDataResult = getUserData($userID);

    // Check if user exists
    if(mysqli_num_rows($userDataResult) == 0)
    {
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
        exit(); // Stop further execution
    }

    // Fetch user data
    $userData = mysqli_fetch_assoc($userDataResult);
}
else
{
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    User ID not provided.
                </div>
            </div>
        </div>
    </div>
    <?php
    exit(); // Stop further execution
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-4 fw-bold">View User</span>
                    <a href="users.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Left column -->
                        <div class="col-md-6">
                            <h4>User Details</h4>
                            <hr>
                            <div class="mb-3">
                                <label class="fw-bold">ID</label>
                                <div class="border p-1"><?= $userData['id']; ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Name</label>
                                <div class="border p-1"><?= $userData['name']; ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Email</label>
                                <div class="border p-1"><?= $userData['email']; ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Phone</label>
                                <div class="border p-1"><?= $userData['phone']; ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Password (Real)</label>
                                <div class="border p-1"><?= $userData['password']; ?></div>
                            </div>
                            <!-- Add more user details as needed -->
                        </div>
                        <!-- Right column -->
                        <div class="col-md-6">
                            <h4>Additional Details</h4>
                            <hr>
                       
                            <div class="mb-3">
                                <label class="fw-bold">Verify Status</label>
                                <div class="border p-1"><?= $userData['verify_status'] == 1 ? 'Verified' : 'Not Verified'; ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Role</label>
                                <div class="border p-1"><?= getRoleName($userData['role_as']); ?></div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Created At</label>
                                <div class="border p-1"><?= $userData['created_at']; ?></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>