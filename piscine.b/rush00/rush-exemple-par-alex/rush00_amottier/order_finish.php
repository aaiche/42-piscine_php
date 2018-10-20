<?php 
    session_start();
 ?>
<!DOCTYPE html>
<html>

  <head>
    <title>My Shop</title>

    <link href="css/front.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">

  </head>

  <body>

    <?php include('header.php') ?>
        <br/>
        <div id="thank">
          <p id="thank_note"><strong>Thank You!</strong> We confirmed we received your order! <br/>Your order number is <b>#<?php echo $_GET['id'] ?></b></p>
        </div>
        <br/>
        <a href="index.php" class="button cont" id="blue">Continue Shopping</a>

    <footer id="sign">
      <?php include ('footer.php') ?>
    </footer>

  </body>

</html>
