<?php
/**
  * Class : Tyrion.class.php
  * 
  *	Description:
  *
  * Available options:
  *
  * @param 	
  * @param 
  * 
  * @return 
  * 
  * @throws ...
  * 
  * @version 0.1.0
  */

Class Tyrion extends Lannister {
	public function __construct() {
		parent::__construct();
		print( 'My name is Tyrion' . PHP_EOL );
		return;
	}

	public function __destruct() {
		return;
	}
	
	public function getSize() {
		return "Short";
	}
}
?>
