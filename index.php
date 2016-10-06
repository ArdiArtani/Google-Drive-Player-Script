<?php
error_reporting(E_ERROR | E_PARSE);
require_once 'curl.class.php';

function curl1($url){
	if (strpos($url,'drive.google') == true) {
		if (preg_match('@https?://(?:[\w\-]+\.)*(?:drive|docs)\.google\.com/(?:(?:folderview|open|uc)\?(?:[\w\-\%]+=[\w\-\%]*&)*id=|(?:folder|file|document|presentation)/d/|spreadsheet/ccc\?(?:[\w\-\%]+=[\w\-\%]*&)*key=)([\w\-]{28,})@i', $url, $match)) {
            $id = $match[1];
			$u = 'https://drive.google.com/file/d/'.$id.'/view?pli=1';
        }
	}else{
		$u = $url;
	}

    $curl = new NEWCURL;
     $curl->get('https://www.proxfree.com/','',2);
     $curl->httpheader = array(
     'Referer:https://de.proxfree.com/permalink.php?url=eKcKvRAsZMJp3EkmD1K78%2Bqx%2FrqnRtIHySNzmMxUbxvJ%2FxfYKDbfQTtfxlzFz63ZA2PxrVLbAzRji7PR98co4KUo8OToTy25nhXHdedVcXsUt3WZdBKH09owwj58mvXq&bit=1',
    'Upgrade-Insecure-Requests:1',
    'Content-Type:application/x-www-form-urlencoded',
    'Cache-Control:max-age=0',
    'Connection:keep-alive',
    'Accept-Language:en-US,en;q=0.8,vi;q=0.6,und;q=0.4',

     );

     $y=( $curl->post('https://de.proxfree.com/request.php?do=go&bit=1',"pfipDropdown=default&get=$u",4) );
     return ($curl->get($y[0]["Location"],'',2));
}

//Google Drive
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

	return $js;
}


echo Drive('https://drive.google.com/file/d/0B_gSLjUc_vsjcDNLd3dwNHJ3cHM/preview');
