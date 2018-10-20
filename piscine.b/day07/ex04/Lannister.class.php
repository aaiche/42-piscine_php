<?php
/**
  * Class : Lannister.class.php
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

class Lannister {
	public function sleepWith($p) {
		/*
		 * On demande a verifier que le parametre soit une classe de type Lannister
		 */
		if($p instanceof Lannister) {
			print('Not even if I\'m drunk !' . PHP_EOL);
		} else {
			print('Let\'s do this.' . PHP_EOL); 
		}
	}
}
?>
