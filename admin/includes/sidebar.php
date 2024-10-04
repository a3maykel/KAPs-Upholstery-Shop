<?php
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
?>

    <?php
    if($_SESSION['auth_user']['role_as'] == 1) { // Administrator
        ?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="" target="_blank">
        <span class="ms-1 font-weight-bold text-white">Admin Dashboard</span>
    </a>
</div>
<hr class="horizontal light mt-0 mb-2">
<div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "index.php"? 'active bg-gradient-primary':''; ?>" href="index.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "category.php"? 'active bg-gradient-primary':''; ?>" href="category.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">All Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "add-category.php"? 'active bg-gradient-primary':''; ?> " href="add-category.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">add</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">Add Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "products.php"? 'active bg-gradient-primary':''; ?> " href="products.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">All Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "add-product.php"? 'active bg-gradient-primary':''; ?>" href="add-product.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">add</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">Add Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "seat_covers.php"? 'active bg-gradient-primary':''; ?> " href="seat_covers.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">All Seat Covers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "add_color.php"? 'active bg-gradient-primary':''; ?>" href="add_color.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">add</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">Add Seat Cover Color</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "orders.php"? 'active bg-gradient-primary':''; ?>" href="orders.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "users.php"? 'active bg-gradient-primary':''; ?>" href="users.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1 fw-bold">Users List</span>
            </a>
        </li>
    </ul>
</div>
<div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" 
        href="../logout.php">
        Logout
        </a>
    </div>
</div>
</aside>

        <?php
    } elseif($_SESSION['auth_user']['role_as'] == 2) { // Clerk
        ?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="" target="_blank">
        <span class="ms-1 font-weight-bold text-white">Clerk Dashboard</span>
    </a>
</div>
<hr class="horizontal light mt-0 mb-2">
<div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "index.php"? 'active bg-gradient-primary':''; ?>" href="index.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $page == "orders.php"? 'active bg-gradient-primary':''; ?>" href="orders.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Orders</span>
            </a>
        </li>
        </ul>
      </div>
      <div class="sidenav-footer position-absolute w-100 bottom-0 ">
          <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" 
        href="../logout.php">
        Logout
        </a>
    </div>
</div>
</aside>
        <?php
        
    }
    ?>

