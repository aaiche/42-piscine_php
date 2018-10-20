<?php
include 'Cart.php';
$cart = new Cart;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
    <meta charset="utf-8">
    <link href="css/front.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">


</head>

<body class="body">
     <!-- Navigation -->
    <?php include('header.php') ?>

<div id="OP">
    <br/>
    <table id="order_tab">
    <caption><h1>Shopping Cart</h1></caption>
    <thead>
        <tr>
            <td><h3>Product</h3></td>
            <td><h3>Price</h3></td>
            <td><h3>Quantity</h3></td>
            <td><h3></h3></td>
            <td><h3>Subtotal</h3></td>
            <td><h3>&nbsp;</h3></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td id="name_ord"><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["price"].' USD'; ?></td>
            <form action=cartAction.php>

            <td><input name=qty type="number"  value="<?php echo $item["qty"]; ?>" ></td>

            <input type="text" hidden name="id" value=<?php echo $item["rowid"]; ?> ></input>

            <td> <button name=action value=updateCartItem >Refresh</button></a></td>
        </form>
            <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
            <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Your cart is empty!</p></td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
            <?php if($cart->total_items() > 0){ ?>
            <tr>
                <td colspan="4"></td>
                <td id="total"><strong>Total <?php echo '$'.$cart->total().' USD'; ?></strong></td>
            </tr>
        </tfoot>
    </table>
    <br />
            <a class="button" id="blue" href="index.php"><i></i> Continue Shopping</a><br /><br />         
            <?php 
            if ($cart->total_items() > 0)
            {      
                if (isset($_SESSION['logged_on_user'])){
                    echo '<td><a class="button" id="purple" href="checkout.php">Checkout</a></td>';
                
                } else {
                    echo '<td><a class="button" id="purple" href="login.php">Login & Checkout</a></td>';
                }
            }
        }
?>
</div>
    <footer id="sign">
      <?php include ('footer.php') ?>
    </footer>
</body>
</html>