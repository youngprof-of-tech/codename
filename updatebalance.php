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
elseif(isset($user_id) && $status == "completed"){
    // Check if the user exists in the database
    $check_query = $conn->prepare("SELECT COUNT(*) FROM user_wallet WHERE user_id = ?");
    $check_query->bind_param("s", $user_id);
    $check_query->execute();
    $check_query->bind_result($count);
    $check_query->fetch();
    $check_query->close();

    if ($count > 0) {
        // User exists, perform an update
        $update_query = $conn->prepare("UPDATE user_wallet 
            SET balance = balance + ?, 
                total_recharge = total_recharge + ? 
            WHERE user_id = ?");
        $update_query->bind_param("dds", $amount, $amount, $user_id);
        $update_query->execute();
        $update_query->close();
    } else {
        // User does not exist, perform an insert
        $insert_query = $conn->prepare("INSERT INTO user_wallet (user_id, balance, total_recharge, total_otp) 
            VALUES (?, ?, ?, ?)");
        $insert_query->bind_param("sddd", $user_id, $amount, $amount, $quantity);
        $insert_query->execute();
        $insert_query->close();
    }



    $query_1 = $conn->query("INSERT INTO upi_recharge SET amount = '$amount', user_id = '$user_id', txn_id = '$tx_ref', recharge_time = '".Date("Y:m:d H:i:s")."', status = 'paid'");

    if($query_1){
        $wallet->closeConnection();
        header("location: flutterwavepayment.php");        
    }
}
$wallet->closeConnection();
header("location: flutterwavepayment.php");
?>