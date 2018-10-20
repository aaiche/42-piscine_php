<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	switch ($_GET['action']) {
		case("set"):
			if ($_GET['name'] && $_GET['value']) {
				$cookie_name = $_GET['name'];
				$cookie_value = $_GET['value'];
				$num_days = 1;
				$cookie_expires_after_num_days = time() + (86400 * $num_days);
				setcookie($cookie_name, $cookie_value, $cookie_expires_after_num_days);
			}
			break;
		case("get"):
			if ($_GET['name'] && $_COOKIE[$_GET['name']]) {
				$cookie_name = $_GET['name'];
				$cookie_value = $_COOKIE[$cookie_name];
				echo $cookie_value ."\n";
			}
			break;
		case("del"):
			if ($_GET['name']) {
				$cookie_name = $_GET['name'];
				$cookie_expires_old_timestamp = 1;
				setcookie($cookie_name, '', $cookie_expires_old_timestamp);
			}
			break;
	}
}
?>
