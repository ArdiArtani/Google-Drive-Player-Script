<?php
error_reporting(0);
include "curl_gd.php";

if($_POST['submit'] != ""){
	$url = $_POST['url'];
	$linkdown = Drive($url);
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title>Get link Google Drive</title>
</head>
<body>

	<!-- Styles -->
  <link rel="stylesheet" href="https://cdn.plyr.io/2.0.13/plyr.css">

  <!-- Docs styles -->
  <link rel="stylesheet" href="https://cdn.plyr.io/2.0.13/demo.css">
	<style>
		.container {
		  max-width: 800px;
		  margin: 0 auto;
		}
		.plyr {
		  border-radius: 4px;
		  margin-bottom: 15px;
		}
	</style>

	<div class="container">
		<form action="" method="POST">
			<input type="text" size="80" name="url" value="https://drive.google.com/file/d/0ByaRd0R0Qyatcmw2dVhQS0NDU0U/view"/>
			<input type="submit" value="GET" name="submit" />
		</form>
		<br />

	  <video controls crossorigin>
	    <!-- Video files -->
	    <source src="<?php echo $linkdown;?>" type="video/mp4">

	    <!-- Fallback for browsers that don't support the <video> element -->
	    <a href="<?php echo $linkdown;?>" download>Download</a>
	  </video>
	</div>

	<!-- Plyr core script -->
 <script src="https://cdn.plyr.io/2.0.13/plyr.js"></script>

 <!-- Docs script -->
 <script src="https://cdn.plyr.io/2.0.13/demo.js"></script>

</body>
</html>
