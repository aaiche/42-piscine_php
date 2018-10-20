<?php
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

function OLD_is_user_recorded_with_right_password($new_user, $private_passwd_file) {
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

function is_user_recorded_with_right_password($new_user, $private_passwd_file) {
	echo  "is_user_recorded_with_right_password():" . $private_passwd_file . "\n";
	var_dump($new_user);
	if(!file_exists($private_passwd_file)) {
		echo  "is_user_recorded(): file doesnt exist : this is the first user\n";
		return false;
	} else {
		echo  "is_user_recorded(): file exist : we going to check\n";
		$serialized_users = file_get_contents($private_passwd_file);
		$deserialized_users = unserialize($serialized_users);
		echo  "\n" . "new user to check: \n";
		var_dump($new_user);
		$previous_user = get_user($new_user["login"], $private_passwd_file);
		echo  "\n" . "previuos user: \n";
		var_dump($previous_user);
		if ($previous_user == $new_user) {
			echo  "\n" . "user exists and password is correct\n";
			return true;
		}
	}
	echo  "\n" . "is_user_recorded_with_right_password returns false\n";
	return false;
}

function hash_password($password, $my_own_secret_string) {
	$hashed_password = hash('whirlpool', $password . $my_own_secret_string);
	return $hashed_password;
}

function auth($login, $password) {
	echo "======> auth():\n";
	echo "======> login=" . $login . "\n";;
	echo "======> password=" . $password . "\n";;
	$private_dir = "../private";
	$private_passwd_file = "$private_dir/passwd";
	if(!my_is_not_empty($login) || (!my_is_not_empty($password))) {
		echo "======> auth(): empty\n";
		return false;
	} 
	$user["login"] = $login;
	$user["passwd"] = hash_password($password, $my_own_secret_string);
	echo "======> hasshed password=" . $user["passwd"] . "\n";;
	if(is_user_recorded_with_right_password($user, $private_passwd_file)) {
		echo "======> auth(): returns true\n";
		return true;
	} else {
		echo "======> auth(): returns false\n";
		return false;
	}
}
?>
