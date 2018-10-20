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
/*
 * 						 -----------------------
 * 						|	House Targaryen 	|
 * 						 -----------------------
 * 									|
 * 									|
 *			     -------------------------------------------
 * 				|					    |					
 * 				|					    |
 * 				|					    |	
 * 		 ---------------	  	    --------------	
 * 		| Fille Daenerys |         | Gars Viserys |	
 * 		 --------------- 	 	     --------------
 * 	Daenerys n implemente pas resistsFire() et utilisera dynamiquement celle de la Mere puisque elle l herite
 * 	Viserys implemente resistsFire() et utilisera dynamiquement la sienne
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
		// static::resistsFire() : est une liason dynamique et ce sera la classe qui determinera c qui sera utilise
		// La Mere dit a ses Filles d utiliser dynamiquement leur resistFire() si elles l ont implementes sinon 
		// de tte facon elles heritent de la sienne
		// Et si elles n ont pas implementes resistsFire(), elles pourront tjrs utiliser celle de la Mere puisque elles en
		// heritent
		if(static::resistsFire() === False) {
			return "burns alive";
		} else {
			return "emerges naked but unharmed";
		}
	}
}
?>
