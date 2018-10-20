<?php

	session_start();
	include_once 'db_connect.php';

	// echo $_GET['table'];
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

	function add_user($username, $password, $email, $address, $admin)
	{
		$conn = OpenCon();
	  	$username = $conn->real_escape_string($username);
	  	$email = $conn->real_escape_string($email);
	  	$address = $conn->real_escape_string($address);
	  	$password = hash("whirlpool", $password);
		$sql = "INSERT INTO `shop`.`users`(`name`, `mail`, `password`, `address`,`is_admin`, `active`) 
		VALUES ('".$username."', '".$email."', '".$password."','".$address."', ".$admin.", 1);";
		$result = $conn->query($sql);
		return TRUE;
	}

	if ($_GET['table'] == 'user' && $_GET['action'] == 'add')
	{
		if (isset($_GET['username']) && isset($_GET['password']) && isset($_GET['mail']) && isset($_GET['address']))
		{
			if (check_username_exists($_GET['username']) == FALSE)
			{
				if ($_GET['is_admin'] == 1)
					$admin = 1;
				else
					$admin = 0;
				if (add_user($_GET['username'], $_GET['password'], $_GET['mail'], $_GET['address'], $admin) === TRUE)
				{
					header("Location: admin.php");
				}
			}
			else
			{
				echo "Username exist";
			}
		}
		else
		{
			echo "Missing Values";
		}
	}

	if ($_GET['table'] == 'user' && $_GET['action'] == 'delete')
	{
		if (isset($_GET['username']))
		{
			$conn = OpenCon();
		  	$username = $conn->real_escape_string($_GET['username']);
			$sql = "DELETE FROM users WHERE name = '".$username."'";
			$result = $conn->query($sql);
			header("Location: admin.php");
		}
		else
		{
			echo "Missing Values";
		}
	}

?>