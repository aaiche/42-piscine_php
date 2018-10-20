<?php

session_start();
include_once 'db_connect.php';


if ($_SESSION['is_admin'] != 1){
  echo "not admin = Access Forbidden";
  exit();
}

if ($_GET['action'] == "edit" && isset($_GET['cat_id']) )
{
  echo '<head>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    </head>';

  $conn = OpenCon();
  $cat_id = $conn->real_escape_string($_GET['cat_id']);
  $sql = "SELECT * FROM `shop`.`categories` WHERE `cat_id` = ".$cat_id.";";
  $result = $conn->query($sql);

  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
      while($row = $result->fetch_assoc()) {
        echo '<h5>Edit Category</h5>
          <form action=edit_category.php style="width: 200px">
          <input required type=text name=name value='.$row['name'].' >
          <input hidden type=text name=cat_id value='.$cat_id.' >
          <button name=action value=update>Save</button>
          </form>
        ';
      }
  }
}

if ($_GET['action'] == "update" && isset($_GET['cat_id']) )
{
  $conn = OpenCon();
  $name = $conn->real_escape_string($_GET['name']);
  $cat_id = $conn->real_escape_string($_GET['cat_id']);
  $sql = "UPDATE `shop`.`categories` SET `name` = '".$name."' WHERE `cat_id` = ".$cat_id.";";
  $result = $conn->query($sql);
  header("Location: admin.php");
}

if ($_GET['action'] == "add" && isset($_GET['name']) )
{
  $conn = OpenCon();
  $name = $conn->real_escape_string($_GET['name']);
  $sql = "INSERT INTO `shop`.`categories`(`name`) VALUES ('".$name."');";
  $result = $conn->query($sql);
  header("Location: admin.php");
}

if (!(isset($_GET['cat_id'])))
  exit("Error");

$cat_id = $_GET['cat_id'];
if ($_GET['action'] == "delete")
{
  $conn = OpenCon();
  $cat_id = $conn->real_escape_string($_GET['cat_id']);
  $sql = "DELETE FROM categories WHERE cat_id=".$cat_id."";
  $result = $conn->query($sql);
  header("Location: admin.php");
}

?>