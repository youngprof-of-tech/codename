<?php
require_once __DIR__ . '/include/config.php';
if(!isset($_SESSION['token'])){
	header('location: index');
}
include_once __DIR__ . '/theam/' . THEAM . '/404.php';
?>