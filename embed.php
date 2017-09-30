<?php
error_reporting(0);
include "curl_gd.php";
$yoursite = ""; // //www.yourdomain.com/Google-Drive-Player-Script no slash on end 
function base64_url_encode($input) {
 return strtr(base64_encode($input), '+/=', '._-');
}
if($_GET['url'] != ""){
	$gid = $_GET['url'];
	$original_id = my_simple_crypt($gid, 'd');
	$title = fetch_value(file_get_contents_curl('https://drive.google.com/get_video_info?docid='.$original_id), "title=", "&");
	$url = 'https://drive.google.com/file/d/'.$original_id.'/view';
	$linkdown = Drive($url);
	$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$yoursite.'/video.php?u='.base64_url_encode($linkdown).'"}]';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title><?php echo $title?> - Google Drive</title>
</head>
<body>

	<div id="myElement"></div>

	<script src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
	<script type="text/javascript">
		jwplayer("myElement").setup({
			playlist: [{
				"sources":<?php echo $file?>
			}],
			allowfullscreen: true,
			width: '100%',
			aspectratio: '16:9',
		});
	</script>

</body>
</html>
