<?php
function base64_url_decode($input) {
 return base64_decode(strtr($input, '._-', '+/='));
}
$docurl = base64_url_decode($_GET['u']);
header('Location: '.$docurl.'');

?>
 
