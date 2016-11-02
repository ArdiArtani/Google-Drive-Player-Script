<?php
class NEWCURL
{
    var $contents;
    var $_header;
    var $headers = array();
    var $body;
    var $url = "";
    var $realm;
    var $ua = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1) Gecko/20061010 Firefox/2.0";
    var $proxy;
    var $prtype;
    var $tout = 10;
    var $opts = false;
    var $cookiefile = "cookie.txt";
    var $httpheader = array();
    var $follow = false;
    var $referer = "";
    var $ch;

	function __construct(){
		$this->cookiefile = "cookie.txt";
	}
    function exec($method, $url, $vars = "", $h = 1)
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_HEADER, ($h == 2) ? 0 : 1);

        if (is_array($this->realm)) {
            curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($this->ch, CURLOPT_USERPWD, $this->realm[0] . ':' . $this->realm[1]);
        }

        if ($this->proxy != "") {
            if (strstr($this->proxy, "@")) {
                $t = explode("@", $this->proxy);
                $up = $t[0];
                $ip = $t[1];
            }
            curl_setopt($this->ch, CURLOPT_HTTPPROXYTUNNEL, 1) ;
            curl_setopt($this->ch, CURLOPT_PROXY, isset($ip) && $ip ? $ip : $this->proxy);
            curl_setopt($this->ch, CURLOPT_PROXYTYPE, $this->prtype);
            if (isset($up) && $up) {
                curl_setopt($this->ch, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);
                curl_setopt($this->ch, CURLOPT_PROXYUSERPWD, $up);
            }
        }

        if ($this->ua)
            curl_setopt($this->ch, CURLOPT_USERAGENT, $this->ua);
        if ($this->referer || $this->url)
            curl_setopt($this->ch, CURLOPT_REFERER, $this->referer ? $this->referer : $this->
                url);

        if ($this->follow)
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        if (strncmp($url, "https", 6)) {
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookiefile);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookiefile);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->tout);

        if (count($this->httpheader)) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->httpheader);
        }

        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->tout);
        if ($method == 'POST') {
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $vars);
        }

        if (is_array($this->opts) && $this->opts != false) {
            foreach ($this->opts as $k => $v) {
                curl_setopt($this->ch, $k, $v);
            }
        }

        $data = curl_exec($this->ch);
        $this->url = $url;

        if ($data) {
            if (preg_match("/^HTTP\/1\.1 302/", $data) && $h != 2 && strstr($data, "\r\n\r\nHTTP/1.1 200")) {
                $pos = strpos($data, "\r\n\r\n");
                $data = substr($data, $pos + 4);
            }

            if ($h == 1 || $h == 2)
                return $data;
            else {
                $pos = strpos($data, "\r\n\r\n");
                $this->body = substr($data, $pos + 4);
                $this->_header = substr($data, 0, $pos);
                $this->_header = explode("\r\n", trim($this->_header));
                foreach ($this->_header as $v) {
                    $v = explode(":", $v, 2);
                    $this->headers[$v[0]] = isset($v[1]) ? trim($v[1]) : '';
                }
                return $h == 3 ? $this->headers : array($this->headers, $this->body);
            }

        } else {
            return curl_error($this->ch);
        }
    }

    function proxy($proxy, $prtype = CURLPROXY_HTTP)
    { //CURLPROXY_SOCKS5
        $this->proxy = $proxy;
        $this->prtype = $prtype;
    }

    function settimeout($timeout)
    {
        $this->tout = $timeout;
    }

    function get($url,$vars, $h = 1)
    {
        $ret = $this->exec('GET', $url, $vars, $h);
        //$this->close();
        return $ret;
    }

    function post($url, $vars, $h = 1)
    {
        $ret = $this->exec('POST', $url, $vars, $h);
        //$this->close();
        return $ret;
    }

    function setopt($opt, $value = true)
    {
        $this->opts[$opt] = $value;
    }

    function seturl($url)
    {
        $this->url = $url;
    }

    function close()
    {
        curl_close($this->ch);
    }
}

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
