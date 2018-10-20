<?php

session_start();
include_once 'db_connect.php';


if (!(isset($_GET['order_id'])))
  exit("Error");
if ($_SESSION['is_admin'] != 1){
  echo "not admin = Access Forbidden";
  exit();
}

$ORDER_ID = $_GET['order_id'];


if ($_GET['action'] == "delete")
{
  $conn = OpenCon();
  $det_id = $conn->real_escape_string($_GET['det_id']);
  $sql = "DELETE FROM commands_details WHERE det_id=".$det_id."";
  $result = $conn->query($sql);
  header("Location: edit_order.php?order_id=".$ORDER_ID."");
  exit();
}

if ($_GET['action'] == "delete_all_order")
{
  $conn = OpenCon();
  $det_id = $conn->real_escape_string($_GET['det_id']);
  $sql = "DELETE FROM commands WHERE com_id=".$ORDER_ID."";
  $result = $conn->query($sql);
  header("Location: admin.php");
  exit();
}

if ($_GET['action'] == "insert")
{
  $conn = OpenCon();
  $order_id = $conn->real_escape_string($_GET['order_id']);
  $pd_id = $conn->real_escape_string($_GET['pd_id']);
  $quantity = $conn->real_escape_string($_GET['quantity']);
  $price = $conn->real_escape_string($_GET['price']);

  $sql = "INSERT INTO `shop`.`commands_details`(`order_id`, `pd_id`, `quantity`, `price`) 
        VALUES (".$order_id.", ".$pd_id.", ".$quantity.", ".$price.");";
    // exit($sql);
  $result = $conn->query($sql);
  header("Location: edit_order.php?order_id=".$order_id."");
  exit();
}

echo '<head>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>';

if ($_GET['action'] == "add")
{
  echo '<h4>Add Order</h4>';
}


$conn = OpenCon();
$ORDER_ID = $conn->real_escape_string($ORDER_ID);
$sql = "SELECT
		shop.commands_details.det_id,
		shop.commands_details.order_id,
		shop.commands_details.pd_id,
		shop.commands_details.quantity,
		shop.commands_details.price,
		shop.products.`name`,
		shop.products.price AS price_0
		FROM
		shop.commands_details
	JOIN shop.products
ON shop.commands_details.pd_id = shop.products.id
		WHERE shop.commands_details.order_id = ".$ORDER_ID."";

		echo '<br/>
  		<h3>Order #'.$ORDER_ID.'</h3>
          <table>
          <tr>
            <th>Products</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>';

$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()) {
    	echo ' <tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['quantity'].'</td>
            <td>'.$row['price'].'</td>
            <td><a href="edit_order.php?det_id='.$row['det_id'].'&action=delete&order_id='.$ORDER_ID.'"><button>Delete</button></td>
          </tr>';
    }
}
echo "</table>";


$conn = OpenCon();
  $sql = 'SELECT
      *
      FROM
      shop.products ORDER BY name';

  $result = $conn->query($sql);

  $products = '<select name=pd_id>';

  if ($result->num_rows > 0)
  {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $products .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
      }
  }

  $products .= '</select>';

echo '<br/><br/><br/><h5>Add Products</h5>';
    echo '<form action=edit_order.php style="width:400px">
      Product: '.$products.'<br/>
      Quantity: <br/><input type="number" name="quantity" value=1 required><br/>
      Price: <br/><input type="number" name="price" step="0.01" required><br/>
      <input hidden type="text" name="order_id" value='.$ORDER_ID.' required>
      <button name=action value=insert>Add</button>
    </form>';

echo "<div><a href='admin.php'>Go Back</a></div>";
?>



