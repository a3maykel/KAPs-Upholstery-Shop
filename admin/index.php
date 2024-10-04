<?php 

include('../middleware/adminMiddleware.php');
include('includes/header.php'); 

// Fetch counts
$productCount = mysqli_num_rows(getAll('products'));
$categoryCount = mysqli_num_rows(getAll('categories'));
$orderCount = mysqli_num_rows(getAll('orders'));
$userCount = mysqli_num_rows(getAll('users'));

?>

<div class="row">
    <div class="col-lg-5 col-sm-5">
        <div class="card mb-5">
            <div class="card-header p-4 pt-4">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">inventory_2</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize fw-bold text-black">Products</p>
                    <h4 class="mb-0"><?= $productCount ?></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header p-4 pt-4">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">category</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize fw-bold text-black">Categories</p>
                    <h4 class="mb-0"><?= $categoryCount ?></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
        <div class="card mb-5">
            <div class="card-header p-4 pt-4 bg-transparent">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">receipt_long</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize fw-bold text-black">Orders</p>
                    <h4 class="mb-0"><?= $orderCount ?></h4>
                </div>
            </div>
            <hr class="horizontal my-0 dark">
            <div class="card-footer p-3">

            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header p-4 pt-4 bg-transparent">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">people</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize fw-bold text-black">Users</p>
                    <h4 class="mb-0"><?= $userCount ?></h4>
                </div>
            </div>
            <hr class="horizontal my-0 dark">
            <div class="card-footer p-3">
     
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
