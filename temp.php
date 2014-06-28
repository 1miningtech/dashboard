<?php
$html = file_get_contents("http://localhost/miner.php?ref=0&pg=Stats");
$explode = explode('BA10',$html);

$explode = explode('align=right>',$html);
//print_r($explode);
//echo $explode[1];

$array['1'] .= strip_tags($explode[34]);

$array['2'] .= strip_tags($explode[61]);

$array['3'] .= strip_tags($explode[88]);

$array['4'] .= strip_tags($explode[115]);

echo json_encode($array);
?>