<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../config/dbcon.php');

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
    
}

function getSeatCoverColor($table1, $table2)
{
    global $con;
    $query = "SELECT $table2.id, $table1.name, $table2.color, $table2.img_src FROM $table2 INNER JOIN $table1 ON $table2.product_id = $table1.id";
    return $query_run = mysqli_query($con, $query);
    
}

function sendSMS($phone, $txtmessage) {

    // changes number from 09 to +639 which is required for SMS API to work
    $phone = "+63" . substr($phone, 1, 10);
  
    $message = [
        "secret" => "3ea00d75c8e4924eab41ac9baf581a563c2e422c", // your API secret from (Tools -> API Keys) page
        "mode" => "devices",
        "device" => "00000000-0000-0000-4220-b5413aee1613",
        "sim" => 1,
        "phone" => $phone,
        "message" => $txtmessage
    ];
  
    $cURL = curl_init("https://sms.teamssprogram.com/api/send/sms");
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
    $response = curl_exec($cURL);
    curl_close($cURL);
  
    $result = json_decode($response, true);
  
  // do something with response
    print_r($result);
  
}


function updateProductStatusBasedOnQuantity($table)
{
    global $con;
    $update_query = "UPDATE $table SET status = 1 WHERE qty <= 0";
    mysqli_query($con, $update_query);
}

function getByUserID($table, $userID)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$userID' ";
    return $query_run = mysqli_query($con, $query);
}

function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' ";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status <='1' ";
    return $query_run = mysqli_query($con, $query);
}

function getOrderHistory()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status >= '2'";
    return mysqli_query($con, $query);
}

function checkTrackingNoValid($trackingNo)
{
    global $con;

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo'  ";
    return mysqli_query($con, $query);
}

function getAllUsers($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return mysqli_query($con, $query);
}

function getUserData($userID)
{
    global $con;

    $query = "SELECT * FROM users WHERE id='$userID'";
    return mysqli_query($con, $query);
}

?>