<?php
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

//echo "_SESSION array:\n";
//print_r($_SESSION);
//$session_id = session_id();
//echo " session id or cookie id: $session_id\n";
//echo "_GET array:\n";
//print_r($_GET);


//define variables and set to empty values
$login_err = $passwd_err = "";
$login = $passwd = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(my_is_not_empty($_GET["submit"]) && ($_GET["submit"] == "OK")) {
		if(my_is_not_empty($_GET["login"])) {
			$login = test_input($_GET["login"]);
			$_SESSION["login"] = $login;
		} else {
			$login_err = "login is required";
		}
		if(my_is_not_empty($_GET["passwd"])) {
			$passwd = test_input($_GET["passwd"]);
			$_SESSION["passwd"] = $passwd;
		} else {
			$passwd_err = "password is required";
		}
	} else {
		// no submit button has been performed
	}
	if(my_is_not_empty($login_err)) {
	}
	if(my_is_not_empty($passwd_err)) {
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

function test_input($data) {
	// we can test here if login contains letters and whitespace
	/*
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	 */
	return $data;
}

function get_user_id() {
	$id = "login";
	$login = "";
	if(my_is_not_empty($_SESSION["$id"])) {
		$login = $_SESSION["$id"];
	} else {
		$login = "";
	}
	return($login);
}

function get_password() {
	$id = "passwd";
	$passwd = "";
	if(my_is_not_empty($_SESSION["$id"])) {
		$passwd = $_SESSION["$id"];
	} else {
		$passwd = "";
	}
	return($passwd);
}


?>
<html><body>
<form action="index.php" method="GET">
	Identifiant: <input type="text" name="login" value="<?php echo get_user_id();?>" />
	<br />
	Mot de passe: <input type="password" name="passwd" value="<?php echo get_password();?>" />
	<input type="submit" name="submit" value="OK" />
</form>
</body></html>
