<?php 
    session_start();
    include_once 'db_connect.php';

    if (isset($_SESSION['logged_on_user']))
    {
      $username = $_SESSION['logged_on_user'];

    $conn = OpenCon();
    $sql = "SELECT * FROM users WHERE name = '".$username."'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1)
      {
        // echo "welcome";
        $row = $result->fetch_assoc();
        $email = $row['mail'];
        $address = $row['address'];
        // echo $row['name'];
      }
    }
    else
    {
      header("Location: index.php");
    }


 ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>My Shop</title>

    <link href="css/cart.css" rel="stylesheet">

  </head>

  <body class="body">

    <!-- Navigation -->
    <?php include('header.php') ?>

    <!-- Page Content -->
<div id="OP">
  <br/>
    <table id="order_tab">
        <caption><h1>Order Preview</h1></caption>
    <thead>
        <tr>
            <td><h3>Product</h3></td>
            <td><h3>Price</h3></td>
            <td><h3>Quantity</h3></td>
            <td><h3>Subtotal</h3></td>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td id="ord_name"><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["price"].' USD'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
        </tr>
        <tr></tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td id="total"><strong>Total <?php echo '$'.$cart->total().' USD'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <hr />
    <div>
        <br />
        <h4>Shipping Details</h4>
        <p>Name: <?php echo $username; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Address: <?php echo $address; ?></p>
    </div>
    <div>
        <a class="button" id="red" href="cartAction.php?action=placeOrder">Order<i></i></a><br /><br />
        <a class="button" id="blue" href="index.php"><i></i> Continue Shopping</a>
    </div>
  </br></br></br></br></br></br>
</div>
    <!-- /.container -->

    <!-- Footer -->
    <footer id="sign">
      <?php include ('footer.php') ?>
      <!-- /.container -->
    </footer>
  </body>

</html>
