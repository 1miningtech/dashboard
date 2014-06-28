<pre>
<a href="/index.php">settings</a> | <a href="/dashboard/wifi.php">wifi</a> | <a href="/dashboard">dashboard</a>
</pre>
<?php
function cg_status() {	
	system("sudo ps -U root | grep -c cgminer > php.log",$ret_val);
	$file = fopen("./php.log","r");
	$read = fgets($file);
	if($read != 0)
		$cg_status = "run";
	else
		$cg_status = "stop";
	return $cg_status;
}

function cg_stop() {	
	system("sudo pkill cgminer > php.log",$ret_val);
	system("rm -f run",$ret_val);
}

function cg_start($pool1, $id1, $pwd1, $pool2, $id2, $pwd2, $pool3, $id3, $pwd3, $diff) {
	cg_stop();
	$cmd = "sudo ./cgminer -o ".$pool1." -u ".$id1." -p ".$pwd1." -o ".$pool2." -u ".$id2." -p ".$pwd2." -o ".$pool3." -u ".$id3." -p ".$pwd3."  --A1Pll1 1000 --A1Pll2 1000 --A1Pll3 1000 --A1Pll4 1000 --A1Pll5 1000 --api-listen --cs 8 --stmcu 0 -T --diff ".$diff." > /var/www/cgminer.log& ";
	
	$file = fopen("../config/run.sh","w");
	fputs($file,"#!/bin/bash \n");
	fputs($file,"sudo chmod 777 /var/www/cgminer.log \n");
	fputs($file,$cmd."\n");
	fclose($file);	

	system($cmd,$ret_val);
}

function cg_log() {
	$file = fopen("./cgminer.log","r");
	while(!feof($file)){
		$read .= fgets($file);
	}
	fclose($file);
	$pattern_hashmeter = '/\(5s\)[^\r]+/';
        preg_match_all($pattern_hashmeter, $read, $matches_hashmeter);
        $cg_log .= $matches_hashmeter[0][count($matches_hashmeter[0])-2];
        return $cg_log;
}



function cg_difflev()
{
	$file = fopen("../config/diff","r");
	$number = fgets($file);
	fclose($file);
	return $number;
}

function cg_diff()
{
	$difficulty;
	$file = fopen("../config/diff","r");
	$number = fgets($file);
	fclose($file);
	
	switch($number)
	{
		case 1:
		     $difficulty = "1";
		     break;
		case 2:
		     $difficulty = "2";
		     break;	
		case 3:
		     $difficulty = "4";
		     break;
		case 4:
		     $difficulty = "8";
		     break;
		case 5:
		     $difficulty = "16";
		     break;
		case 6:
		     $difficulty = "32";
		     break;
		case 7:
		     $difficulty = "52";
		     break;
		case 8:
		     $difficulty = "64";
		     break;
		case 9:
		     $difficulty = "86";
		     break;
		case 10:
		     $difficulty = "103";
		     break;
		case 11:
		     $difficulty = "128";
		     break;
		case 12:
		     $difficulty = "256";
		     break;
		case 13:
		     $difficulty = "512";
		     break;
		case 14:
		     $difficulty = "1024";
		     break;
		case 15:
		     $difficulty = "2048";
		     break;
		case 16:
		     $difficulty = "4096";
		     break;
		
	}	
	return $difficulty;
}


if (isset($_POST["ip"]) && isset($_POST["netmask"]) && isset($_POST["gateway"]) && isset($_POST["dns"])){
	$file = fopen("/etc/network/interfaces","w");
	fputs($file, "auto lo \n");
	fputs($file, "iface lo inet loopback \n");
	//fputs($file, "iface eth0 inet dhcp \n");
	fputs($file, "iface eth0 inet static \n");
	//fputs($file, "auto wlan0 \n");
	//fputs($file, "iface wlan0 inet static \n");
	fputs($file, "address ".$_POST["ip"]."\n");
	fputs($file, "netmask ".$_POST["netmask"]."\n");
	fputs($file, "gateway ".$_POST["gateway"]."\n");
	fputs($file, "allow-hotplug wlan0\n");
	fputs($file, "iface wlan0 inet manual\n");
	fputs($file, "wpa-roam /etc/wpa_supplicant/wpa_supplicant.conf\n");
	//fputs($file, "wpa-ssid \"InnoOffice\" \n");
	//fputs($file, "wpa-psk \"innoicoffice10\" \n");
	fclose($file);
	
	$file = fopen("/etc/resolv.conf","w");
	fputs($file, "nameserver ".$_POST["dns"]."\n");
	fclose($file);

	$file = fopen("../config/ip.log","w");
	fputs($file, $_POST["ip"]."\n");
	fputs($file, $_POST["netmask"]."\n");
	fputs($file, $_POST["gateway"]."\n");
	fputs($file, $_POST["dns"]."\n");
	fclose($file);

	system("sudo reboot > php.log",$ret_val);
}



if (isset($_POST["control"]))
{
	if($_POST["control"] == "stop"){
		cg_stop();
		$cg_status = "stop";
	}
	else{
		if (isset($_POST["pool1"]) && isset($_POST["id1"]) && isset($_POST["pwd1"])){
			$file = fopen("../config/user.log","w");
			fputs($file, $_POST["pool1"]."\n");
			fputs($file, $_POST["id1"]."\n");
			fputs($file, $_POST["pwd1"]."\n");
			fputs($file, $_POST["pool2"]."\n");
			fputs($file, $_POST["id2"]."\n");
			fputs($file, $_POST["pwd2"]."\n");
			fputs($file, $_POST["pool3"]."\n");
			fputs($file, $_POST["id3"]."\n");
			fputs($file, $_POST["pwd3"]."\n");
			fputs($file, $_POST["starttype"]."\n");
			fclose($file);

			cg_start($_POST["pool1"], $_POST["id1"], $_POST["pwd1"],
				 $_POST["pool2"], $_POST["id2"], $_POST["pwd2"],
				 $_POST["pool3"], $_POST["id3"], $_POST["pwd3"],
				 $_POST["difficulty"]);
			$cg_status = "run";
		}
		else
		{
			$cg_status = "stop";
		}
		
		//----add by fisher	
		$file = fopen("../config/diff","w");
		fputs($file, $_POST["difficulty"]."\n");
		fclose($file);
		
	}
}	
else
{
	$cg_status = cg_status();
}

$file = fopen("../config/user.log","r");
$read = fgets($file);
$pool1 = $read;
$read = fgets($file);
$id1 = $read;
$read = fgets($file);
$pwd1 = $read;

$read = fgets($file);
$pool2 = $read;
$read = fgets($file);
$id2 = $read;
$read = fgets($file);
$pwd2 = $read;

$read = fgets($file);
$pool3 = $read;
$read = fgets($file);
$id3 = $read;
$read = fgets($file);
$pwd3 = $read;
$read = fgets($file);
$starttype = $read;
fclose($file);

$file = fopen("../config/ip.log","r");

$read = fgets($file);
$ip = $read;
$read = fgets($file);
$netmask = $read;
$read = fgets($file);
$gateway = $read;
$read = fgets($file);
$dns = $read;

fclose($file);


if ($cg_status=="run")
	$cg_log = cg_log();
else
	$cg_log = "";

if ($cg_status=="run")
	$cg_status_color = "green";
else
	$cg_status_color = "red";

if ($cg_status=="run")
	$cg_status_info = "Running";
else
	$cg_status_info = "Stoped";

$cg_button_info = "Ok";

if ($cg_status=="run"){
	$cg_radio_start = '';
	$cg_radio_stop  = 'checked';
}
else{
	$cg_radio_start = 'checked';
	$cg_radio_stop  = '';
}

$ip_button_info = "Set network";

if($starttype==1){
	$cg_option_starttype_webstart = '';
	$cg_option_starttype_autostart = 'selected = \"selected\"';

        $file = fopen("/etc/rc.local","w");
        fputs($file, "#!/bin/sh -e \n");
	fputs($file, "cd /var/www  \n");
        fputs($file, "sleep 2 \n");
        fputs($file, "./superrun.sh \n");
        fputs($file, "sleep 2 \n");
	fputs($file, "cd /var/config  \n");
        fputs($file, "./run.sh \n");
        fputs($file, "exit 0 \n");
        fclose($file);
}
else{
	$cg_option_starttype_webstart = 'selected = \"selected\"';
	$cg_option_starttype_autostart = '';

	$file = fopen("/etc/rc.local","w");
        fputs($file, "#!/bin/sh -e \n");
	fputs($file, "cd /var/www \n");
        fputs($file, "sleep 2 \n");
        fputs($file, "./superrun.sh \n");
        fputs($file, "exit 0 \n");
        fclose($file);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>LK TE 1T controler</title>
	<style type="text/css">
		#img {
			width:100px;
			margin-left:0px;
			margin-top:0px;
			float:left;
				}
		#alert {font-size:18px;
			margin-top:40px;
			margin-right:0px;
			float:right;
			display:inline;
			}
		#header {		
			height:100px;
			
			margin:auto;
				}
		#main{			
			height:300px;
                        margin-top:5px;
			margin-left:auto;
			margin-right:auto;
		}
		#footer {
			width:80%;
			height:50px;
			background:#F00;
			margin-bottom:20px;
                        margin-left:auto;
			margin-right:auto;
			text-align:center;
			font-size:12px;
		}
		#author{
			font-size:12px;
			text-align:center;
		}
		#log	{
			
			}
		#menu { margin-top:0px;margin-left:200px; border:0px;  height:26px; }
		#menu ul {width:200px; list-style: none; margin: 0px; padding: 0px;float:right; }
		#menu ul li {margin-top:20px; float:right;width:50px;padding:10px;}
		#menu ul li a { display:block; padding: 0px 8px; height: 26px; line-height: 26px; float:left;}
		#menu ul li a:hover { background:#333; color:#fff;}

		

		body{
			margin-left: 0px;
			margin-top: 0px;
			margin-right: 0px;
			margin-bottom: 0px;
			background-color:#FFF;
			margin:50px;
			}
	</style>
</head>

<body>

<div id="header">
	<div id="img">
	<img src="/img/srp-miner-logo.png"style="border:none" height="100"></a>
	</div>
	<div id="menu" style="display:none">
   		 <ul>
		<li><a href="index.php">中文</a></li>
		<li><a href="index-en.php">English</a></li>
		</ul>  
	</div>
</div>
<div id="main">
<div id="pool">
	<form action="" method="post" style="">
		IP Address: <input style="color:blue" type="text" name="ip" size="10" value=<?php echo $ip ?> />
		Net mask: <input style="color:blue" type="text" name="netmask" size="10" value=<?php echo $netmask ?> />
		Gateway: <input style="color:blue" type="text" name="gateway" size="10" value=<?php echo $gateway ?> />
		DNS: <input style="color:blue" type="text" name="dns" size="10" value=<?php echo $dns ?> />
		<input type="submit" value="<?php echo $ip_button_info?>" />
	</form>
	<br />
</div>


<div id="pool">
	<form action="" method="post" style="">
		Pool 1 Add : <input style="color:blue" type="text" name="pool1" size="33" value=<?php echo $pool1 ?> />
		Pool 1 User: <input style="color:blue" type="text" name="id1" size="10" value=<?php echo $id1 ?> />
		Pool 1 Pass: <input style="color:blue" type="text" name="pwd1" size="10" value=<?php echo $pwd1 ?> /> <br \>
		Pool 2 Add: <input style="color:blue" type="text" name="pool2" size="33" value=<?php echo $pool2 ?> />
		Pool 2 User: <input style="color:blue" type="text" name="id2" size="10" value=<?php echo $id2 ?> />
		Pool 2 Pass: <input style="color:blue" type="text" name="pwd2" size="10" value=<?php echo $pwd2 ?> /> <br \>
		Pool 3 Add: <input style="color:blue" type="text" name="pool3" size="33" value=<?php echo $pool3 ?> />
		Pool 3 User: <input style="color:blue" type="text" name="id3" size="10" value=<?php echo $id3 ?> />
		Pool 3 Pass: <input style="color:blue" type="text" name="pwd3" size="10" value=<?php echo $pwd3 ?> /> <br \>
		</br>
		Difficulty Sel : <select name="difficulty">
				<option value="1" <?php if(cg_difflev() == 1) echo "selected=\"selected\""?> >1</option>
				<option value="2" <?php if(cg_difflev() == 2) echo "selected=\"selected\""?> >2</option>
				<option value="3" <?php if(cg_difflev() == 3) echo "selected=\"selected\""?> >4</option>
				<option value="4" <?php if(cg_difflev() == 4) echo "selected=\"selected\""?> >8</option>
				<option value="5" <?php if(cg_difflev() == 5) echo "selected=\"selected\""?> >16</option>
				<option value="6" <?php if(cg_difflev() == 6) echo "selected=\"selected\""?> >32</option>
				<option value="7" <?php if(cg_difflev() == 7) echo "selected=\"selected\""?> >52</option>
				<option value="8" <?php if(cg_difflev() == 8) echo "selected=\"selected\""?> >64</option>
				<option value="9" <?php if(cg_difflev() == 9) echo "selected=\"selected\""?> >86</option>
				<option value="10" <?php if(cg_difflev() == 10) echo "selected=\"selected\""?> >103</option>
				<option value="11" <?php if(cg_difflev() == 11) echo "selected=\"selected\""?> >128</option>
				<option value="12" <?php if(cg_difflev() == 12) echo "selected=\"selected\""?> >256</option>
				<option value="13" <?php if(cg_difflev() == 13) echo "selected=\"selected\""?> >512</option>
				<option value="14" <?php if(cg_difflev() == 14) echo "selected=\"selected\""?> >1024</option>
				<option value="15" <?php if(cg_difflev() == 15) echo "selected=\"selected\""?> >2048</option>
				<option value="16" <?php if(cg_difflev() == 16) echo "selected=\"selected\""?> >4096</option>
			   </select>
			   <?php echo "--Current difficulty:"?><?php echo cg_diff()?>&nbsp;&nbsp;&nbsp;		
		Start type: <select name="starttype">
                                <option value="0" <?php echo $cg_option_starttype_webstart ?>  >Start manual</option>
                                <option value="1" <?php echo $cg_option_starttype_autostart ?> >Start Automatic</option>
                          </select>
		Start:	  <input type="radio" name="control" value="start" <?php echo $cg_radio_start?> />
		Stop :	  <input type="radio" name="control" value="stop"  <?php echo $cg_radio_stop?> />
			  <input type="submit" value="<?php echo $cg_button_info?>" />
	</form>
</div>

<div id="status">
	<br \>
	<form action="./miner.php" target="_blank" method="post" style="">
		Status:<font color=<?php echo $cg_status_color?>> <?php echo $cg_status_info?> </font> <input type="submit" value="Real-time monitoring" />
	</form>

</div>

<div id="log">
	<br \>
	<form action="" method="post" style="margin-left:0px">
		Logs..:<input type="submit" value="Refresh the log" />
	</form>
	<?php echo $cg_log?>
</div>

</div>
</body>
</html>
