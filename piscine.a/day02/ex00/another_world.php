#!/usr/bin/php
<?php 
if ($argc >= 2) {
	$s = preg_replace('/[ \t]+/', ' ', $argv[1]);
	$s = trim($s);
	if ($s != "")
		echo $s . "\n";
}
?>
