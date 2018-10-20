<?php
/**
  * Class : Targaryen.class.php
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

Class Targaryen {

	public function __construct() {
		return;
	}

	public function __destruct() {
		return;
	}
	
	public function resistsFire() {
		return False;
	}
	 
	public function getBurned() {
		if($this->resistsFire() === False) {
			return "burns alive";
		} else {
			return "emerges naked but unharmed";
		}
	}
}
?>
