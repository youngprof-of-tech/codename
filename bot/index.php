<?php
require_once __DIR__ . '/../include/config.php';
function generateToken($prefix = 'TOKEN-', $length = 10) {
    // Generate a random string of specified length
    $randomString = bin2hex(random_bytes($length));

    // Concatenate the prefix and random string
    $token = $prefix . time() . '-' . $randomString;

    return $token;
}



$botToken = BOT_TOKEN;
$apiUrl = 'https://api.telegram.org/bot' . $botToken;

// Determine the current directory dynamically

// Handling incoming messages
$update = file_get_contents('php://input');
$update = json_decode($update, true);

if (isset($update['message']['text'])) {
    $chatId = $update['message']['chat']['id'];
$sql00 = mysqli_query($conn,"SELECT * FROM bot_data WHERE user_id='$chatId'");
if(mysqli_num_rows($sql00) == 0){
$token = generateToken();
 mysqli_query($conn,"INSERT INTO bot_data(user_id,token) VALUES ('".$chatId."','".$token."')");
}else{
$ss = mysqli_fetch_assoc($sql00);
$token = $ss['token'];
}
   $replyText = 'Your Access Token is: `'.$token.'`

Don\'t Share this Access Token to anyone
           
Regards ' . $web_name;


    // Send the reply
    $ch = curl_init($apiUrl . '/sendMessage?chat_id=' . $chatId . '&text=' . urlencode($replyText).'&parse_mode=MarkDown');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
    
}

?>
