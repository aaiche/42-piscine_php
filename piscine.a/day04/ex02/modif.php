<?php
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
		if(is_user_recorded_with_right_password($user, $private_passwd_file)) {
			$new_user["login"] = $_POST["login"];
			$new_user["passwd"] = hash_password($_POST["newpw"], $my_own_secret_string);
			$old_user["login"] = $_POST["login"];
			$old_user["passwd"] = hash_password($_POST["oldpw"], $my_own_secret_string);
			modify_user($private_passwd_file, $users, $old_user, $new_user);
			echo "OK\n";
		} else {
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
	if(!file_exists($private_dir)) {
		mkdir("$private_dir");
	}
}

function check_input_data() {
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
	if(!file_exists($private_passwd_file)) {
		$users[0] = $user;
		$serialized_user = serialize($users);
		file_put_contents($private_passwd_file, $serialized_user, FILE_APPEND);
	} else {
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
	$hashed_password = hash('whirlpool', $password . $my_own_secret_string);
	return $hashed_password;
}

?>
