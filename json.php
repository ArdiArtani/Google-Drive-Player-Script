<?php
	error_reporting(0);
	include "curl_gd.php";
	$url = isset($_GET['url']) ? htmlspecialchars($_GET['url']) : null;
	if(empty($url)) {
	  $url = 'https://drive.google.com/file/d/0ByaRd0R0Qyatcmw2dVhQS0NDU0U/view';
	}
	$gid = get_drive_id($url);
	$results = GoogleDrive($gid);
	echo $results;
?>
