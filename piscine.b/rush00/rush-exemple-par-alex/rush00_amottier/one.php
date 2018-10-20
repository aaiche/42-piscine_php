<?php 
    session_start();
 ?>
<!DOCTYPE html>
<html>

  <head>

    <title>My Shop</title>

    <link href="css/front.css" rel="stylesheet">
    <link href="css/one.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <?php include('header.php') ?>

    <!-- Page Content -->
    <div>

      <div id="page">
        <?php include ('categories_list.php') ?>
      </div>

      <div id="content">

        <?php include('product_one.php') ?>
        <br/>

      </div>

    </div>

    <!-- Footer -->
    <footer id="sign">
      <?php include ('footer.php') ?>
      <!-- /.container -->
    </footer>

  </body>

</html>
