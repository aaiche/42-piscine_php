<?php

session_start();
include_once 'db_connect.php';


if (!(isset($_GET['username'])))
	exit("Error");
if ($_SESSION['is_admin'] != 1){
    echo "not admin = Access Forbidden";
    exit();
}

$username = $_GET['username'];

if ($_GET['action'] == 'save')
{
	if ($_GET['is_admin'] == 1)
		$admin = 1;
	else
		$admin = 0;
	if ($_GET['active'] == 1)
		$active = 1;
	else
		$active = 0;

	$conn = OpenCon();
	$sql = "UPDATE users SET  address='".$_GET['address']."' , is_admin=".$admin." ,mail='".$_GET['mail']."'  
	,active=".$active." WHERE name = '".$username."' ";
	$result = $conn->query($sql);
	header("Location: admin.php");
    exit();
}

echo '<head>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>';


$conn = OpenCon();
$username = $conn->real_escape_string($username);
$sql = "SELECT * FROM users WHERE name = '".$username."' ";

$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()) {
    	if ($row['is_admin'] == 1)
    		$class = "checked";
    	else
    		$class = "";
    	if ($row['active'] == 1)
    		$classact = "checked";
    	else
    		$classact = "";
    	echo '<h3>Edit User</h3>
    		<form action=edit_user.php method="GET" style="width:500px">
    		Email: <input type="text" name="mail" value='.$row['mail'].'><br/>
    		Address: <input type="text" name="address" value='.$row['address'].'><br/>
    		<input hidden type="text" name="username" value='.$row['name'].'>
    		Active: <input type="checkbox" name="active" value="1" '.$classact.'> <br/>
    		Is Admin: <input type="checkbox" name="is_admin" value="1" '.$class.'> <br/>
    		<input hidden type="text" name="action" value="save">
    		<button>Save</button>
    		</form>
    	';
    }
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

?>