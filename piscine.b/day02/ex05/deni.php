#!/usr/bin/php
<?php 

/*
 * error_reporting(E_ALL);
 * ini_set('display_errors', 1);
 */

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

function get_dynamic_array_value($arr, $key) {
	return($arr[$key]);
}


if($argc != 3) {
	msg("usage: \n");
	msg("   $argv[0] csv_file column_name\n");
	exit(1);
} else {
	$csv_file = $argv[1];
	$header_key = $argv[2];
}

msg("======== args =================\n");
msg("argc = '$argc'\n");
msg("csv_file = '$argv[1]'\n");
msg("header_key = '$argv[2]'\n");
msg("================================\n");

if (file_exists($csv_file) && ($fh = fopen($csv_file, "r")) !== false) {
	// get the first line 
	$headers = fgetcsv($fh, 0, ";");
	msg("======== header keys  =================\n");
	msg(print_r($headers, true));
	$num_fields = count($headers);
	msg("num_fields= $num_fields\n");
	msg("=======================================\n");

	// check if the column name is a valid header key
	if (!in_array($header_key, $headers)) {
		msg("\"$header_key\" is not a header key of the csv file.\n");
		exit(1);
	}

	// create dynamic array variables
	for ($i = 0; $i < count($headers); $i++) {
		$column_name = $headers[$i];
		msg("initialising dynamic variable: $column_name.\n");
		$$column_name = [];
	}
	
	// fgetcsv(): reads the contents line by line and returns an array
	$row = 0;
	while ($line = fgetcsv($fh, 0, ";")) {
		$c = count($line);
		if ($c != $num_fields) {
			msg("warning: fields number ($c) doesnt match the number of header keys ($num_fields).\n");
		}
		for ($i = 0; $i < $c; $i++) {
			$column_name = $headers[$i];
			$key = $line[$i];
			${$column_name}["$row"] = $key;
		}
		$row++;
	}
	$max_row = $row; 

	// for each heaader except the one header key in argument, change the key value
	for ($i = 0; $i < count($headers); $i++) {
		$column_name = $headers[$i];
		msg("column_name = $column_name\n");
		if ($column_name != "$header_key") {
			for ($j = 0; $j < $max_row; $j++) {
				$new_key = ${$header_key}[$j];
				${$column_name}["$new_key"] = ${$column_name}["$j"];
				unset(${$column_name}["$j"]); 
			}
		}
	}
	// for header key in argument, change the key value
	msg("column_name = $header_key\n");
	for ($j = 0; $j < $max_row; $j++) {
		$new_key = ${$header_key}[$j];
		${$header_key}["$new_key"] = ${$header_key}["$j"];
		unset(${$header_key}["$j"]); 
	}
	
	// open the standard input
	if (($f = fopen('php://stdin', 'r')) !== false) {
		while (!feof($f)) {
			echo "Entrez votre commande: ";
			$cmd = fgets($f);
			if ($cmd) {
				eval($cmd);
			}
		}
		fclose($f);
	} else {
		msg("error: can not open stdin.\n");
		exit(1);
	}
	fclose($fh);
} else {
	msg("error: can not open $csv_file.\n");
	exit(1);
}

?>
