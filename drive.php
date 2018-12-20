<?php

	define("base_url", "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
	define("googledrive_key", "AIzaSyD739-eb6NzS_KbVJq1K8ZAxnrMfkIqPyw");

	//Create folder if it doesn't already exist
	if (!file_exists('cache')) {
	  mkdir('cache', 0777, true);
	}

	function GoogleDrive($gid){
		$iframeid = my_simple_crypt($gid);
		$title = gdTitle($gid);
		$image = sprintf('https://drive.google.com/thumbnail?id=%s&authuser=0&sz=w640-h360-n-k-rw', $gid);
		$streaming_vid = Drive($gid);
		$output = ['id' => $gid, 'title' => $title, 'image' => $image, 'label' => 'HD', 'file' => $streaming_vid, 'type' => 'video/mp4', 'embed_id' => $iframeid];
		$output = json_encode($output, JSON_PRETTY_PRINT);
		return $output;
	}

	function Drive($gid) {
		$timeout = 900;
		$file_name = md5('GD'.$gid.'player');
		if(file_exists('cache/'.$file_name.'.cache')) {
			$fopen = file_get_contents('cache/'.$file_name.'.cache');
			$data = explode('@@', $fopen);
			$now = gmdate('Y-m-d H:i:s', time() + 3600*(+7+date('I')));
			$times = strtotime($now) - $data[0];
			if($times >= $timeout) {
				$json_api = file_get_contents(sprintf('https://filedeo.com/api.php?id=%1$s&api=%2$s', $gid, googledrive_key));
				$source = json_decode($json_api, true);
				$source = $source['source'];
				$create_cache	= gdrive_cache($gid, $source);
				$arrays = explode('|', $create_cache);
				$cache = $arrays[0];
			} else {
				$cache = $data[1];
			}
		} else {
			$json_api = file_get_contents(sprintf('https://filedeo.com/api.php?id=%1$s&api=%2$s', $gid, googledrive_key));
			$source = json_decode($json_api, true);
			$source = $source['source'];
			$create_cache	= gdrive_cache($gid, $source);
			$arrays = explode('|', $create_cache);
			$cache = $arrays[0];
		}
		return $cache;
	}

	function gdrive_cache($gid, $source) {
		$time = gmdate('Y-m-d H:i:s', time() + 3600*(+7+date('I')));
		$file_name = md5('GD'.$gid.'player');
		$string = strtotime($time).'@@'.$source;
		$file = fopen("cache/".$file_name.".cache",'w');
		fwrite($file,$string);
		fclose($file);
		if(file_exists('cache/'.$file_name.'.cache')) {
			$msn = $source;
		} else {
			$msn = $source;
		}
		return $msn;
	}

	function get_drive_id($string) {
	  if (strpos($string, "/edit")) {
	    $string = str_replace("/edit", "/view", $string);
	  } else if (strpos($string, "?id=")) {
	    $parts = parse_url($string);
	    parse_str($parts['query'], $query);
	    return $query['id'];
	  } else if (!strpos($string, "/view")) {
	    $string = $string . "/view";
	  }
	  $start  = "file/d/";
	  if(strpos($string, "/preview")){
	    $end = "/preview";
	  }elseif(strpos($string, "/view")){
	    $end = "/view";
	  }
	  $string = " " . $string;
	  $ini    = strpos($string, $start);
	  if ($ini == 0) {
	    return null;
	  }
	  $ini += strlen($start);
	  $len = strpos($string, $end, $ini) - $ini;
	  return substr($string, $ini, $len);
	}

	function gdTitle($gid) {
		$title = file_get_contents('https://content.googleapis.com/drive/v2/files/'.$gid.'?key='.googledrive_key);
		$title = json_decode($title, true);
		return $title['title'];
	}

	function fetch_value($str, $find_start = '', $find_end = ''){
	  if ($find_start == '') {
	      return '';
	  }
	  $start = strpos($str, $find_start);
	  if ($start === false) {
	      return '';
	  }
	  $length = strlen($find_start);
	  $substr = substr($str, $start + $length);
	  if ($find_end == '') {
	      return $substr;
	  }
	  $end = strpos($substr, $find_end);
	  if ($end === false) {
	      return $substr;
	  }

	  return substr($substr, 0, $end);
	}

	function my_simple_crypt( $string, $action = 'e' ) {
	  $secret_key = 'drivekey';
	  $secret_iv = 'google';
	  $output = false;
	  $encrypt_method = "AES-256-CBC";
	  $key = hash( 'sha256', $secret_key );
	  $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	  if( $action == 'e' ) {
	    $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	  }else if( $action == 'd' ){
	    $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	  }
	  return $output;
	}

?>
