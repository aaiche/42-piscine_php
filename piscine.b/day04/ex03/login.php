<?php
$session_id = session_start();
require_once('auth.php');

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

//define variables and set to empty values
$login_err = $new_password = $old_passwd_err = $submit_err = "";
$login = $passwd = $submit_err = "";
$logged_on_user = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	msg("main():\n");
	if (my_is_not_empty($_GET["login"]) && ($_GET["passwd"])) {
		// authenticate
		$login = $_GET["login"];
		$password = $_GET["passwd"];
		if (auth($login, $password)) {
			$_SESSION["logged_on_user"] = $login;
			msg("main(): ok\n");
			echo "OK\n";
		} else {
			$_SESSION["logged_on_user"] = "";
			msg("main(): error\n");
			echo "ERROR\n";
		}
	} else {
		// no valid input data
	}
}

function my_is_not_empty($input) {
	$str_temp = $input;

	if($str_temp != '') {
		return true;
	} else {
		return false;
	}
}
?>
