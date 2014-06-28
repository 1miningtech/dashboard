<?php
require_once("config.php");

//antminer1
if($antminer1_ip):
$antminer1_api1 = file_get_contents($antminer1_api_url1);
$antminer1_api2 = file_get_contents($antminer1_api_url2);

$antminer1_api1_array = explode(',',$antminer1_api1);
$antminer1_api2_array = explode(',',$antminer1_api2);
endif;

//antminer2
if($antminer2_ip):
$antminer2_api1 = file_get_contents($antminer2_api_url1);
$antminer2_api2 = file_get_contents($antminer2_api_url2);

$antminer2_api1_array = explode(',',$antminer2_api1);
$antminer2_api2_array = explode(',',$antminer2_api2);
endif;

//antminer3
if($antminer3_ip):
$antminer3_api1 = file_get_contents($antminer3_api_url1);
$antminer3_api2 = file_get_contents($antminer3_api_url2);

$antminer3_api1_array = explode(',',$antminer3_api1);
$antminer3_api2_array = explode(',',$antminer3_api2);
endif;

//antminer4
if($antminer4_ip):
$antminer4_api1 = file_get_contents($antminer4_api_url1);
$antminer4_api2 = file_get_contents($antminer4_api_url2);

$antminer4_api1_array = explode(',',$antminer4_api1);
$antminer4_api2_array = explode(',',$antminer4_api2);
endif;

//antminer5
if($antminer5_ip):
$antminer5_api1 = file_get_contents($antminer5_api_url1);
$antminer5_api2 = file_get_contents($antminer5_api_url2);

$antminer5_api1_array = explode(',',$antminer5_api1);
$antminer5_api2_array = explode(',',$antminer5_api2);
endif;

//debug
if($_GET['debug'])
{
	echo "<pre>";
	print_r($antminer1_api1);
	echo "<hr>";
	print_r($antminer1_api2);
	echo "<hr>";
	print_r($antminer2_api1);
	echo "<hr>";
	print_r($antminer2_api2);
	echo "<hr>";
	print_r($antminer3_api1);
	echo "<hr>";
	print_r($antminer3_api2);
	echo "<hr>";
	print_r($antminer4_api1);
	echo "<hr>";
	print_r($antminer4_api2);
	echo "<hr>";
	print_r($antminer5_api1);
	echo "<hr>";
	print_r($antminer5_api2);

	die;
}

//antminer 1 api
$output['am1']['ghs_5s'] = str_replace('GHS 5s=','',$antminer1_api1_array[6]);
$output['am1']['ghs_av'] = str_replace('GHS av=','',$antminer1_api1_array[7]);
$output['am1']['found_blocks'] = str_replace('Found Blocks=','',$antminer1_api1_array[8]);
$output['am1']['accepted'] = str_replace('Accepted=','',$antminer1_api1_array[10]);
$output['am1']['rejected'] = str_replace('Rejected=','',$antminer1_api1_array[11]);
//antminer 1 api stats
$output['am1']['temp1'] = str_replace('temp1=','',$antminer1_api2_array[23]);
$output['am1']['temp2'] = str_replace('temp2=','',$antminer1_api2_array[24]);

//antminer 2 api
$output['am2']['ghs_5s'] = str_replace('GHS 5s=','',$antminer2_api1_array[6]);
$output['am2']['ghs_av'] = str_replace('GHS av=','',$antminer2_api1_array[7]);
$output['am2']['found_blocks'] = str_replace('Found Blocks=','',$antminer2_api1_array[8]);
$output['am2']['accepted'] = str_replace('Accepted=','',$antminer2_api1_array[10]);
$output['am2']['rejected'] = str_replace('Rejected=','',$antminer2_api1_array[11]);
//antminer 2 api stats
$output['am2']['temp1'] = str_replace('temp1=','',$antminer2_api2_array[23]);
$output['am2']['temp2'] = str_replace('temp2=','',$antminer2_api2_array[24]);

//antminer 3 api
$output['am3']['ghs_5s'] = str_replace('GHS 5s=','',$antminer3_api1_array[6]);
$output['am3']['ghs_av'] = str_replace('GHS av=','',$antminer3_api1_array[7]);
$output['am3']['found_blocks'] = str_replace('Found Blocks=','',$antminer3_api1_array[8]);
$output['am3']['accepted'] = str_replace('Accepted=','',$antminer3_api1_array[10]);
$output['am3']['rejected'] = str_replace('Rejected=','',$antminer3_api1_array[11]);
//antminer 3 api stats
$output['am3']['temp1'] = str_replace('temp1=','',$antminer3_api2_array[23]);
$output['am3']['temp2'] = str_replace('temp2=','',$antminer3_api2_array[24]);

//antminer 4 api
$output['am4']['ghs_5s'] = str_replace('GHS 5s=','',$antminer4_api1_array[6]);
$output['am4']['ghs_av'] = str_replace('GHS av=','',$antminer4_api1_array[7]);
$output['am4']['found_blocks'] = str_replace('Found Blocks=','',$antminer4_api1_array[8]);
$output['am4']['accepted'] = str_replace('Accepted=','',$antminer4_api1_array[10]);
$output['am4']['rejected'] = str_replace('Rejected=','',$antminer4_api1_array[11]);
//antminer 4 api stats
$output['am4']['temp1'] = str_replace('temp1=','',$antminer4_api2_array[23]);
$output['am4']['temp2'] = str_replace('temp2=','',$antminer4_api2_array[24]);

//antminer 5 api
$output['am5']['ghs_5s'] = str_replace('GHS 5s=','',$antminer5_api1_array[6]);
$output['am5']['ghs_av'] = str_replace('GHS av=','',$antminer5_api1_array[7]);
$output['am5']['found_blocks'] = str_replace('Found Blocks=','',$antminer5_api1_array[8]);
$output['am5']['accepted'] = str_replace('Accepted=','',$antminer5_api1_array[10]);
$output['am5']['rejected'] = str_replace('Rejected=','',$antminer5_api1_array[11]);
//antminer 5 api stats
$output['am5']['temp1'] = str_replace('temp1=','',$antminer5_api2_array[23]);
$output['am5']['temp2'] = str_replace('temp2=','',$antminer5_api2_array[24]);

//output
echo json_encode($output);
?>