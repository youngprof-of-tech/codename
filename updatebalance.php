<?php
require_once __DIR__ . '/include/config.php';
if(!isset($_SESSION['token'])){
	header('location: index');
}
$wallet = new radiumsahil();
$userdata = $wallet->userdata();
$userwallet = $wallet->userwallet();
$referwallet = $wallet->refer_data();

// Getting data back 
$user_id = base64_decode($_GET['u']);
$token = base64_decode($_GET['t']);
$amount = base64_decode($_GET['a']);
$quantity = base64_decode($_GET['q']); 
$status = $_GET['status'];
$tx_ref = $_GET['tx_ref'];


if($userdata===false){
unset($_SESSION['token']);
session_destroy();
	header('location: index');	
return;	
}elseif($userdata == "otp"){
	header('location: otp');	
return;	
}
elseif(isset($user_id) && $status != "cancelled"){

    $query = $conn->query("UPDATE user_wallet 
    SET balance = balance + '$amount', 
        total_recharge = total_recharge + '$amount', 
        total_otp = total_otp + '$quantity' 
    WHERE user_id = '$user_id'");


    $query_1 = $conn->query("INSERT INTO upi_recharge SET amount = '$amount', user_id = '$user_id', txn_id = '$tx_ref', recharge_time = '".Date("Y:m:d H:i:s")."', status = 'paid'");

    if($query){
        $wallet->closeConnection();
        include_once __DIR__ . '/theam/' . THEAM . '/flutterwavepayment.php';        
    }
}
$wallet->closeConnection();
include_once __DIR__ . '/theam/' . THEAM . '/flutterwavepayment.php';
?>