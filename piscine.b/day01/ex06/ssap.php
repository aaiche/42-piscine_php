#!/usr/bin/php
<?php 
function my_display_array($my_tab) {
	if ($my_tab != "") {
		foreach ($my_tab as $elt) {
			echo "$elt\n";
		}
	}
}

function ft_split($str) {
	$my_tab = preg_split("/\s+/", $str, -1, PREG_SPLIT_NO_EMPTY);
	sort($my_tab);
	return($my_tab);
}

if ($argc > 1) {
	$i = 1;
	while($i < $argc) {
		$splited_str_tab = ft_split($argv[$i]);
		if ($splited_str_tab != "")
		{
			foreach ($splited_str_tab as $elt) {
				$my_tab[] = $elt;
			}
		}
		$i++;
	}
	if ($my_tab != "") {
		sort($my_tab);
		my_display_array($my_tab);
	}
}
?>
