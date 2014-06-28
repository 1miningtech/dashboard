<pre>
<?php
$settings = file_get_contents('http://192.168.2.11/cgminer.txt');
$settings = file_get_contents('http://192.168.2.12/cgminer.txt');
$settings = file_get_contents('http://192.168.2.13/cgminer.txt');
$settings = file_get_contents('http://192.168.2.14/cgminer.txt');
$settings = file_get_contents('http://192.168.2.15/cgminer.txt');
$settings = explode("'",$settings);

$c_pool1url = $settings['15'];
$c_pool1user = $settings['17'];
$c_pool1pw = $settings['19'];

$c_pool2url = $settings['21'];
$c_pool2user = $settings['23'];
$c_pool2pw =$settings['25'];
?>
<?php require_once("header.php") ?>
<form style="margin:0">
<input type="text" name="pool1url" value="<?php echo $c_pool1url ?>">pool1url<br/>
<input type="text" name="pool1user" value="<?php echo $c_pool1user ?>">pool1user<br/>
<input type="text" name="pool1pw" value="<?php echo $c_pool1pw ?>">pool1pw<br/>
<input type="text" name="pool2url" value="<?php echo $c_pool2url ?>">pool2url<br/>
<input type="text" name="pool2user" value="<?php echo $c_pool2user ?>">pool2user<br/>
<input type="text" name="pool2pw" value="<?php echo $c_pool2pw ?>">pool2pw<br/>
<input type="submit">
</form>
<?php
if($_GET):
$pool1url = $_GET['pool1url'];
$pool1user = $_GET['pool1user'];
$pool1pw = $_GET['pool1pw'];

$pool2url = $_GET['pool2url'];
$pool2user = $_GET['pool2user'];
$pool2pw = $_GET['pool2pw'];

//write
$file = fopen("/tmp/cgminer","w");
echo fwrite($file,"config cgminer 'default'
option chip_frequency '282'
option miner_count '24'
option api-listen
option api_allow 'W:127.0.0.1,0.0.0.0/0'
option more_options '--quiet'
option target '60'
option overheat '70'
option pool1url '$pool1url'
option pool1user '$pool1user'
option pool1pw '$pool1pw'
option pool2url '$pool2url'
option pool2user '$pool2user'
option pool2pw '$pool2pw'
");
fclose($file); echo "\n";

//printout
$response = array();
exec('sudo cat /tmp/cgminer',$response);
print_r($response); echo "\n";

//remove
//echo exec('sudo rm /etc/config/cgminer'); echo "\n";

//replace
//echo exec('sudo mv /tmp/cgminer /etc/config/cgminer');
else:
$response = array();
exec('sudo cat /tmp/cgminer',$response);
print_r($response); echo "\n";	
endif;
?>
<input type="submit" value="Upload" onclick="window.location=('/uploadsettings.php')"><input type="submit" value="Reboot" onclick="window.location=('/reboot.php')">
