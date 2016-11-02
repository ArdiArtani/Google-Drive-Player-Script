<?php
error_reporting(E_ERROR | E_PARSE);
if(!function_exists('curl1'))
require_once dirname(__FILE__).'/curl.class.php';
function Drive($link) {
	$url = urldecode($link);
	$get = curl1($url);

	$data = explode(',["fmt_stream_map","', $get);
	$data = explode('"]', $data[1]);
	$data = str_replace(array('\u003d', '\u0026'), array('=', '&'), $data[0]);
	$data = explode(',', $data);
	asort($data);
	foreach($data as $list) {
		$data2 = explode('|', $list);
		if($data2[0] == 37) {$q1080p	.= '1080p=>'.preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]).'|';}
		if($data2[0] == 22) {$q720p	.= '720p=>'.preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]).'|';}
		if($data2[0] == 59) {$q480p	.= '480p=>'.preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]).'|';}
		if($data2[0] == 18) {$q360p	.= '360p=>'.preg_replace("/\/[^\/]+\.google\.com/","/redirector.googlevideo.com",$data2[1]).'|';}
	}
	$js = $q1080p.'<br />';
	$js .= $q720p.'<br />';
	$js .= $q480p.'<br />';
	$js .= $q360p.'<br />';
	return rtrim($js, '|<br />');
}

echo Drive('https://drive.google.com/file/d/0B_gSLjUc_vsjcDNLd3dwNHJ3cHM/preview');
