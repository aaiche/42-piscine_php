<?php 
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <title>Shop Homepage</title>

  </head>

  <body>

    <!-- Navigation -->
    <?php include('header.php') ?>

    <!-- Page Content -->

  <div id="page">

    <?php include('categories_list.php') ?>

  </div>

        <div id="content">

            <img src="http://i55.servimg.com/u/f55/18/80/15/48/avril_12.png" alt="deco">
            <div id="art_list">
              <?php include('products_list.php') ?>
            </div>

        <footer id="sign">
          <?php include ('footer.php') ?>
        </footer>
        </div>

  </body>

</html>
