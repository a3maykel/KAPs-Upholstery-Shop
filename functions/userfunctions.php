<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('config/dbcon.php');

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getAllTrending()
{
    global $con;
    $query = "SELECT * FROM products WHERE trending='1' ";
    return $query_run = mysqli_query($con, $query);
}

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
    
}

function getColorByProdID($id)
{
    global $con;
    $query = "SELECT * FROM seat_color WHERE product_id=$id";
    return $query_run = mysqli_query($con, $query);
    
}


function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1 ";
    return $query_run = mysqli_query($con, $query);
}

function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0'  ";
    return $query_run = mysqli_query($con, $query);
}

// function getCartItems()
// {
//     global $con;
//     $userId = $_SESSION['auth_user']['user_id'];
//     $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price, p.qty 
//               FROM carts c, products p 
//               WHERE c.prod_id=p.id AND c.user_id='$userId' 
//               ORDER BY c.id DESC";
//     return mysqli_query($con, $query);
// }

function getCartItems() {
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price, p.qty, sc.id, sc.img_src, sc.product_id, sc.color 
                   FROM carts c INNER JOIN products p 
                   ON c.prod_id=p.id INNER JOIN seat_color sc ON c.color_id=sc.id
                   WHERE c.user_id='$userId'
                   ORDER BY c.id DESC";
    return mysqli_query($con, $query);

}



function getOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id='$userId' ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId'  ";
    return mysqli_query($con, $query);
}



?>