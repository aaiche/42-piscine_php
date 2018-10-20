#!/usr/bin/php
<?php
function display_message($msg) {
	echo "$msg";
}

function sum($a, $b) {
	return ($a + $b);
}

function substract($a, $b) {
	return ($a - $b);
}

function multiply($a, $b) {
	return ($a * $b);
}

function division($a, $b) {
	if ($b != "0")
		return ($a / $b);
	else
		return("Syntax Error");
}

function modulo($a, $b) {
	if ($b != "0")
		return ($a % $b);
	else
		return("Syntax Error");
}

function my_basic_calculator($a, $operator, $b) {
	if(!is_numeric($a) || !is_numeric($b)) {
		return("Syntax Error");
	}
	switch($operator) {
		case '+':
			return (sum($a, $b));
			break;

		case '-':
			return (division($a, $b));
			break;

		case '*':
			return (multiply($a, $b));
			break;

		case '/':
			return (division($a, $b));
			break;

		case '%':
			return (modulo($a, $b));
			break;

		default:
			return("Syntax Error");
	}
}

if($argc == 2) {
	$str = $argv[1];
	sscanf($str,"%d %c %d", $a, $operator, $b);
	$result = my_basic_calculator($a, $operator, $b);
	display_message("$result\n");
} else {
	display_message("Incorrect Parameters\n");
}


?>
