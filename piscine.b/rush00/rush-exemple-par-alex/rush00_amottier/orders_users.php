<?php 
    session_start();
 ?>
<!DOCTYPE html>
<html>

  <head>

    <title>Orders</title>

    <link href="css/front.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">

  </head>

  <body class="body">

    <?php include('header.php') ?>
        <div id="OP">
          <?php include('orders_users_table.php') ?>
          <br/>
        </div>

    <footer id="sign">
      <?php include ('footer.php') ?>
    </footer>

  </body>

</html>
