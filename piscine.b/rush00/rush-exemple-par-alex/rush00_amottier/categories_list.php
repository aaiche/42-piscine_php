<?php

	include_once 'db_connect.php';
	$conn = OpenCon();

	$sql = "SELECT * FROM categories ORDER BY name";
	$result = $conn->query($sql);

	$cat = $_GET['cat'];
	$class = "";

	if ($result->num_rows > 0)
	{
		echo '<div id="cat_menu">
          		<h2 id="cat_tit">Pokeshop</h2><br />
          		<table id="cat_tab">';

        if (!($cat))
	        $class = "active";
	    else
	    	$class = "";
    	echo '<tr><td><h3><a class="cat_name" href="index.php"'.$class.'">All</a></h3></td></tr>';

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        if ($cat == $row["cat_id"])
				$class = "active";
			else
				$class = "";
	        echo '<tr><td><h3><a class="cat_name" href="index.php?cat='.$row["cat_id"].'"'.$class.'">'. $row["name"].'</a></h3></td></tr>';
	    }
	    
	    echo '</table>
        </div>';
	}

	CloseCon($conn);

?>