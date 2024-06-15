<?php

$apiUrl = 'https://allotp.xyz/api/recharge/crypto/getPrice';

$ch = curl_init($apiUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Someting Went Wrong';
} else {
    echo $response;
}

curl_close($ch);

?>
