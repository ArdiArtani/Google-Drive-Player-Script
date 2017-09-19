<?php
include "curl_gd.php";
header('Content-Type: application/json');
if($_GET['url'] != ""){
	$subfject = $_GET['url'];
    if (strpos($subfject, 'drive.google.com/file/d/') !== false) {
    $pattern='/(?<=file\/d\/)(.*)(?=\/)/';
    $succefss = preg_match($pattern, $subfject, $maftch);
    $kzty = "google_drive";
     $txpex = "drv";
    $dbken = $maftch[0];
} else if (strpos($subfject, 'drive/v3/files') !== false) {
    $pattern = '/(?<=drive\/v3\/files\/)(.*)(?=\?alt)/';
     $txpex = "drv3";
     $succefss = preg_match($pattern, $subfject, $maftch);
    $dbken = $maftch[0];
     $kzty = "google_drive";
} else {
    $pattern = 'xx';
     $txpex = "e";
     $kzty = "d";
}
	
	$title = fetch_value(file_get_contents_curl('https://drive.google.com/get_video_info?docid='.$dbken), "title=", "&");
	$url = 'https://drive.google.com/file/d/'.$dbken.'/view';
    $backup = 'https://drive.google.com/file/d/'.$dbken.'/preview';
	$linkdown = Drive($url);
	  $vid['result'][0] = array();
  $vid['result'][0]['info']['title'] = $title;
  $vid['result'][0]['link'] = $linkdown;
  $vid['result'][0]['og'] = $backup;
  $vid['result'][0]['img'] = PosterImg($backup);
    $vidarray = json_encode($vid, JSON_PRETTY_PRINT);
echo $vidarray;
}

?>
