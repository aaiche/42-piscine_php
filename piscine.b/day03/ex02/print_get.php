<?php 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	foreach($_GET as $key => $value) {
			echo "$key: $value\n";
	} 
}
?>
