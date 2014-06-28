<?php
//v1 variables
$host = $_SERVER['HTTP_HOST'];

$antminer1_ip = '192.168.2.11';
$antminer2_ip = '192.168.2.12';
$antminer3_ip = '192.168.2.13';
$antminer4_ip = '192.168.2.14';
$antminer5_ip = '192.168.2.15';

//v1 dont touch
$antminer1_api_url1 = "http://$antminer1_ip/api.txt";
$antminer1_api_url2 = "http://$antminer1_ip/api-stats.txt";

$antminer2_api_url1 = "http://$antminer2_ip/api.txt";
$antminer2_api_url2 = "http://$antminer2_ip/api-stats.txt";

$antminer3_api_url1 = "http://$antminer3_ip/api.txt";
$antminer3_api_url2 = "http://$antminer3_ip/api-stats.txt";

$antminer4_api_url1 = "http://$antminer4_ip/api.txt";
$antminer4_api_url2 = "http://$antminer4_ip/api-stats.txt";

$antminer5_api_url1 = "http://$antminer5_ip/api.txt";
$antminer5_api_url2 = "http://$antminer5_ip/api-stats.txt";

$cgminer_url = "http://$host/cgminer.php";

//v2 variables
$cgminer_url = "http://localhost/dashboard/json.php";