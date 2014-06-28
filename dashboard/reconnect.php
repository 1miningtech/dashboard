<pre>
<?php require_once("header.php") ?>
<?php
echo exec('/home/pi/reconnect');
echo exec('wpa_cli status');