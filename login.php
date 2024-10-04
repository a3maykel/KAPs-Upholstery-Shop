<?php 
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "You are already logged In";
    header('Location: index.php');
    exit();
}

include('includes/header.php'); 
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php   
                if (isset($_SESSION['message']))
                {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>User!</strong> <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']); 
                }
                ?>
                <div class="card">
                    <div class="card-header fw-bold">
                        <h4>LOGIN FORM</h4>
                    </div>
                    <div class="card-body">
                        <form action="functions/authcode.php" method="POST">
                            <div class="mb-3 input-container">
                                <i class="fa fa-envelope icon" aria-hidden="true"></i>
                                <input type="email" name="email" class="form-control input-field" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp" required>                    
                            </div>
                            <div class="mb-3 input-container position-relative">
                                <i class="fa fa-key icon" aria-hidden="true"></i>
                                <input type="password" name="password" class="form-control input-field" placeholder="Enter password" id="password" required>
                                <i class="fa fa-eye icon toggle-password position-absolute" onclick="togglePassword('password')" style="right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" aria-label="Toggle password visibility"></i>
                            </div>
                            <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<style>
    .input-container {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        background-color: white;
        border-radius: 30px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .icon {
        padding: 10px;
        background: #007bff;
        color: white;
        min-width: 50px;
        text-align: center;
        border-radius: 50%;
    }
    .input-field {
        width: 100%;
        border: none;
        outline: none;
        padding: 10px;
        border-radius: 30px;
        padding-left: 20px; /* Adjust padding to accommodate the icon */
    }
    .input-field:focus {
        box-shadow: none;
    }
    .btn-primary {
        width: 100%;
        border-radius: 30px;
        padding: 10px;
    }
    .toggle-password {
        cursor: pointer;
    }
    .text-center {
        text-align: center;
    }
</style>

<script>
    function togglePassword(id) {
        var input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
