#!/usr/bin/php
<?php 

// https://stackoverflow.com/questions/11659118/parsing-srt-files
// https://www.3playmedia.com/2017/03/08/create-srt-file/

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

define('SRT_STATE_SUBNUMBER', 0);
define('SRT_STATE_TIME',      1);
define('SRT_STATE_TEXT',      2);
define('SRT_STATE_BLANK',     3);

function display_sequence($sequence) {
	echo $sequence["number"] . "\n";
	echo $sequence["start_time"] . " --> " . $sequence["stop_time"] . "\n";
	echo $sequence["text"];
}

if($argc != 2) {
	msg("usage: \n");
	msg("   $argv[0] file\n");
	exit(1);
} else {
	$f = $argv[1];
}

msg("======== args =================\n");
msg("argc = $argc\n");
msg("file = $f\n");
msg("================================\n");

if (file_exists($f) && ($fh = fopen($f, "r")) !== false) {
	while ($line = fgets($fh)) {
		switch($state) {
			case SRT_STATE_SUBNUMBER:
				$sequence_number = trim($line);
				$state = SRT_STATE_TIME;
				break;

			case SRT_STATE_TIME:
				$sequence_time = trim($line);
				$state = SRT_STATE_TEXT;
				break;

			case SRT_STATE_TEXT:
				if (trim($line) == '') {
					$sequence = [];
					$sequence["number"] = $sequence_number;
					list($sequence["start_time"], $sequence["stop_time"]) = explode(' --> ', $sequence_time);
					$sequence["text"] = $sequence_text;
					$sequence_text = '';
					$state = SRT_STATE_SUBNUMBER;

					$all_sequences[$sequence["start_time"]] = $sequence;
				} else {
					$sequence_text .= $line;
				}
				break;
		}
	}
	fclose($fh);
} else {
	msg("error: can not open $csv_file.\n");
	exit(1);
}
msg("state= $state\n");
if ($state == SRT_STATE_TEXT ) {
	// if file was missing the trailing newlines, we'll be in this
	// state here.  Append the last read text and add the last sequence.
	$sequence = [];
	$sequence["number"] = $sequence_number;
	list($sequence["start_time"], $sequence["stop_time"]) = explode(' --> ', $sequence_time);
	$sequence["text"] = $sequence_text;

	$all_sequences[$sequence["start_time"]]      = $sequence;
}
ksort($all_sequences);
$all_sequences = array_values($all_sequences);
$num_sequences = count($all_sequences);
msg("num sequences = " . $num_sequences . "\n");
for ($i = 0; $i < $num_sequences; $i++) {
	$all_sequences[$i]["number"] = $i + 1;
}
//print_r($all_sequences);
for ($i = 0; $i < $num_sequences; $i++) {
	display_sequence($all_sequences[$i]);
	if ($i < $num_sequences - 1) {
		echo "\n";
	}
}
exit(0);

?>
