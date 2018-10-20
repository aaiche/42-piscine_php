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
 * 		| Fille Cersei | <-Love->| Gars Jaime   |	| Ptit Frere Tyrion	|
 * 		 -------------- 	 	  --------------	 -------------------
 */ 	

//
// Tyrion est une classe Lannister ou bien
// Tyrion Herite de Lannister. C est normal c est sa famille. Sauf que lui a une taille +ptite
// Tyrion aura acces a tt ce qui a ete defini dans Lannister
//
Class Tyrion extends Lannister {
	public function __construct() {
		// Je profite du constructeur Mere, qui fait l initilialisation generale
		parent::__construct();
		print( 'My name is Tyrion' . PHP_EOL );
		return;
	}

	public function __destruct() {
		return;
	}

	// les methodes getSize() et houseMotto() se trouvent ici
	// Mais je fais de l'Override sur getSize()
	public function getSize() {
		return "Short";
	}
}
?>
