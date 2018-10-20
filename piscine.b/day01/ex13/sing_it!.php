#!/usr/bin/php
<?php
/*
 * Est ce que il s agit d une blague !!!
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

/*
 * Type the following shell command to disable bash history so no need to escape !
 * 		$> unsetopt BANG_HIST
 * For my information: There is a way to run shell script from php script : shell_exec('ls -l')
 */
function before_running_this_script() {
	if (CONST_VERBOSE) {
 		echo("\n!!! Is this exercice a joke !!!\n\n");
 		echo("Type the following shell command to disable bash history so no need to escape !\n");
 		echo("       $> unsetopt BANG_HIST\n\n");
	}
}

/*
 * get the login name via external shell script
 */
function get_login_name() {
	$output = shell_exec('whoami');
	// TBD what is this command fails
	if ($output !== null) {			// !== is it different on value or on type
		msg("get_login_name(): output=$output\n");
		return ($output);
	} else {
		msg("get_login_name(): unsuccessful [output=$output]\n");
		return (false);
	}
}

/*
 * send mail using internal php command mail()
 */
function send_mail($to, $subject, $txt, $headers) {
	$retval = mail($to, $subject, $txt);

	if ($retval == true ) {
		msg("send_mail(): message sent successfully...\n");
	} else {
		msg("send_mail(): message could not be sent...\n");
	}
}


before_running_this_script(); 
if ($argv[1] == "mais pourquoi cette demo ?") {
	echo "Tout simplement pour qu'en feuilletant le sujet\non ne s'apercoive pas de la nature de l'exo..\n";
} else if($argv[1] == "mais pourquoi cette chanson ?") {
	echo "Parce que Kwame a des enfants\n";
} else if($argv[1] == "vraiment ?") {
	if (rand(0, 1)) {
		echo "Nan c'est parce que c'est le premier avril\n";
	} else {
		echo "Oui il a vraiment des enfants\n";
	}
}

/*
 * Do you know that we can send mails from a php script ?
 * 	- i did not: it looks easy, but ...
 */
$to = "aaiche@student.42.fr";
$subject = "piscine php day01 ex13";
$txt =  "";
$headers = "";
//$headers .= "From: $to\r\n";
//$headers .= "To: $to\r\n";
//$headers .= "Reply-To: $to";

$txt = get_login_name();
if ($txt !== false) {
} else  {
	$txt = "failed to get the login\n";
}
$subject .= ": ";
$subject .= $txt;
send_mail($to, $subject, $txt, $headers);
	

?>
