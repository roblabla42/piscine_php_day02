<?php

function get_title_endpos($str)
{
	$j = strpos($str, "title=\"");
	if ($j != FALSE)
	{
		print(substr($str, 0, $j + 7));
		$workon = substr($str, $j + 7);
		$end = strpos($workon, "\"");
		print(strtoupper(substr($workon, 0, $end)));
		print("\"");
		return ($j + 8 + $end);
	}
	else
		return (0);
}

function parse($str) {
	$arr = explode("<a", $str);
	print($arr[0]);
	$i = 1;
	while ($i < count($arr))
	{
		print("<a");
		$endtagpos = strpos($arr[$i], ">");
		$bstagpos = strpos($arr[$i], "</a>");
		$atag = substr($arr[$i], 0, $endtagpos + 1);
		$contents = substr($arr[$i], $endtagpos + 1, $bstagpos - ($endtagpos + 1));
		$at = get_title_endpos($atag);
		print(substr($atag, $at));
		$j = strpos($contents, "<img");
		print(strtoupper(substr($contents, 0, $j)));
		if ($j != FALSE)
		{
			print("<img");
			$j += 4;
			$at = get_title_endpos(substr($contents, $j)) + $j;
			$j = strpos($contents, ">");
			print(substr($contents, $at, $j - ($at + 1)));
		}
		print(strtoupper(substr($contents, $j, $bstagpos - $j)));
		print(substr($arr[$i], $bstagpos));
		$i++;
	}
}

if ($argc > 1)
{
	$file = file_get_contents($argv[1]);
	parse($file);
}

?>
