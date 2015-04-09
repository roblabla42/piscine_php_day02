<?php

$contents = file_get_contents("/var/run/utmpx");

$y = [];
while ($contents != "")
{
	date_default_timezone_set("Europe/Paris");
	$x = unpack("A256user/A4id/A32ttyname/ipid/itype/lloginsec/lloginus/A256host/A64pad", $contents);
	if ($x['type'] == 7)
		$y[] = $x['user'] . " " . $x['ttyname'] . "  " . strftime("%b %e %R", $x['loginsec']) . PHP_EOL;
	$contents = substr($contents, 628);
}

sort($y);
$i = 0;
while ($i < count($y))
{
	print($y[$i]);
	$i++;
}

?>
