<?php
require_once __DIR__ . '/../../include/config.php';
function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';

    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $random_string;
}
function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $otp;
}
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$deviceString = "";
$current_time_in_ist = date('Y-m-d H:i:s');
if (preg_match('/iPhone|iPad|iPod/i', $user_agent)) {
    $deviceString = "Device: Apple iOS";
} elseif (preg_match('/Android/i', $user_agent)) {
    $deviceString = "Device: Android";
} elseif (preg_match('/Windows Phone/i', $user_agent)) {
    $deviceString = "Device: Windows Phone";
} elseif (preg_match('/Macintosh|Mac OS X/i', $user_agent)) {
    $deviceString = "Device: Macintosh (Mac)";
} elseif (preg_match('/Windows/i', $user_agent)) {
    $deviceString = "Device: Windows";
} elseif (preg_match('/Linux/i', $user_agent)) {
    $deviceString = "Device: Linux";
} else {
    $deviceString = "Device: Unknown";
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];
$browserData = "";

// Use a regular expression to extract browser and version
if (preg_match('/(MSIE|Edge|Firefox|Chrome|Safari|Opera)[\/\s](\d+\.\d+)/i', $user_agent, $matches)) {
    $browser = $matches[1]; // Browser name
    $version = $matches[2]; // Browser version
    $browserData = "Browser: " . $browser . " " . $version;
} else {
    $browserData = "Browser information not found.";
}



if(!isset($_POST['email']) || $_POST['email'] ==""){
echo'{"status": "2","msg": "Enter Email"}';
}elseif(!isset($_POST['password']) || $_POST['password'] ==""){
echo'{"status": "2","msg": "Enter Password"}';
}else{
$email = $_POST['email'];
$password = md5($_POST['password']);
$sql = $conn->prepare("SELECT * FROM user_data WHERE email=? and password=?");
$sql->bind_param("ss", $email, $password);
$sql->execute();
$result = $sql->get_result();
$data = $result->fetch_assoc();
// check if user exist
if ($result->num_rows > 0) {
if($data['status']=="1"){
$user_id=$data['id'];
$token = generateRandomString();
$user_ip = $_SERVER['REMOTE_ADDR'];
$_SESSION['token'] = $token;
$_SESSION['user_id'] = $user_id;
if($data['type'] == "admin"){
$_SESSION['admin'] = $token;
}
//$otp = generateOTP();
$otp = '';

$sql22 = mysqli_query($conn,"SELECT * FROM login_token WHERE user_id='".$user_id."'");
if(mysqli_num_rows($sql22)==0){
    
/*$sql2 = $conn->query("INSERT INTO login_token(user_id, token, create_date, device, browser, ip, otp, status) VALUES ('".$user_id."','".$token."','".$current_time_in_ist."','".$deviceString."','".$browserData."','".$user_ip."','".$otp."','3')");*/

$sql2 = $conn->query("INSERT INTO login_token(user_id, token, create_date, device, browser, ip, otp, status) VALUES ('".$user_id."','".$token."','".$current_time_in_ist."','".$deviceString."','".$browserData."','".$user_ip."','".$otp."','1')");
}else{
    
//$sql23 = $conn->query("UPDATE login_token SET token='".$token."', otp='".$otp."', status='3' WHERE user_id='".$user_id."'");

$sql23 = $conn->query("UPDATE login_token SET token='".$token."', otp='".$otp."', status='1' WHERE user_id='".$user_id."'");
}

/*$msg = 'Login Verification

Dear User,

We have detected a login attempt on your account from a new device. To ensure the security of your account, please use the following One-Time Password (OTP) for verification:

Your OTP: `'.$otp.'`

If you did not attempt to log in, please ignore this message.

Regards ' . $web_name;

$apiUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage?chat_id=".$data['username']."&text=".urlencode($msg)."&parse_mode=MarkDown";
$data = [
    'chat_id' => $data['username'],
    'text' => urlencode($msg),
    'parse_mode' => 'MarkDown',
];

   $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
*/

  echo '{"status": "1", "msg": "Login Successfully"}';
}else{
    echo '{"status": "2", "msg": "Account Blocked"}';
}    
} else {
    echo '{"status": "2", "msg": "Invalid Email And Password"}';
}

}
$conn->close();
?>
