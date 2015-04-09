<?php
if ($argc > 1)
{
	print(implode(" ", array_filter(explode(" ", implode(" ", explode("\t", $argv[1]))), function($a) { return $a != ""; })));
}
?>
