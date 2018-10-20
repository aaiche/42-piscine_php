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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	msg("main():\n");
	if (my_is_not_empty($_POST["login"]) && ($_POST["passwd"])) {
		// authenticate
		$login = $_POST["login"];
		$password = $_POST["passwd"];
		if (auth($login, $password)) {
			$_SESSION["logged_on_user"] = $login;
			msg("main(): ok\n");
			msg("OK\n");
?>
				<!DOCTYPE html>
				<html>
					<head>
						<meta charset="UTF-8">
						<title>42Chat</title>
					</head>
					<body>
						<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
						<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
					</body>
				</html>
<?php

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
