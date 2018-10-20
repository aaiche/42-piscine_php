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

//define variables and set to empty values
$login = "";
$private_dir = "../private";
$private_chat_file = "$private_dir/chat";
$display_html = false;

$id = session_id();
msg("cookie received: session_id() = $id\n");

function my_is_not_empty($input) {
	$str_temp = $input;

	if ($str_temp != '') {
		return true;
	} else {
		return false;
	}
}

function record_msg($private_chat_file, $user_msg) {
	$users_msg = [];
	msg("record_msg(): " . $private_chat_file . "\n");
	msg("        user: " . $user_msg["login"]. "\n");
	msg("        time: " . $user_msg["time"] . "\n");
	msg("         msg: " . $user_msg["msg"] . "\n");
	if(!file_exists($private_chat_file)) {
		msg("record_msg(): file doesnt exist : this is the first user message\n");
		$users_msg[0] = $user_msg;
		$serialized_user_msg = serialize($users_msg);
		file_put_contents($private_chat_file, $serialized_user_msg, FILE_APPEND | LOCK_EX);
		$fh = fopen($private_chat_file, "rw");
		flock($fh, LOCK_UN);
		fclose($fh);
	} else {
		msg("record_msg(): file exists, we are going to add new user message\n");
		$fh = fopen($private_chat_file, "rw");
		flock($fh, LOCK_EX);
		$serialized_users_msg = file_get_contents($private_chat_file);
		$deserialized_users_msg = unserialize($serialized_users_msg);
		//msg("$deserialized_users_msg\n");
		$i = 0;
		foreach ($deserialized_users_msg as $row => $previous_user_msg) {
			$users_msg[$i] = $previous_user_msg;
			$i++;
		}
		$users_msg[$i] = $user_msg;
		$serialized_users_msg = serialize($users_msg);
		file_put_contents($private_chat_file, $serialized_users_msg);
		flock($fh, LOCK_UN);
		fclose($fh);
	}
}

msg("speak():\n");
if (!my_is_not_empty($_SESSION["logged_on_user"])) {
	// we could not retrieve the session ?
	msg("speak(): error\n");
	echo "ERROR\n";
} else {
	msg("recovered the session with _SESSION[logged_on_user]=" . $_SESSION["logged_on_user"] . "\n");
	$login = $_SESSION["logged_on_user"];
	msg("speak(): $login is logged on.\n");
	if(my_is_not_empty($_POST["msg"])) {
		$user_msg["login"] = $login;
		$user_msg["time"] = time();
		$user_msg["msg"] = $_POST["msg"];
		record_msg($private_chat_file, $user_msg);
	} 
?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title>42Chat</title>
				<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
			</head>
			<body>
				<form action="speak.php" method="POST">
					<input type="text" name="msg" value=""/><input type="submit" name="submit" value="Send"/>
				</form>
			</body>
		</html>
<?php
}
?>
