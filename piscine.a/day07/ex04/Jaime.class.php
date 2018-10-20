<?php
/**
  * Class : Jaime.class.php
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

class Jaime extends Lannister {
	public function sleepWith($p) {

		if(!($p instanceof Cersei )) {
			parent::sleepWith($p);
		} else {
			print('With pleasure, but only in a tower in Winterfell, then.' . PHP_EOL);
		}
	}
}
?>
