<?php

session_start();
include_once 'db_connect.php';
if (!(isset($_GET['action'])))
  exit("Error");

if ($_SESSION['is_admin'] != 1){
  echo "not admin = Access Forbidden";
  exit();
}

if ($_GET['action'] == "insert")
{

	$conn = OpenCon();

	$username =  $conn->real_escape_string($_GET['username']);
	$date =  $conn->real_escape_string($_GET['date']);

	$conn = OpenCon();
	$sql = "INSERT INTO `shop`.`commands`(`name`, `created`) 
	VALUES ('".$username."', '".$date."');";

	$result = $conn->query($sql);
	// exit($sql);
	header("Location: admin.php");

	exit();
}

if ($_GET['action'] == "add")
{
	echo '<head>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	</head>';

	$conn = OpenCon();
	$sql = 'SELECT
			*
			FROM
			shop.users ORDER BY name';

	$result = $conn->query($sql);

	$users = '<select name=username>';

	if ($result->num_rows > 0)
	{
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$users .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
	    }
	}

	$users .= '</select>';

	  echo '<h3>Add Order</h3>';
	  echo '<form action=add_order.php style="width:500px">
			Customer: '.$users.'<br/>
			Date: <br/><input type="date" name="date" required><br/>
			<button name=action value=insert>Add</button>
		</form>';
}

?>