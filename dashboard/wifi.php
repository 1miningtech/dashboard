<style>
body
{
	margin:50px;
}
</style>
<pre>
<?php require_once("header.php") ?>
<form style="margin:0">
<input type="text" name="ssid" value="<?php echo $_GET['ssid'] ?>">ssid<br/>
<input type="text" name="psk" value="<?php echo $_GET['psk'] ?>">password<br/>
<select name="type">
<option value="WPA2" <?php if($_GET['type'] == 'WPA2') echo 'selected' ?>>WPA2-PSK</options>
<option value="WPA" <?php if($_GET['type'] == 'WPA') echo 'selected' ?>>WPA-PSK</options>
<option value="WEP" <?php if($_GET['type'] == 'WEP') echo 'selected' ?>>WEP</options>
<option value="none" <?php if($_GET['type'] == 'none') echo 'selected' ?>>None</options>
</select>

<input type="submit">
</form>
<?php
if($_GET):
$type = $_GET['type'];

$ssid = $_GET['ssid'];
$psk = $_GET['psk'];
$auth_alg = 'OPEN';

if($type == 'WPA2') $proto = 'RSN';
if($type == 'WPA') $proto = 'WPA';
if($type == 'WPA2' or $type == 'WPA') $key_mgmt = 'WPA-PSK'; else $key_mgmt = 'NONE';
if($type == 'WPA2') $pairwise = 'CCMP';
if($type == 'WPA') $pairwise = 'TKIP';
if($type == 'WEP') $wep_key0 = $psk;
if($type == 'WEP') $psk = '';
if($type == 'none') $psk = '';

//write none
if($type == 'none'):
$file = fopen("/tmp/wpa_supplicant.conf","w");
echo fwrite($file,"ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1

network={
ssid=\"$ssid\"
key_mgmt=NONE
auth_alg=OPEN
}
");
fclose($file); echo "\n";
endif;

//write wep
if($type == 'WEP'):
$file = fopen("/tmp/wpa_supplicant.conf","w");
echo fwrite($file,"ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1

network={
ssid=\"$ssid\"
key_mgmt=NONE
auth_alg=OPEN
wep_key0=\"$wep_key0\"
}
");
fclose($file); echo "\n";
endif;

//write WPA
if($type == 'WPA'):
$file = fopen("/tmp/wpa_supplicant.conf","w");
echo fwrite($file,"ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1

network={
ssid=\"$ssid\"
psk=\"$psk\"
proto=WPA
key_mgmt=WPA-PSK
pairwise=TKIP
auth_alg=OPEN
}
");
fclose($file); echo "\n";
endif;

//write WPA2
if($type == 'WPA2'):
$file = fopen("/tmp/wpa_supplicant.conf","w");
echo fwrite($file,"ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1

network={
ssid=\"$ssid\"
psk=\"$psk\"
proto=RSN
key_mgmt=WPA-PSK
pairwise=CCMP
auth_alg=OPEN
}
");
fclose($file); echo "\n";
endif;

//printout
$response = array();
exec('sudo cat /tmp/wpa_supplicant.conf',$response);
print_r($response); echo "\n";

//remove
echo exec('sudo rm /etc/wpa_supplicant/wpa_supplicant.conf'); echo "\n";

//replace
echo exec('sudo mv /tmp/wpa_supplicant.conf /etc/wpa_supplicant/wpa_supplicant.conf');
else:
$response = array();
exec('sudo cat /etc/wpa_supplicant/wpa_supplicant.conf',$response);
print_r($response); echo "\n";	
endif;
?>
<input type="submit" value="Reconnect" onclick="window.location=('reconnect.php')"><input type="submit" value="Reboot" onclick="window.location=('reboot.php')">
<br/>
<?php $connected = exec('/home/pi/whatismyip') ?>
WIFI Status: <?php if($connected) echo $connected; else echo "Not Connected - Try Rebooting"; ?>

