#!/usr/bin/php
<?php 

function my_strcmp($in_str1, $in_str2) {
	$diff = 0;
	$str1 = strtolower($in_str1);
	$str2 = strtolower($in_str2);
	$num1 = strlen($str1);
	$num2 = strlen($str2);
	$i = 0;
	while (($i < $num1) || ($i < $num2)) {
		if(ctype_alpha($str1[$i])) {
			if(ctype_alpha($str2[$i])) {
				$diff = ord($str1[$i]) - ord($str2[$i]);
				if ($diff != 0) {
					return ($diff);
				}
			} elseif(is_numeric($str2[$i])) {
				return (-1);
			} else {
				return (-1);
			}
		}
		if(is_numeric($str1[$i])) {
			if(ctype_alpha($str2[$i])) {
				return (1);
			} elseif(is_numeric($str2[$i])) {
				$diff = ord($str1[$i]) - ord($str2[$i]);
				if ($diff != 0) {
					return ($diff);
				}
			} else {
				return (-1);
			}
		}
		if(!is_numeric($str1[$i]) && !ctype_alpha($str1[$i])) {
			if(ctype_alpha($str2[$i])) {
				return (1);
			} elseif(is_numeric($str2[$i])) {
				return (1);
			} else {
				$diff = ord($str1[$i]) - ord($str2[$i]);
				if ($diff != 0) {
					return ($diff);
				}
			}
		}
		$i++;
	}
}

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

function my_sort($tab) {
	$i = 0;
	$num = count($tab);
	while ($i < count($tab)) {
		$j = $i + 1;
		while ($j < count($tab)) {
			if (my_strcmp($tab[$i], $tab[$j]) > 0) {
				$p = $tab[$i];
				$tab[$i] = $tab[$j];
				$tab[$j] = $p;
			}
			$j++;
		}
		$i++;
	}
	return($tab);
}

if ($argc > 1) {
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
		$my_tab = my_sort($my_tab);
		my_display_array($my_tab);
	}
}
?>
