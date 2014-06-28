<?php require_once("config.php"); ?><html>
<head>
<title>1Mining</title>
<meta charset="utf-8">
<meta name="viewport" content="width=1280, user-scalable=no" />
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jgauge.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/index-1m.css?<?php echo rand() ?>">
</head>

<body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0"><td align=center><div>	
<div id="container" align="center">

<img src="img/1malaysiaminer.png" width="100%">
<table width="100%" class="table table-bordered" id="gaugetable">
	<td align="center"><div id="gauge1" class="jgauge"></div></td>
	<td align="center"><div id="gauge2" class="jgauge"></div></td>
	<td align="center"><div id="gauge3" class="jgauge"></div></td>
	<td align="center"><div id="gauge4" class="jgauge"></div></td>
	<td align="center"><div id="gauge5" class="jgauge"></div></td>
</table>

<div class="alert alert-success">
	<div id="ghs_total_big">...</div>
</div>

<table class="table table-bordered table-striped">
	<thead bgcolor="black" style="color:white">
		<td width="50%">Miner Watch</td>
		<td>Value</td>
	</thead>
	<tbody>
		<tr><td>Miner 1</td><td><div id="ghs_5s1">...</div></td></tr>
		<tr><td>Miner 2</td><td><div id="ghs_5s2">...</div></td></tr>
		<tr><td>Miner 3</td><td><div id="ghs_5s3">...</div></td></tr>
		<tr><td>Miner 4</td><td><div id="ghs_5s4">...</div></td></tr>
		<tr><td>Miner 5</td><td><div id="ghs_5s5">...</div></td></tr>
		<tr><td><b>TOTAL</b></td><td><div id="ghs_total">...</div></td></tr>
	</tbody>
</table>

<table class="table table-bordered table-striped">
	<thead bgcolor="black" style="color:white">
		<td width="50%">Miner 1 Details</td>
		<td>Value</td>
	</thead>
	<tbody>
		<!--<tr><td>Found Blocks</td><td><div id="found_blocks">...</div></td></tr>-->
		<tr><td>Accepted</td><td><div id="accepted">...</div></td></tr>
		<tr><td>Rejected</td><td><div id="rejected">...</div></td></tr>
		<tr><td>Temperature Board 1</td><td><div id="temp1">...</div></td></tr>
		<tr><td>Temperature Board 2</td><td><div id="temp2">...</div></td></tr>
	</tbody>
</table>

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
		$("#ghs_5s1").html(data.ghs_5s);
		$("#ghs_5s2").html(data.ghs_5s);
		$("#ghs_5s3").html(data.ghs_5s);
		$("#ghs_5s4").html(data.ghs_5s);
		$("#ghs_5s5").html(data.ghs_5s);
		//$("#found_blocks").html(data.found_blocks);
		$("#accepted").html(data.accepted);
		$("#rejected").html(data.rejected);
		$("#temp1").html(data.temp1);
		$("#temp2").html(data.temp2);
		ghs = data.ghs_5s;
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

</div>
</div></td></table>

</body>
</html>