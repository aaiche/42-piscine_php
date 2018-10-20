#!/usr/bin/php
<?php 
// Returns the contents of a file
function file_contents($path) {
	$str = @file_get_contents($path);
	echo $str;
	if ($str === FALSE) {
		//throw new Exception("Cannot access '$path' to read contents.");
		echo "$error";
	} else {
		return $str;
}
                                 }
if ($argc == 2) {
	$f = $argv[1];

	echo "=======file=====\n";
	echo "$f\n";

	if(($content = @file_get_contents("$f")) !== FALSE) {
		echo "$content";
		//$my_a = "/<a href=\"([^\"]*)\">(.*)<\/a>/iU";
		$my_a = "<a\shref(.*) title=\"([^\"]*)\">(.*)<\/a>";
		$my_a = "<a\s[^>]*title=\"([^\"]*)\"[^>]*>(.*)<\/a>";
		$my_a = "<a\s[^>]*title=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		$my_a = "<a\s[^>]*title=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		//$my_a = "<a\s[^>]*(title\s*=\s*(\"??)([^\" >]*?)\\1[^>]*)>(.*)<\/a>";
		$my_a = "<a\s[^>]*\(title=(\"??)([^\" >]*?)\\1[^>]*\)>(.*)<\/a>";
		$my_a = "<a\s[^>]*title=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
		$my_a = "<a.*(title=.*[^>])";


		$my_reg_exp = $my_a;
		$nb = preg_match_all("/$my_reg_exp/i", $content, $matches);
		echo " ==nb====================== \n";
		echo "$nb \n";
		echo " ==matches================= \n";
		print_r($matches);
	}
}
?>
