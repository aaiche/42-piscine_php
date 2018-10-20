<?php
$session_id = session_start();
require_once('auth.php');

//define variables and set to empty values
$login_err = $new_password = $old_passwd_err = $submit_err = "";
$login = $passwd = $submit_err = "";
$logged_on_user = "";
$private_dir = "../private";
$private_passwd_file = "$private_dir/passwd";
$my_own_secret_string = "this is my own secret string";
$users = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	echo "main()\n";
	if(my_is_not_empty($_GET["login"]) && ($_GET["passwd"])) {
		// authenticate
		$login = $_GET["login"];
		$password = $_GET["passwd"];
		if(auth($login, $password)) {
			$_SESSION["logged_on_user"] = $login;
			echo "main(): ok\n";
			echo "OK\n";
		} else {
			$_SESSION["logged_on_user"] = "";
			echo "main(): error\n";
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
