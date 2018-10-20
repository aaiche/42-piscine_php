<?php

session_start();
include_once 'db_connect.php';

if ($_SESSION['is_admin'] == 1)
	echo "<h1>Welcome Admin!</h1>
        <a href=index.php><h4>Go Back</h4></a>";
else{
	echo "not admin = Access Forbidden";
	exit();
}

echo '<head>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>';

//USERS
echo '<br/>
		<h3>All Users</h3>
      <table>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Mail</th>
        <th>Address</th>
        <th>Active</th>
        <th>Admin</th>

      </tr>';

$sql = "SELECT
		shop.users.user_id,
		shop.users.`name`,
		shop.users.mail,
		shop.users.address,
		shop.users.active,
		shop.users.is_admin
		FROM
		shop.users";
$conn = OpenCon();

$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo ' <tr>
                    <td>'.$row['user_id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>-set-</td>
                    <td>'.$row['mail'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['active'].'</td>
                    <td>'.$row['is_admin'].'</td>
                    <td><a href="edit_user.php?username='.$row['name'].'"><button>Edit</button></a></td>
                    <td><a href="admin_db.php?username='.$row['name'].'&table=user&action=delete"><button>Delete</button></a></td>
                  </tr>';
    }

    echo '
    <td>Add: </td>
    <form action="admin_db.php" method="GET">
    <td><input required name="username" type="text"></td>
    <td><input required name="password" type="text"></td>
    <td><input required name="mail" type="text"></td>
    <td><input required name="address" type="text"></td>
    <td><input name="table" value="user" hidden><input name="action" value="add" hidden></td>
    <td><input type="checkbox" name="is_admin" value="1"></td>
    <td><button>Add</button></td>
    </form>
    </table>';

}
CloseCon($conn);


// ORDERS

$conn = OpenCon();
$sql = 'SELECT
		shop.commands.com_id,
		shop.commands.name,
		DATE_FORMAT(shop.commands.created,"%M %e %Y") AS date,
		SUM(shop.commands_details.quantity) AS quantity,
		SUM(shop.commands_details.price * shop.commands_details.quantity) AS total_price
		FROM
		shop.commands
		LEFT OUTER JOIN shop.commands_details
		ON shop.commands.com_id = shop.commands_details.order_id
		GROUP BY 
		shop.commands.com_id,
		shop.commands.name,
		DATE_FORMAT(shop.commands.created,"%W %M %e %Y")';
$result = $conn->query($sql);

echo '<br/>
  		<h3>All Orders</h3>
          <table>
          <tr>
            <th>Order#</th>
            <th>Date</th>
            <th>User</th>
            <th>Quantity</th>
            <th>Total Price</th>
          </tr>';

if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	echo ' <tr>
            <td>'.$row['com_id'].'</td>
            <td>'.$row['date'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['quantity'].'</td>
            <td>'.$row['total_price'].'</td>
            <td><a href="edit_order.php?order_id='.$row['com_id'].'"><button>Edit</button></td>
            <td><a href="edit_order.php?order_id='.$row['com_id'].'&action=delete_all_order"><button>Delete</button></a></td>
          </tr>';

    }
}
echo "</table><a href=add_order.php?action=add><button>Add Order</button></a>";

CloseCon($conn);

// CATEGORY

$conn = OpenCon();
$sql = 'SELECT
		shop.categories.cat_id,
		shop.categories.`name`
		FROM
		shop.categories';
$result = $conn->query($sql);

echo '<br/>
  		<h3>All Categories</h3>
          <table>
          <tr>
            <th>ID</th>
            <th>Category</th>
          </tr>';

if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	echo ' <tr>
            <td>'.$row['cat_id'].'</td>
            <td>'.$row['name'].'</td>
            <td><a href="edit_category.php?cat_id='.$row['cat_id'].'&action=delete"><button>Delete</button></a></td>
             <td><a href=edit_category.php?cat_id='.$row['cat_id'].'&action=edit><button>Edit</button></td>
          </tr>';

    }
}
echo '
<tr>
	<td>Add:</td>
  <form action="edit_category.php" method="GET">
	<td><input name="name" required type="text"></td>
  <td hidden><input name="action" value="add" type="text"></td>
	<td><button>Add</button></td>
  </form>
</tr>
</table>';

CloseCon($conn);

// PRODUCTS
$conn = OpenCon();
$sql = 'SELECT
		shop.products.id,
		shop.products.`name`,
		shop.products.description,
		shop.products.image_sm,
		shop.products.image_xl,
		shop.products.price,
    shop.products.status
		FROM
		shop.products';
$result = $conn->query($sql);

echo '<br/>
  		<h3>All Products</h3>
          <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Active</th>
          </tr>';

if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	echo ' <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['price'].'</td>
            <td>'.$row['status'].'</td>
            <td><a href=edit_product.php?action=edit&id='.$row['id'].'><button>Edit</button></td>
             <td><a href=edit_product.php?action=delete&id='.$row['id'].'><button>Delete</button></td>
          </tr>';

    }
}
echo "</table><a href=edit_product.php?action=add><button>Add Product</button></a>";

CloseCon($conn);

?>