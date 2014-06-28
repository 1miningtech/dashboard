<?php
$html = file_get_contents('http://localhost/1m.php');
$explode = explode('----------',$html);
$json = $explode[1];
echo $json;