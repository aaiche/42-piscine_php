<?php

session_start();
include_once 'db_connect.php';


if (!(isset($_GET['action'])))
	exit("Error");

if ($_SESSION['is_admin'] != 1){
	echo "not admin = Access Forbidden";
	exit();
}

$username = $_GET['username'];

if ($_GET['action'] == 'delete' && isset($_GET['id']))
{

	$conn = OpenCon();
	$id = $conn->real_escape_string($_GET['id']);
	$sql = "DELETE FROM products WHERE id = ".$id."";
	$result = $conn->query($sql);

	header("Location: admin.php");
	exit();
}

if ($_GET['action'] == 'update' && isset($_GET['id']))
{

	$conn = OpenCon();
	$id = $conn->real_escape_string($_GET['id']);
	$sql = "DELETE FROM cat_list WHERE pd_id = ".$id."";
	$result = $conn->query($sql);

	$categories = $_GET['categories'];
	$sql = '';

    if(count($categories)>0){
        foreach($categories as $cat)
        {
            $sql .= "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES ( ".$cat.", ".$id."); ";
        }
        $conn->multi_query($sql);
    }

    // exit($sql);
    $conn = OpenCon();
    $name = $conn->real_escape_string($_GET['name']);
  	$description = $conn->real_escape_string($_GET['description']);
  	$image = $conn->real_escape_string($_GET['image']);
  	$price = $conn->real_escape_string($_GET['price']);
  	$status = $_GET['status'];

    $sql = "UPDATE `shop`.`products` SET `name` = '".$name."', `description` = '".$description."',
     `image_sm` = '".$image."', `price` = ".$price.", status = ".$status." WHERE `id` = ".$id." ;";
	$result = $conn->query($sql);
	// exit($sql);
	header("Location: admin.php");
}

if ($_GET['action'] == 'edit' && isset($_GET['id']))
{
	echo '<head>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>';

	$conn = OpenCon();
	$id = $conn->real_escape_string($_GET['id']);

	$sql = "SELECT
				shop.categories.cat_id,
				shop.categories.`name`,
			CASE
				WHEN (
				(
			SELECT
			COUNT( cat_id ) 
			FROM
				cat_list 
			WHERE
				pd_id = ".$id." AND cat_id =  shop.categories.cat_id
				) > 0 
				) THEN
					'checked' ELSE '' 
				END AS checked
			FROM
			shop.categories;";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
	    while($row = $result->fetch_assoc()) {

	    	$cat_list .= "<input ".$row['checked']." type='checkbox' name='categories[]' value=".$row['cat_id'].">".$row['name']."<br>";

	    }
	}


	$sql = "SELECT * FROM `shop`.`products` WHERE id = ".$id." ;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
	    while($row = $result->fetch_assoc()) {

			echo '
				<h3>Edit Product</h3>
				<form action=edit_product.php style="width:500px">
				<input hidden type=text name=id value='.$id.' required>
					Name: <input type=text name=name value='.$row['name'].' required><br/>
					Description: 
					<textarea required name="description" cols="40" rows="3">'.$row['description'].'</textarea><br/>
					Image: <input type=text name=image value='.$row['image_sm'].' required><br/>
					Price: <input type=number step="0.01" name=price value='.$row['price'].' required><br/>
					Active: <input type=text  name=status value='.$row['status'].' required><br/>
					Categories: <br/>
					'.$cat_list.'
					<button name=action value=update>Save</button>
				</form>
			';
	    	
	    }
	}
}

if ($_GET['action'] == 'insert')
{
	$conn = OpenCon();
  	$name = $conn->real_escape_string($_GET['name']);
  	$description = $conn->real_escape_string($_GET['description']);
  	$image = $conn->real_escape_string($_GET['image']);
  	$price = $conn->real_escape_string($_GET['price']);
  	$status = $conn->real_escape_string($_GET['status']);

	$sql = "INSERT INTO `shop`.`products`(`name`, `description`, `image_sm`,  `price`, `status`) 
	VALUES ('".$name."', '".$description."', '".$image."', ".$price.", ".$status.");";

	$result = $conn->query($sql);
        
    $categories = $_GET['categories'];

    if($result && count($categories)>0){
        $id = $conn->insert_id;
        $sql = '';

        foreach($categories as $cat){
            $sql .= "INSERT INTO `shop`.`cat_list`(`cat_id`, `pd_id`) VALUES ( ".$cat.", ".$id.");";
        }
        $conn->multi_query($sql);
       	header("Location: admin.php");
    }
    else
    {
    	header("Location: admin.php");
    }
}

if ($_GET['action'] == 'add')
{

	echo '<head>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>';

	$conn = OpenCon();
	$sql = "SELECT * FROM `shop`.`categories` ORDER BY name ;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
	    while($row = $result->fetch_assoc()) {

	    	$cat_list .= "<input type='checkbox' name='categories[]' value=".$row['cat_id'].">".$row['name']."<br>";
	    }
	}
	echo '
		<h3>New Product</h3>
		<form action=edit_product.php style="width:500px">
			Name: <input type=text name=name required><br/>
			Description: <textarea required name="description" cols="40" rows="3"></textarea><br/>
			Image: <input type=text name=image required><br/>
			Price: <input type=number step="0.01" name=price required><br/>
			Active: <input type=text  pattern="[0-1]{1}" name=status value=1 required><br/>
			Category: <br/>
			'.$cat_list.'
			<button name=action value=insert>Add</button>
		</form>
	';
}