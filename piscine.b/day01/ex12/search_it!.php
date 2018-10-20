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

/*
 * Type the following shell command to disable bash history so no need to escape !
 * 		$> unsetopt BANG_HIST
 * For my information: There is a way to run shell script from php script : shell_exec('ls -l')
 */
function before_running_this_script() {
	if (CONST_VERBOSE) {
 		echo("Type the following shell command to disable bash history so no need to escape !\n");
 		echo("       $> unsetopt BANG_HIST\n\n");
	}
}

before_running_this_script();

// TBD : what if key:value is not well formatted ?
if ($argc > 1) {
	$key_to_search_for = $argv[1];
	msg("searching for '$key_to_search_for'\n");
	$my_hash = [];
	$i = 2;
	while($i < $argc) {
		msg("key value: [$i] = $argv[$i]\n");
		if (strpos($argv[$i], ':') !== false) {			// !== is it different on value or on type
			$my_tab = explode(":", $argv[$i], 2);
			msg(print_r($my_tab, true));
			$my_hash[$my_tab[0]] = $my_tab[1];
		} else {
			msg("ignoring this parameter\n");
		}
		$i++;
	}
	msg("===================\n");
	msg(print_r($my_hash, true));
	msg("===================\n");
	if (array_key_exists($key_to_search_for, $my_hash)) {
		msg("L'élément '$key_to_search_for' existe dans le tableau: \"$my_hash[$key_to_search_for]\"\n");
		echo "$my_hash[$key_to_search_for]\n";
	}

}
?>
