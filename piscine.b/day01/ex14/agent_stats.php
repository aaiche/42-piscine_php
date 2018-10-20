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

msg("argc = '$argc'\n");
msg("argv1 = '$argv[1]'\n");

if(($argc == 2) && (($argv[1] == "moyenne") || ($argv[1] == "moyenne_user") || ($argv[1] == "ecart_moulinette"))) {
	$cmd = $argv[1];
	$moyenne = 0;
	$moyenne_user = [];
	$ecart_moulinette = 0;
	$user = "";
	$note = "";
	$noteur = "";
	$feedback = "";
	$all_notes = 0;
	$sum_of_notes = 0;

	msg("searching for '$cmd'\n");

	// open the standard input
	$fhandle = fopen("php://stdin", "r");

	// skip the first line
	fgetcsv($fhandle, 0, ";");

	//fgetcsv(): reads the contents line by line and returns an array
	while ($tab = fgetcsv($fhandle, 0, ";")) {
		$user = $tab[0];
		$note = $tab[1];
		$noteur = $tab[2];
		$feedback = $tab[3];

		// skip empty notes
		if ($tab[1] !== '') {
			if (!array_key_exists($user, $moyenne_user)) {
				$moyenne_user[$user]["all"]["sum_notes"] = 0;
				$moyenne_user[$user]["all"]["count"] = 0;
				$moyenne_user[$user]["moulinette"]["sum_notes"] = 0;
				$moyenne_user[$user]["moulinette"]["count"] = 0;
			}

			if ($noteur === "moulinette") {
				$moyenne_user[$user]["moulinette"]["sum_notes"] += $note; 
				$moyenne_user[$user]["moulinette"]["count"] += 1;
			} else {
				$sum_notes += $note;
				$all_notes++;
				$moyenne_user[$user]["all"]["sum_notes"] += $note; 
				$moyenne_user[$user]["all"]["count"] += 1;
			}
		}
	}
	fclose($fhandle);

	/*
	 * option “moyenne” qui calcule la moyenne de toutes les notes hors moulinette
	 */
	$moyenne = $sum_notes / $all_notes;
	ksort($moyenne_user);
	foreach($moyenne_user as $x => $x_array_value) {
		$moyenne_user[$x]["all"]["moyenne"] = $moyenne_user[$x]["all"]["sum_notes"] / $moyenne_user[$x]["all"]["count"];
		$moyenne_user[$x]["moulinette"]["moyenne"] = $moyenne_user[$x]["moulinette"]["sum_notes"] / 
			$moyenne_user[$x]["moulinette"]["count"];
		$moyenne_user[$x]["ecart_moulinette"] = $moyenne_user[$x]["all"]["moyenne"] - 
			$moyenne_user[$x]["moulinette"]["moyenne"];
	}
	ksort($moyenne_user);

	/*
	 * display results according to the cmd option
	 */
	if($cmd === "moyenne") {
		echo "$moyenne\n";
	} else if($cmd === "moyenne_user") {
		foreach($moyenne_user as $x => $x_array_value) {
			$moyenne = $moyenne_user[$x]["all"]["moyenne"];
			$moyenne_moulinette = $moyenne_user[$x]["moulinette"]["moyenne"];
			$ecart_moulinette = $moyenne_user[$x]["ecart_moulinette"];
			echo "$x:$moyenne\n";
		}
	} else if($cmd === "ecart_moulinette") {
		foreach($moyenne_user as $x => $x_array_value) {
			$moyenne = $moyenne_user[$x]["all"]["moyenne"];
			$moyenne_moulinette = $moyenne_user[$x]["moulinette"]["moyenne"];
			$ecart_moulinette = $moyenne_user[$x]["ecart_moulinette"];
			//msg( "$x:$moyenne == $moyenne_moulinette == $ecart_moulinette\n");
			echo "$x:$ecart_moulinette\n";
		}
	}

}


?>
