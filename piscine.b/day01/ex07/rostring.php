#!/usr/bin/php
<?php 
function my_display_array_in_one_line($my_tab) {
	if ($my_tab != "") {
		$last_index = count($my_tab);
		foreach ($my_tab as $index => $value) {
			if ($index != $last_index)
				echo "$value ";
			else
				echo "$value";
		}
	}
}

function ft_split($str) {
	$my_tab = preg_split("/\s+/", $str, -1, PREG_SPLIT_NO_EMPTY);
	return($my_tab);
}

if ($argc > 1) {
	$my_tab = ft_split($argv[1]);
	if ($my_tab != "")
	{
		$my_tab[count($my_tab)] = $my_tab[0];
		unset($my_tab[0]);
	}
	if ($my_tab != "") {
		my_display_array_in_one_line($my_tab);
	}
	echo "\n";
}
?>
