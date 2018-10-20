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
/*
 * 						 -----------------------
 * 						|	House Lannister 	|
 * 						 -----------------------
 * 									|
 * 									|
 *			     -------------------------------------------
 * 				|					|						|
 * 				|					|						|
 * 				|					|						|
 * 		 --------------	  	 	  --------------	 -------------------		
 * 		| Fille Cersei | <-Love->| Gars Jaime   |	| Ptit Frere Tyrion	|------------
 * 		 -------------- 	 	  --------------	 -------------------			 |
 *						 															 |
 *						 															 |
 *						 															 |
 * 						 -----------------------						 			 |
 * 						|	House Stark     	|						 			 |
 * 						 -----------------------						 			married
 * 									|												 |
 * 									|						 						 |
 *			     -------------------------------------------						 |
 * 				|					|						|						 |
 * 				|					|						|						 |
 * 				|					|						|						 |
 * 		 --------------	  	 	  --------------	 -------------------		     |
 * 		|              |         |              |	| Fille Sansa      	|------------
 * 		 -------------- 	 	  --------------	 -------------------
 */ 	

class Jaime extends Lannister {
	public function sleepWith($p) {

		/*
		 * Utilise la methode Mere sauf pour si c sa soeur
		 */
		if(!($p instanceof Cersei )) {
			parent::sleepWith($p);
		} else { 							// meme si fille Lannister, cela ne le derange pas
			print('With pleasure, but only in a tower in Winterfell, then.' . PHP_EOL);
		}
	}
}
?>
