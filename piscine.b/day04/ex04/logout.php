<?php
// we ?start? a session to have access to _SESSION var
// this is not a new start: we recover the session by the id=cookie received via GET
$session_id = session_start();

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
$id = session_id();
msg("cookie received: session_id() = $id\n");

//define variables and set to empty values
//print_r($_SESSION);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	msg("logout(): " . $_SESSION["logged_on_user"] . "\n");
	if(my_is_not_empty($_SESSION["logged_on_user"])) {
		msg("recovered the session with _SESSION[logged_on_user]=" . $_SESSION["logged_on_user"] . "\n");
		$_SESSION["logged_on_user"] = "";
		session_destroy();
		msg("logout(): ok\n");
	} else {
		// we could not retrieve the session ?
		msg("logout(): error\n");
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
