<?php require_once("config.php"); ?><html>
<head>
<title>1Mining</title>
<meta charset="utf-8">
<meta name="viewport" content="width=1280, user-scalable=no" />
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jgauge.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/index.css?<?php echo rand() ?>">
<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
</head>

<body>

<div id="header">
	<div class="header_c">
		<a href="wifi.php"><img src="img/buatanmalaysia.png" style="float:right;height:40px;margin-top:5px;margin-left:10px"></a><img src="img/logo.png" style="float:left"><div class="company_name">1MINING TECH</div>
	</div>
</div>

<table width="100%" id="gaugetable" cellpadding="0" cellspacing="0" class="<?php if($_GET['scale']) echo 'scale' ?>">
	<td align="center"><div id="gauge1" class="jgauge"></div></td>
	<td align="center"><div id="gauge2" class="jgauge"></div></td>
	<td align="center"><div id="gauge3" class="jgauge"></div></td>
	<td align="center"><div id="gauge4" class="jgauge"></div></td>
	<td align="center"><div id="gauge5" class="jgauge"></div></td>
</table>

<table width=100% height=50% cellspacing=0 cellpadding=0>
<td align=center>
<div>
	<div id="ghs_total_big" align="center">...</div>
</div>  
</td>
</table>

<div id="temptable">
<table width="100%" cellpadding="0" cellspacing="0" height="60px" border=1>
	<td align="center" class="temp"><span class="temp" id="am1_temp1">...&#x2103;</span> / <span class="temp" id="am1_temp2">...&#x2103;</span></td>
	<td align="center" class="temp"><span class="temp" id="am2_temp1">...&#x2103;</span> / <span class="temp" id="am2_temp2">...&#x2103;</span></td>
	<td align="center" class="temp"><span class="temp" id="am3_temp1">...&#x2103;</span> / <span class="temp" id="am3_temp2">...&#x2103;</span></td>
	<td align="center" class="temp"><span class="temp" id="am4_temp1">...&#x2103;</span> / <span class="temp" id="am4_temp2">...&#x2103;</span></td>
	<td align="center" class="temp"><span class="temp" id="am5_temp1">...&#x2103;</span> / <span class="temp" id="am5_temp2">...&#x2103;</span></td>
</table>
</div>

<div id="miners">
<table width="100%" cellpadding="0" cellspacing="0">
	<thead style="color:white">
		<td width="50%" style="color:deeppink">Stats Summary</td>
		<td align="right" style="color:deeppink">Average Performance</td>
	</thead>
	<tbody>
		<tr><td>Accepted: <span id="accepted"></span></td><td><div align="right" id="am1_ghs_av">...</div></td></tr>
		<tr><td>Rejected: <span id="rejected"></span></td><td><div align="right" id="am2_ghs_av">...</div></td></tr>
		<tr><td>BTC: </td><td><div align="right" id="am3_ghs_av">...</div></td></tr>
		<tr><td>Blocks: <span id="foundblocks"></span></td><td><div align="right" id="am4_ghs_av">...</div></td></tr>
		<tr><td>Uptime:</td><td><div align="right" id="am5_ghs_av">...</div></td></tr>
		<tr><td style="color:orange"><b>TOTAL</b></td><td><div align="right" id="ghs_total">...</div></td></tr>
	</tbody>
</table>
</div>

<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/custom.js?<?php echo rand() ?>"></script>
<script language="javascript" type="text/javascript" src="js/jQueryRotate.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jgauge-0.3.0.a3.js"></script>

<script>
i=0;
cgminerURL = "<?php echo $cgminer_url ?>";

var gauge1 = new jGauge(); // Create a new jGauge.
gauge1.id = 'gauge1'; // Link the new jGauge to the placeholder DIV.
gauge1.label.suffix = 'GHs';

var gauge2 = new jGauge(); // Create a new jGauge.
gauge2.id = 'gauge2'; // Link the new jGauge to the placeholder DIV.
gauge2.label.suffix = 'GHs';

var gauge3 = new jGauge(); // Create a new jGauge.
gauge3.id = 'gauge3'; // Link the new jGauge to the placeholder DIV.
gauge3.label.suffix = 'GHs';

var gauge4 = new jGauge(); // Create a new jGauge.
gauge4.id = 'gauge4'; // Link the new jGauge to the placeholder DIV.
gauge4.label.suffix = 'GHs';

var gauge5 = new jGauge(); // Create a new jGauge.
gauge5.id = 'gauge5'; // Link the new jGauge to the placeholder DIV.
gauge5.label.suffix = 'GHs';

function update()
{
	$.getJSON("<?php echo $cgminer_url ?>",function(data) 
	{
		ghs1_av = data.am1.ghs_av;
		ghs2_av = data.am2.ghs_av;
		ghs3_av = data.am3.ghs_av;
		ghs4_av = data.am4.ghs_av;
		ghs5_av = data.am5.ghs_av;
						
		ghs1_5s = data.am1.ghs_5s;
		ghs2_5s = data.am2.ghs_5s;
		ghs3_5s = data.am3.ghs_5s;
		ghs4_5s = data.am4.ghs_5s;
		ghs5_5s = data.am5.ghs_5s;

		$("#am1_temp1").html(data.am1.temp1+'&#x2103;');
		$("#am1_temp2").html(data.am1.temp2+'&#x2103;');

		$("#am2_temp1").html(data.am2.temp1+'&#x2103;');
		$("#am2_temp2").html(data.am2.temp2+'&#x2103;');

		$("#am3_temp1").html(data.am3.temp1+'&#x2103;');
		$("#am3_temp2").html(data.am3.temp2+'&#x2103;');

		$("#am4_temp1").html(data.am4.temp1+'&#x2103;');
		$("#am4_temp2").html(data.am4.temp2+'&#x2103;');

		$("#am5_temp1").html(data.am5.temp1+'&#x2103;');
		$("#am5_temp2").html(data.am5.temp2+'&#x2103;');

		$("#found_blocks").html(Number(data.am1.found_blocks))+Number(data.am2.found_blocks)+Number(data.am3.found_blocks)+Number(data.am4.found_blocks)+Number(data.am5.found_blocks);
		$("#accepted").html(Number(data.am1.accepted)+Number(data.am2.accepted)+Number(data.am3.accepted)+Number(data.am4.accepted)+Number(data.am5.accepted));
		$("#rejected").html(Number(data.am1.rejected)+Number(data.am2.rejected)+Number(data.am3.rejected)+Number(data.am4.rejected)+Number(data.am5.rejected));
	});
}

$( document ).ready(function() {
	//start
	update();
	setInterval("update()",2500);

	gauge1.init();
	gauge2.init(); 
	gauge3.init(); 
	gauge4.init(); 
	gauge5.init(); 
	setInterval("plusMinus()",250);
	//end
});
</script>

</body>
</html>