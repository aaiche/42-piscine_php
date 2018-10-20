<?php
    session_start();
 ?>
<!DOCTYPE html>
<html>

  <head>

    <title>Register</title>

    <link href="css/front.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">

  </head>

  <body class="body">

    <?php include('header.php') ?>

      <div>
          <br/>
    	  	<form action='register_new.php' method="POST">
              <div id="legend">
                <legend id="account"><h2>Register</h2></legend>
              </div>
              <div id="edit">
                <label for="username"><h3>Username</h3></label>
                <div>
                  <input type="text2" class="field" name="username" placeholder="">
                  <p><i>Username can contain any letters or numbers, without spaces.</i></p>
                </div>
                <label for="email"><h3>E-mail</h3></label>
                <div>
                  <input type="text2" class="field" name="email" placeholder="">
                  <p><i>Please provide your E-mail.</i></p>
                </div>
                <label for="address"><h3>Address</h3></label>
                <div>
                   <input type="text2" class="field" name="address" placeholder="">
                  <p><i>Please provide your delivery address.</i></p>
                </div>
                <label for="password"><h3>Password</h3></label>
                <div>
                  <input type="password" class="field" name="password" placeholder="">
                  <p><i>Password should be at least 4 characters.</i></p>
                </div>
                <label for="password_confirm"><h3>Password (Confirm)</h3></label>
                <div>
                  <input type="password" class="field" name="password_confirm" placeholder="">
                  <p><i>Please confirm password.</i></p>
                </div>           
                <div>
                  <button class="button" id="blue">Register</button>
                </div>
              </div>
          </form>
      </div>

    <footer id="sign">
      <?php include ('footer.php') ?>
    </footer>

  </body>

</html>
