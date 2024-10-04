<?php


// Function to get role name based on role_as value
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

// Include necessary files and initialize database connection
include('../middleware/adminMiddleware.php');
include('includes/header.php'); 

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">User List
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>View</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $users = getAllUsers("users");

                            if(mysqli_num_rows($users) > 0)
                            {
                                while ($user = mysqli_fetch_assoc($users)) {
                                ?>
                                    <tr>
                                        <td><?= $user['id']; ?></td>
                                        <td><?= $user['name']; ?></td>
                                        <td><?= $user['email']; ?></td>
                                        <td><?= getRoleName($user['role_as']); ?></td>
                                        <td>
                                            <!-- View button -->
                                            <a href="view-users.php?userid=<?= $user['id'] ?>" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td colspan="5">No users found</td>
                                    </tr>
                                <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>

<!-- Include footer -->
<?php include('includes/footer.php'); ?>