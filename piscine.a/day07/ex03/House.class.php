<?php
/**
  * Class : House.class.php
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

abstract class House {

	abstract public function getHouseName();
	abstract public function getHouseMotto();
	abstract public function getHouseSeat();

	public function __construct() {
		return;
	}

	public function __destruct() {
		return;
	}
	
	public function introduce() {
		$str_out = 'House ';
		$str_out .= $this->getHouseName();
		$str_out .= ' of ';
		$str_out .= $this->getHouseSeat();
		$str_out .= ' : "';
		$str_out .= $this->getHouseMotto();
		$str_out .= '"';
		$str_out .= PHP_EOL;
		print( $str_out );
	}
}
?>
