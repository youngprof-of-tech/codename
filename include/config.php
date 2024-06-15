<?php
//error_reporting(0);

date_default_timezone_set('Asia/Kolkata');
define('DB_SERVER', 'localhost'); //localhost
define('DB_USERNAME', 'root'); // db username
define('DB_PASSWORD', ''); // db password
define('DB_DATABASE', 'onemedia_mrsingh'); // db name
//define('BOT_TOKEN', '6832790387:AAGpysEXbNND9ByrX2D5MdzrM-hdej6JTRU'); // bot token

require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../class/class.control.php';
$site_sql = $conn->query("SELECT * FROM settings WHERE id='1'");
$site_data = $site_sql->fetch_assoc();
$theam = $site_data['theam'];
$website_url = 'http://'.$_SERVER['HTTP_HOST'];


define("THEAM", $theam);
define("WEBSITE_URL",'https://cheapestotp.store');

?>