<?php

	session_start();
    include_once 'db_connect.php';

    if (isset($_SESSION['logged_on_user']))
    {
    	$username = $_SESSION['logged_on_user'];

    	$conn = OpenCon();
		$sql = 'SELECT
				shop.commands.com_id,
				DATE_FORMAT(shop.commands.created,"%M %e %Y") AS date,
				SUM(shop.commands_details.pd_id) AS quantity,
				SUM(shop.commands_details.price * shop.commands_details.quantity) AS total_price
				FROM
				shop.commands
				JOIN shop.commands_details
				ON shop.commands.com_id = shop.commands_details.order_id
				WHERE shop.commands.name = \''.$username.'\'
				GROUP BY 
				shop.commands.com_id,
				DATE_FORMAT(shop.commands.created,"%W %M %e %Y")';
		$result = $conn->query($sql);

		echo '<br/>
                  <table id="order_tab">
                  <caption><h1>Your Orders</h1></caption>
                  <tr>
                    <td><h3>Order#</h3></td>
                    <td><h3>Date</h3></td>
                    <td><h3>Quantity</h3</td>
                    <td><h3>Total Price</h3></td>
                  </tr>';

		if ($result->num_rows > 0)
		{
		    // output data of each row
		    while($row = $result->fetch_assoc()) {

		    	echo ' <tr>
                    <td>'.$row['com_id'].'</td>
                    <td>'.$row['date'].'</td>
                    <td>'.$row['quantity'].'</td>
                    <td>'.$row['total_price'].'</td>
                  </tr>';

		    }
		}
		echo "</table>";
    }
?>