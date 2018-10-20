<?php
/*
 * ../private/chat
a:2:{ 															<-- 2 elts - "a:2" where "a" means array and "2" means 2 elts
	i:0;a:3:{													<-- elt 0 - "i" means interger, "0" value of i - "a" array of 3elets
 		s:5:"login"; s:5:"user1";								<-- subelt 0
		s:4:"time"; i:1364287362;								<-- subelt 1
		s:3:"msg";s:8:"Bonjours";								<-- subelt 2
	}
	i:1;a:3:{													<-- elt 1
		s:5: "login"; s:5:"user2";
		s:4:"time";i:1364287423;
		s:3:"msg";s:5:"Hello";
	}
}
*/

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


$login = "";
$private_dir = "../private";
$private_chat_file = "$private_dir/chat";

$id = session_id();
msg("cookie received: session_id() = $id\n");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	msg("chat():\n");
	if(my_is_not_empty($_SESSION["logged_on_user"])) {
		msg("recovered the session with _SESSION[logged_on_user]=" . $_SESSION["logged_on_user"] . "\n");
		$login = $_SESSION["logged_on_user"];
		msg("chat(): ok\n");
		msg($login . "\n");
		date_default_timezone_set('Europe/Paris');
		read_msg($private_chat_file);
	} else {
		// we could not retrieve the session ?
		msg("chat(): error\n");
		echo "ERROR";
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

function read_msg($private_chat_file) {
	msg("read_msg(): " . $private_chat_file . "\n");
	if(!file_exists($private_chat_file)) {
		msg("record_msg(): file doesnt exist, nothing to display.\n");
	} else {
		msg("record_msg(): file exists, we are going to add new user message\n");
		$fh = fopen($private_chat_file, "r");
		flock($fh, LOCK_EX);
		$serialized_users_msg = file_get_contents($private_chat_file);
		$deserialized_users_msg = unserialize($serialized_users_msg);
		$i = 0;
		foreach ($deserialized_users_msg as $row => $user_msg) {
			$users_msg = $users_msg[$i];
			$readable_timestamp = strftime("%H:%M", $user_msg["time"]);
			msg("        user: " . $user_msg["login"]. "\n");
			msg("        time: " . $user_msg["time"] . " = " . $readable_timestamp . "\n");
			msg("         msg: " . $user_msg["msg"] . "\n");
			$raw_user_msg = "[" . $readable_timestamp . "] ";
			$raw_user_msg .= "<b>" . $user_msg["login"] . "</b>: ";
			$raw_user_msg .= $user_msg["msg"] . "<br />";
			echo $raw_user_msg . "\n"; 
			$i++;
		}
		flock($fh, LOCK_UN);
		fclose($fh);
	}
}
?>
