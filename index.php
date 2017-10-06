<?php
	error_reporting(0);
	include "curl_gd.php";

	if($_POST['submit'] != ""){
		$url = $_POST['url'];
		$gid = get_drive_id($url);
		$iframeid = my_simple_crypt($gid);
		$backup = 'https://drive.google.com/file/d/'.$gid.'/preview';
		$posterimg = PosterImg($backup);
		$linkdown = Drive($url);
		$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$linkdown.'"}]';
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title>Embed google drive generator</title>
</head>
<body>

  <!-- Docs styles -->
  <link rel="stylesheet" href="https://cdn.plyr.io/2.0.13/demo.css">
	<style>
		.container {
		  max-width: 800px;
		  margin: 0 auto;
		}
	</style>

	<div class="container">
		<br />
		<form action="" method="POST">
			<input type="text" size="80" name="url" value="https://drive.google.com/file/d/0ByaRd0R0Qyatcmw2dVhQS0NDU0U/view"/>
			<input type="submit" value="GET" name="submit" />
		</form>
		<br/>

		<div id="myElement">Paste the url and click the get button.</div>

		<div><?php if($iframeid){echo '<textarea style="margin:10px;width: 97%;height: 80px;">&lt;iframe src="embed.php?url='.$iframeid.'" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen&gt;&lt;/iframe&gt;</textarea>';}?></div>

	</div>

	<script src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
	<script type="text/javascript">
		jwplayer("myElement").setup({
			playlist: [{
				"image": "<?php echo $posterimg; ?>",
				"sources":<?php echo $file?>
			}],
			allowfullscreen: true,
			width: '100%',
			aspectratio: '16:9',
		});
	</script>

</body>
</html>
