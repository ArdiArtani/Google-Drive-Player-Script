<?php
	include_once("drive.php");
	if(isset($_GET['id'])){
		$eid = htmlspecialchars($_GET['id']);
		$results = file_get_contents(base_url.'json.php?id=https://drive.google.com/file/d/'.my_simple_crypt($eid, 'd').'/preview');
		$results = json_decode($results, true);
		// if($results['file']==1){
	  //   echo '<center>Sorry, the owner hasn\'t given you permission to download this file.</center>';
		// 	exit;
	  // }elseif($results['file']==2) {
		// 	echo '<center>Error 404. We\'re sorry. You can\'t access this item because it is in violation of our Terms of Service.</center>';
		// 	exit;
	  // }
	}
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $results['title'];?></title>
	<!-- Plyr.io Player -->
	<link rel="stylesheet" href="https://cdn.plyr.io/3.3.12/plyr.css">
</head>
<body style="margin:0px;">
	<video poster="<?php echo $results['image']; ?>" id="player" playsinline controls>
		<source src="<?php echo $results['file'];?>" type="<?php echo $results['type'];?>">
	</video>
	<!-- Plyr JS -->
	<script src="https://cdn.plyr.io/3.3.12/plyr.js"></script>
	<script>const player = new Plyr('#player');</script>
  </body>
</html>
