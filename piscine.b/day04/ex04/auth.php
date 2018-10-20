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
 * CONST_VERBOSE_AUTH = 1, to display more messages
 * alternative would have been to use the global keyword or GLOBALS['] ==> but not recommended
 */
define('CONST_VERBOSE_AUTH', 0);
function msg_auth($str) {
	if (CONST_VERBOSE_AUTH) {
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

function get_user($user_login_to_search, $private_passwd_file) {
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

function is_user_recorded_with_right_password($new_user, $private_passwd_file) {
	msg_auth("is_user_recorded_with_right_password():" . $private_passwd_file . "\n");
	//var_dump($new_user);
	if(!file_exists($private_passwd_file)) {
		msg_auth("is_user_recorded(): file doesnt exist : this is the first user\n");
		return false;
	} else {
		msg_auth("is_user_recorded(): file exists, we are going to check\n");
		$serialized_users = file_get_contents($private_passwd_file);
		$deserialized_users = unserialize($serialized_users);
		$previous_user = get_user($new_user["login"], $private_passwd_file);
		msg_auth("\n" . "previouss user: \n");
		//var_dump($previous_user);
		if ($previous_user == $new_user) {
			msg_auth("\n" . "user exists and password is correct\n");
			return true;
		}
	}
	msg_auth("\n" . "is_user_recorded_with_right_password returns false\n");
	return false;
}

function hash_password($password, $my_own_secret_string) {
	$hashed_password = hash('whirlpool', $password . $my_own_secret_string);
	return $hashed_password;
}

function auth($login, $password) {
	global $private_passwd_file;
	global $my_own_secret_string;
	msg_auth("======> auth():\n");
	msg_auth("======> login=" . $login . "\n");
	msg_auth("======> password=" . $password . "\n");
	msg_auth("======> auth(): $private_passwd_file\n");
	if(!my_is_not_empty($login) || (!my_is_not_empty($password))) {
		msg_auth("======> auth(): empty\n");
		return false;
	} 
	$user["login"] = $login;
	$user["passwd"] = hash_password($password, $my_own_secret_string);
	msg_auth("======> hasshed password=" . $user["passwd"] . "\n");
	if(is_user_recorded_with_right_password($user, $private_passwd_file)) {
		msg_auth("======> auth(): returns true\n");
		return true;
	} else {
		msg_auth("======> auth(): returns false\n");
		return false;
	}
}
?>
