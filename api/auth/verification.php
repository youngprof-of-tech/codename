<?php
require_once __DIR__ . '/../../include/config.php';
if(!isset($_POST['token']) || $_POST['token'] ==""){
echo'{"status": "2","msg": "Token Missing"}';
}elseif(!isset($_POST['otp']) || $_POST['otp'] ==""){
echo'{"status": "2","msg": "Enter Otp"}';
} else {
$token = mysqli_real_escape_string($conn,$_POST['token']); 
$find_token = new radiumsahil();
$check_token = $find_token->check_token($token);
$find_token->closeConnection();
if($check_token === false){
echo'{"status": "3","msg": "Token Expired Please Logout And Login Again"}';
}else{
$otp = mysqli_real_escape_string($conn,$_POST['otp']); 
$sql=$conn->query("SELECT* FROM login_token WHERE token='$token'");
$data=$sql->fetch_assoc();
if($data['status'] == "3"){
if($data['otp'] == $otp){
$sql2=$conn->query("UPDATE login_token SET status='1' WHERE token='$token'");
echo'{"status": "1","msg": "Verification Success"}';
}else{
echo'{"status": "2","msg": "Invalid Otp"}';
}
}elseif($data['status'] == "1"){
echo'{"status": "1","msg": "Otp Already Verify"}';
} else {
echo'{"status": "2","msg": "Token Expired"}';
}
}
}
?>