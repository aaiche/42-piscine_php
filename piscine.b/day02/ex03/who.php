#!/usr/bin/php
<?php 

/* see https://github.com/jjarava/mac-osx-forensics/blob/master/utmpx.py */

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

define('CONST_MAGIC', 'utmpx-1.00');
define('CONST_MAGIC_HEX', '75746d70782d312e3030');
define('CONST_FILE', '/private/var/run/utmpx');
$f = '/private/var/run/utmpx';

// Status of the session
$mac_status_type = [
	"0" => 'EMPTY',
	"1" => 'RUN_LVL',
	"2" => 'BOOT_TIME',
	"3" => 'OLD_TIME',
	"4" => 'NEW_TIME',
	"5" => 'INIT_PROCESS',
	"6" => 'LOGIN_PROCESS',
	"7" => 'USER_PROCESS',
	"8" => 'DEAD_PROCESS'
];

$utmpx_header_format = 
	'A10magic/' .
	'a286padding1/' .
	'a2id/' .
	'a622padding2/' .
	'a2unknown1/' .
	'a2unknown2/' .
	'a2timestamp/' .
	'a324padding3';

$utmpx_structure_format = 
	'A256user_name/' .
	'iid_size/' .
	'A32terminal_name/' .
	'iprocess_id/' .
	'isession_status/' .
	'iepoch_timestamp/' .
	'imicrosecond/' .
	'A256hostname/' .
	'a64padding';


msg("=======Mac Os X UTMPX file=====\n");
msg(CONST_FILE . "\n");
msg("================================\n");

// open file in binary mode 
$fh = fopen(CONST_FILE, "rb");
if(($utmpx_header_data = fread($fh, 1256))) {
	$unpacked_utmpx_header_data = unpack("$utmpx_header_format", $utmpx_header_data);
	$magic_header = $unpacked_utmpx_header_data["magic"];
	msg("magic header: $magic_header\n");
	if($magic_header !== CONST_MAGIC) {
		print("Not a valid Mac Os X UTMPX Header.\n");
		exit(1);
	}
}

date_default_timezone_set('Europe/Paris');
function print_entry($num_entry, $user_name, $terminal_name, $timestamp, $hostname, $session_status) {
	global $mac_status_type;
	$session_name = $mac_status_type[$session_status];
	$readable_timestamp = strftime("%b %e %H:%M", $timestamp);
	if ($session_name == "USER_PROCESS") {
		/*
			$str = "";
			//$str .= "[$num_entry]: "; 
			$formatted_user_name = str_pad($user_name, 12);
			$str .= "$formatted_user_name "; 
			$str .= "$terminal_name "; 
			$str .= "$readable_timestamp "; 
			$str .= "$hostname "; 
			$str .= "[$session_status=$session_name]"; 
			echo "$str\n";
		*/

		/* 
		 * TBD:
		 * the following print format needs more tests:
		 * - find a way to display hostname
		 * - find a way to have a larger username
		 * -...
		 */
		printf("%-8.s %-9.s%-12s%-12s\n", $user_name, $terminal_name, $readable_timestamp, $hostname);
	}
}

$all_entries_array = [];
$num_entry = 0;
while($utmpx_structure_data = fread($fh, 628)) {
	$unpacked_entry = unpack($utmpx_structure_format, $utmpx_structure_data);
	//msg(print_r($unpacked_entry, false));
	$unpacked_entry["entry_num"] = $num_entry;
	$num_entry++;
	$user_name = $unpacked_entry["user_name"];
	$terminal_name = $unpacked_entry["terminal_name"];
	$all_entries_array[$user_name . $terminal_name] = $unpacked_entry;
}
//msg(print_r($all_entries_array, false));

/*
 * TBD:  Here we are guessing the default sort of who, therefore we sort by user_name and terminal_name. 
 */
ksort($all_entries_array);

foreach($all_entries_array as $entry) {
	$user_name = $entry["user_name"];
	$terminal_name = $entry["terminal_name"];
	$timestamp = $entry["epoch_timestamp"];
	$hostname = $entry["hostname"];
	$session_status = $entry["session_status"];
	$num_entry = $entry["entry_num"];
	print_entry($num_entry, $user_name, $terminal_name, $timestamp, $hostname, $session_status);
}
fclose($fh);

?>
