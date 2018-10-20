<?php

  include_once 'db_connect.php';
	$id = $_GET['id'];

  include_once 'Cart.php';
  if (!($cart))
    $cart = new Cart;

	$conn = OpenCon();

  $id = $conn->real_escape_string($id);

	$sql = "SELECT * FROM products WHERE id = $id";
	$result = $conn->query($sql);

if ($result->num_rows > 0)
	{
	while($row = $result->fetch_assoc()) {

	echo ' <div>
            <img class="image_xl" src="'.$row['image_sm'].'" alt="">
            <div>
              <h3 class="poke_name">'. $row["name"].'</h3>
              <h4 class="price">$'. $row["price"].'</h4><br />
              <p class="desc">'. $row["description"].'</p>
              <br/><br/>
              <form class="form-horizontal" action="cartAction.php" >
              <table>
              <th>
              <input type="number" class="quant" name="qty"value="1" style="width: 100px;" >
               <input type="number" hidden name="id" value='. $row["id"].'></input>
              </th>
              <th>
              <button class="add_cart" id="cyan" name="action" value="addToCart" class="btn btn-success clickable">Add to cart</button>
              </th>
              </table>
            </div>
          </div>';
    };
};

?>