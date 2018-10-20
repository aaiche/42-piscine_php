#!/usr/bin/php
<?php 

/*
 * CONST_VERBOSE = 1, to display more messages
 * alternative would have been to use the global keyword or GLOBALS['] ==> but not recommended
 */
define('CONST_VERBOSE', 0);
function msg($str) {
	if (CONST_VERBOSE) {
		echo $str;
	}
}

function toupper_link($matches) {
	msg("======toupper_link(): =====\n");
	msg(print_r($matches, true));
	msg(strtoupper($matches[0]) . "\n");
	return(mb_strtoupper($matches[0]));
}

function toupper_title($matches) {
	msg("======toupper_title(): =====\n");
	msg(print_r($matches, true));
	msg($matches[1] . mb_strtoupper($matches[2]) . $matches[3] . "\n");
	return($matches[1] . mb_strtoupper($matches[2]) . $matches[3]);
}

function search_inside_anchors($matches) {
	msg("======search_inside_anchors(): =====\n");
	msg(print_r($matches, true));
	$my_a = '(title\s*=\s*")([^"]+)(".*)';
	$my_reg_exp = $my_a;
	$results = preg_replace_callback("/$my_reg_exp/i", 'toupper_title' , $matches[0]);

	$my_a = ">[^<>]*<";
	$my_reg_exp = $my_a;
	$results = preg_replace_callback("/$my_reg_exp/i", 'toupper_link' , $results);
	return ($results);
}

if ($argc == 2) {
	$f = $argv[1];

	msg("=======file=====\n");
	msg("$f\n");

	if(($content = @file_get_contents("$f")) !== FALSE) {
		msg("$content");
		$my_a = "<a\s+[^>]+((?!<\/a>).|\n)*<\/a>";

		$my_reg_exp = $my_a;
		$nb = preg_match_all("/$my_reg_exp/i", $content, $matches);
		msg(" ==nb====================== \n");
		msg("$nb \n");
		msg(" ==matches================= \n");
		msg(print_r($matches, true));

		$results = preg_replace_callback("/$my_reg_exp/i", 'search_inside_anchors' , $content);
		echo $results;
	}
}
?>
