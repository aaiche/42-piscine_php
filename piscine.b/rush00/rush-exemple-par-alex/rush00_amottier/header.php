<?php

if(!($_SESSION)) {
    session_start();
} 

include_once 'Cart.php';
if (!($cart))
  $cart = new Cart;

if ($_SESSION['logged_on_user'])
  $username = $_SESSION['logged_on_user'];

$admin = $_SESSION['is_admin'];

echo '<link href="css/front.css" rel="stylesheet">
      <nav id="title_bar">
        <table id="menu">
          <tr>
            <td><a id="title" href="index.php">MY POKESHOP</a></td>
            <td class="hidden">white</td>
            <td class="hidden">white</td>
            <td class="hidden">white</td>';

            if ($admin)
              echo '<td><a class="menu_link" href="admin.php">Administration</a></td>';

            if ($username)
                echo '<td><a class="menu_link" href="profile.php">'.$username.'</a></td>
                      <td><a class="menu_link" href="logout.php">Logout</a></td>
                      <td><a class="menu_link" href="orders_users.php">Orders</a>';

            else
            {
              echo '<td><a class="menu_link" href="login.php">Login</a></td>';
            }
            
            echo '<td><a class="menu_link" href="viewCart.php">Cart (x'.$cart->total_items().' $'.$cart->total().')</a></td>
          </tr>
        </table>
      </nav>';
?>