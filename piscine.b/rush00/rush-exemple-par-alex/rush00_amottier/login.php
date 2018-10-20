<?php 
    session_start();
    include_once 'db_connect.php';

    if (isset($_GET['username']) && isset($_GET['password']))
    {
    	$username_str = $_GET['username'];
    	$password = $_GET['password'];

    	$conn = OpenCon();
	  	$username_str = $conn->real_escape_string($username_str);
	  	$password = hash("whirlpool", $password);
		$sql = "SELECT * FROM users WHERE name = '".$username_str."' AND password = '".$password."' AND active = 1";
		$result = $conn->query($sql);
		if ($result->num_rows == 1)
			{
				// echo "welcome";
        $row = $result->fetch_assoc();
				$_SESSION['logged_on_user'] = $username_str;
        $_SESSION['is_admin'] = $row["is_admin"];
				header("Location: index.php");
			}
		else
			{
        $_SESSION['logged_on_user'] = NULL;
				echo '<div><h3 id="no_log">wrong login/password.</h3></div>';
			}
    }
 ?>
<!DOCTYPE html>
<html>

  <head>

    <title>My Shop</title>

  </head>

  <body id="log_page">
    <?php include('header.php') ?>
    <div id="loglog">
        <br/>
        <div id="log">
                <h1 id="log_text">Login to Your Account</h1><br>
              <form action='login.php' method="GET">
                <input class="log_input" type="text" name="username" placeholder="Username">
          <br />
          <br />
                <input class="log_input" type="password" name="password" placeholder="Password">
          <br />
          <br />
                <input id="log_button" type="submit" name="login" value="Login">        
        </form>
              <div>
          <br />
                  <a id="log_link" href="register.php">Register</a></a>
          <br />
                </div>
            </div>
    </div>

    <footer id="sign">
      <?php include ('footer.php') ?>
    </footer>

  </body>

</html>
