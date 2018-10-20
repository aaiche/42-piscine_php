#!/usr/bin/php
<?php 
function display_message($msg) {
	echo "$msg";
}

function is_pair($x) {
	if ($x % 2)
		return TRUE;
	else
		return FALSE;
}

while (TRUE) {
	display_message("Entrez un nombre: ");
	$line = fgets(STDIN);
	if (feof(STDIN) == TRUE)
		exit(0);
	$var = trim($line);
	if (is_numeric($var))
	{
		display_message("Le chiffre $var est ");
		if (!is_pair($var))
			display_message("Pair\n");
		else
			display_message("Impair\n");
	}
	else
	{
		display_message("'$var' n'est pas un chiffre\n");
	}
}
?>
