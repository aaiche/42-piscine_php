<?php

	include_once 'db_connect.php';

	session_start();
	// $_SESSION['logged_on_user'] = "test";

	$username2 = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$address = $_POST['address'];

	function add_error($msg)
	{
		$msg .= "<br/>";
		return ($msg);
	}

	function register_error($msg)
	{
		echo $msg;
		// exit();
	}

	function check_username_exists($username)
	{
		$conn = OpenCon();
	  	$username = $conn->real_escape_string($username);
		$sql = "SELECT * FROM users WHERE name = '".$username."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
			return TRUE;
		else
			return FALSE;
	}

	function add_user($username, $password, $email, $address)
	{
		$conn = OpenCon();
	  	$username = $conn->real_escape_string($username);
	  	$email = $conn->real_escape_string($email);
	  	$address = $conn->real_escape_string($address);
	  	$password = hash("whirlpool", $password);
		$sql = "INSERT INTO `shop`.`users`(`name`, `mail`, `password`, `address`,`is_admin`, `active`) 
		VALUES ('".$username."', '".$email."', '".$password."','".$address."', 0, 1);";
		$result = $conn->query($sql);
		return TRUE;
	}

	$err_msg = "";

	if ( preg_match('/\s/',$username2) )
		$err_msg .= add_error("Username cannot have spaces.");
	if (strlen($username2) < 4)
		$err_msg .= add_error("Username is too short.");
	if (check_username_exists($username2) == TRUE)
		$err_msg .= add_error("Username already exists.");
	if (strlen($password) < 4)
		$err_msg .= add_error("Password is too short.");
	if (strlen($email) < 4)
		$err_msg .= add_error("Email is too short.");
	if (strlen($address) < 4)
		$err_msg .= add_error("Address is too short.");
	if ($password !== $password_confirm)
		$err_msg .= add_error("Passwords don't match!");
	if (!(filter_var($email, FILTER_VALIDATE_EMAIL)))
		$err_msg .= add_error("Invalid email format"); 

	if ($err_msg)
	{
		echo '<!DOCTYPE html>
				<html lang="en">

				  <head>

				    <title>Invalid</title>

				    <link href="css/front.css" rel="stylesheet">
				    <link href="css/cart.css" rel="stylesheet">
				    <link href="css/profile.css" rel="stylesheet">

				  </head><body><br/><div id="edit">
					<h2>Sorry...</h2><br>';

		include ('header.php');
		register_error($err_msg);
		echo '<br/><div><a href="javascript:history.go(-1)"><button  class="button" id="cyan">Go Back</button></a></div>';
		echo '</div>';
		exit();

	}
	else
	{
		if (add_user($username2, $password, $email, $address) === TRUE)
		{
			$_SESSION['logged_on_user'] = $username2;
			header("Location: index.php");
		}
		// echo "success";
	}

?>