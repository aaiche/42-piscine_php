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
		return("Incorrect Parameters");
}

function modulo($a, $b) {
	if ($b != "0")
		return ($a % $b);
	else
		return("Incorrect Parameters");
}

function my_basic_calculator($a, $operator, $b) {
	if(!is_numeric($a) || !is_numeric($b)) {
		return("Incorrect Parameters");
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
			return("Incorrect Parameters");
	}
}

if($argc == 4) {
	$a = trim($argv[1]);
	$operator = trim($argv[2]);
	$b = trim($argv[3]);

	$result = my_basic_calculator($a, $operator, $b);
	display_message("$result\n");
} else {
	display_message("Incorrect Parameters\n");
}


?>
