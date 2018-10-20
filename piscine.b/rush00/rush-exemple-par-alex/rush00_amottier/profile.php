<?php 
    session_start();
    include_once 'db_connect.php';

    if ($_GET['action'] == "save")
    {
      $email = $_GET['email'];
      $address = $_GET['address'];

      if ((strlen($email) < 4) || strlen($address) < 4 || (!(filter_var($email, FILTER_VALIDATE_EMAIL))))
      {
          echo ("<i>Not Saved! Please check if everything is correct.</i>");
      }
      else
      {
          $username = $_SESSION['logged_on_user'];
          $conn = OpenCon();
          $address = $conn->real_escape_string($address);
          $email = $conn->real_escape_string($email);
          $sql = "UPDATE users SET mail= '".$email."' , address = '".$address."'  
                  WHERE name = '".$username."'";
          $result = $conn->query($sql);
          if (mysqli_affected_rows($conn) == 1)
            echo "<i>New information have been saved!</i>";
      }
    }

    if ($_GET['action'] == "delete")
    {
      $username = $_SESSION['logged_on_user'];
      $conn = OpenCon();
      $sql = "UPDATE users SET active = 0  
              WHERE name = '".$username."'";
      $result = $conn->query($sql);
      if (mysqli_affected_rows($conn) == 1)
       {
        session_unset();
        header("Location: index.php");
       }
    }

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
 ?>
<!DOCTYPE html>
<html>

  <head>

    <title>Edit Account</title>

    <link href="css/front.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">

  </head>

  <body class="body">

    <!-- Navigation -->
    <?php include('header.php') ?>

          <div>
            <legend id="account"><strong>Account: <?php echo $username ?></strong></legend>
          </div>
          <div id="edit">
    	  	  <br/>
				    <form action='profile.php' method="GET">
                <label for="username" ><H3>Address</H3></label>
                <div>
                  <input type="text2" class="adr" name="address" value=<?php echo '"'.$address.'"' ?>>
                  <p>You can edit your delivery address.</p><br />
                </div>
              <label for="email"><H3>E-mail</H3></label>
                <div >
                  <input type="text2" class="adr" name="email" value=<?php echo '"'.$email.'"' ?>>
                </div>
                <div>
                <br/>
                <br />
                  <button class="button" id="red" name="action" value="save">Save Modifications</button>
                  <button class="button" id="purple" name="action" value="delete">Delete my account</button>
                </div>
          </form>

			<br/>
          <br/>

        </div>

    <footer id="sign">
      <?php include ('footer.php') ?>
    </footer>

  </body>

</html>
