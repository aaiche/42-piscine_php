<?php
/*
 * ../private/password
a:2:{ 															<-- 2 elts - "a:2" where "a" means array and "2" means 2 elts
	i:0;a:2{													<-- elt 0 - "i" means interger, "0" value of i
		s:5:"login";s:1:"x";s:6:"passwd";s:128:"2..1b";			<-- "s" means string and "5" its length
	}

	i:1;a:2:{s:5:"login";s:1:"y";s:6:"passwd";s:128:"4...3f";}	<-- elt 1
}
*/

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
$private_dir = "../private";
$private_passwd_file = "$private_dir/passwd";
$my_own_secret_string = "this is my own secret string";
$users = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(check_input_data()) {
		echo "ERROR\n";
	} else {
		setup_env($private_dir);
		$user["login"] = $_POST["login"];
		$user["passwd"] = hash_password($_POST["oldpw"], $my_own_secret_string);
		msg("main(): login=" . $user["login"] . "-" .  $user["passwd"] . "\n");
		msg("is user recorded?\n");
		if(is_user_recorded_with_right_password($user, $private_passwd_file)) {
			msg("user DOESNT exist\n");
			$new_user["login"] = $_POST["login"];
			$new_user["passwd"] = hash_password($_POST["newpw"], $my_own_secret_string);
			$old_user["login"] = $_POST["login"];
			$old_user["passwd"] = hash_password($_POST["oldpw"], $my_own_secret_string);
			modify_user($private_passwd_file, $users, $old_user, $new_user);
			echo "OK\n";
		} else {
			msg("user exists\n");
			echo "ERROR\n";
		}
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

function setup_env($private_dir) {
	msg("setup(): private_dir=$private_dir\n");
	if(!file_exists($private_dir)) {
		mkdir("$private_dir");
	}
}

function check_input_data() {
	msg("check_input_data(): \n");

	$err = false;
	if(!my_is_not_empty($_POST["submit"]) || ($_POST["submit"] !== "OK")) {
		$sumit_err = "submit is required";
		$err = true;
	} 

	if(!my_is_not_empty($_POST["login"])) {
		$login_err = "login is required";
		$err = true;
	} 
	// we should check valid chars here
	
	if(!my_is_not_empty($_POST["oldpw"])) {
		$old_passwd_err = "old password is required";
		$err = true;
	}

	if(!my_is_not_empty($_POST["newpw"])) {
		$passwd_err = "new password is required";
		$err = true;
	}
	// we should check valid chars here

	return($err);
}

function record_new_user($private_passwd_file, $users, $user) {
	msg("record_new_user():\n");

	if(!file_exists($private_passwd_file)) {
		msg("record_new_user(): file doesnt exist : this is the first user\n");

		$users[0] = $user;
		$serialized_user = serialize($users);
		file_put_contents($private_passwd_file, $serialized_user, FILE_APPEND);
	} else {
		msg("record_new_user(): file exist : this is NOT the first user\n");

		$serialized_users = file_get_contents($private_passwd_file);
		$deserialized_users = unserialize($serialized_users);
		$i = 0;
		foreach($deserialized_users as $row => $previous_user) {
			$users[$i] = $previous_user;
			$i++;
		}
		$users[$i] = $user;
		$serialized_user = serialize($users);
		file_put_contents($private_passwd_file, $serialized_user);
	}
}

function modify_user($private_passwd_file, $users, $old_user, $new_user) {
	if(!file_exists($private_passwd_file)) {
		// error
	} else {
		msg("modify_user(): file exist : this is NOT the first user\n");

		$serialized_users = file_get_contents($private_passwd_file);
		$deserialized_users = unserialize($serialized_users);
		$i = 0;
		foreach($deserialized_users as $row => $previous_user) {
			if($previous_user == $old_user) {
				$users[$i] = $new_user;
			} else {
				$users[$i] = $previous_user;
			}
			$i++;
		}
		$serialized_users = serialize($users);
		file_put_contents($private_passwd_file, $serialized_users);
	}
}

function get_user($user_login_to_search, $private_passwd_file) {
	msg("\nget_user(): " . $user_login_to_search . "\n");

	$users = "";
	$user = [];
	if(file_exists($private_passwd_file)) {
		$serialized_users = file_get_contents($private_passwd_file);
		$deserialized_users = unserialize($serialized_users);
		foreach($deserialized_users as $row => $user) {
			foreach($user as $key => $value) {
				if($user["login"] == $user_login_to_search) {
					return $user;
				}
			}
		}
	}
	$user = [];
	return $user;
}

function is_user_recorded($new_user, $private_passwd_file) {
	msg("is_user_recorded():\n");

	if(!file_exists($private_passwd_file)) {
		return false;
	} else {
		$serialized_users = file_get_contents($private_passwd_file);
		$deserialized_users = unserialize($serialized_users);
		$previous_user = get_user($new_user["login"], $private_passwd_file);
		if ($previous_user["login"] == $new_user["login"]) {
			return true;
		}
	}
	return false;
}

function is_user_recorded_with_right_password($new_user, $private_passwd_file) {
	msg("is_user_recorded_with_right_password():\n");

	if(!file_exists($private_passwd_file)) {
		return false;
	} else {
		$serialized_users = file_get_contents($private_passwd_file);
		$deserialized_users = unserialize($serialized_users);
		$previous_user = get_user($new_user["login"], $private_passwd_file);
		if ($previous_user == $new_user) {
			return true;
		}
	}
	return false;
}

function hash_password($password, $my_own_secret_string) {
	msg("hashed_password(): " . $password . "\n");
	$hashed_password = hash('whirlpool', $password . $my_own_secret_string);
	msg("hashed_password() END: " . $hashed_password . "\n");
	return $hashed_password;
}

?>
